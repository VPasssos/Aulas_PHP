
<?php
require_once __DIR__.'/../includes/auth.php';

if (!is_admin()) {
    http_response_code(403);
    die('Apenas administradores podem cadastrar usuários.');
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $nome  = sanitize($_POST['nome'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    $perm  = $_POST['permissao'] ?? 'usuario';

    if (!$nome || !$email || strlen($senha) < 6) {
        $msg = 'Preencha todos os campos corretamente. Senha com mínimo de 6 caracteres.';
    } else {
        // Verifica duplicidade de e-mail
        $chk = $conn->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
        $chk->execute([$email]);
        if ($chk->fetch()) {
            $msg = 'E-mail já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $ins = $conn->prepare("INSERT INTO usuarios (nome, email, senha, permissao) VALUES (?, ?, ?, ?)");
            $ins->execute([$nome, $email, $hash, $perm]);
            header('Location: /projeto_crud/usuarios/listar.php');
            exit;
        }
    }
}
?>
<?php include __DIR__.'/../includes/header.php'; ?>
<h1 class="h3 mb-3">Cadastrar Usuário</h1>
<?php if ($msg): ?><div class="alert alert-danger"><?= e($msg); ?></div><?php endif; ?>
<form method="post">
  <?php csrf_field(); ?>
  <div class="mb-3">
    <label class="form-label form-required">Nome</label>
    <input type="text" class="form-control" name="nome" required>
  </div>
  <div class="mb-3">
    <label class="form-label form-required">E-mail</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="mb-3">
    <label class="form-label form-required">Senha</label>
    <input type="password" class="form-control" name="senha" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Permissão</label>
    <select class="form-select" name="permissao">
      <option value="usuario">Usuário</option>
      <option value="admin">Administrador</option>
    </select>
  </div>
  <button class="btn btn-primary" type="submit">Salvar</button>
  <a class="btn btn-secondary" href="/projeto_crud/usuarios/listar.php">Cancelar</a>
</form>
<?php include __DIR__.'/../includes/footer.php'; ?>
