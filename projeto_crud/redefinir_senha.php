
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

$token = $_GET['token'] ?? '';
$msg = '';
$ok  = '';

if (!$token) {
    http_response_code(400);
    die('Token ausente.');
}

$stmt = $conn->prepare("SELECT id, nome, data_token FROM usuarios WHERE token_recuperacao = ? LIMIT 1");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(400);
    die('Token inválido.');
}

// Verifica validade (1 hora)
$dt_token = DateTime::createFromFormat('Y-m-d H:i:s', $user['data_token'], new DateTimeZone('America/Sao_Paulo'));
$agora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
$diff = $agora->getTimestamp() - $dt_token->getTimestamp();
if ($diff > 3600) {
    http_response_code(400);
    die('Token expirado. Solicite novo link.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $senha = $_POST['senha'] ?? '';
    $conf  = $_POST['confirmar'] ?? '';
    if (strlen($senha) < 6) {
        $msg = 'A senha deve ter ao menos 6 caracteres.';
    } elseif ($senha !== $conf) {
        $msg = 'As senhas não conferem.';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $upd = $conn->prepare("UPDATE usuarios SET senha = ?, token_recuperacao = NULL, data_token = NULL WHERE id = ?");
        $upd->execute([$hash, $user['id']]);
        $ok = 'Senha alterada com sucesso. Você já pode fazer login.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-3">Redefinir senha</h1>
    <?php if ($msg): ?><div class="alert alert-danger"><?= e($msg); ?></div><?php endif; ?>
    <?php if ($ok): ?><div class="alert alert-success"><?= e($ok); ?></div><?php endif; ?>
    <form method="post">
      <?php csrf_field(); ?>
      <div class="mb-3">
        <label class="form-label form-required">Nova senha</label>
        <input type="password" class="form-control" name="senha" required>
      </div>
      <div class="mb-3">
        <label class="form-label form-required">Confirmar senha</label>
        <input type="password" class="form-control" name="confirmar" required>
      </div>
      <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
