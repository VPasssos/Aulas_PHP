
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$erro = $_GET['erro'] ?? '';
$msg  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    if (!$email || !$senha) {
        $msg = 'Informe e-mail e senha válidos.';
    } else {
        $stmt = $conn->prepare("SELECT id, nome, email, senha, permissao FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'email' => $user['email'],
                'permissao' => $user['permissao']
            ];
            header('Location: index.php');
            exit;
        } else {
            $msg = 'Credenciais inválidas.';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-3">Entrar</h1>
    <?php if ($erro === 'nao_autorizado'): ?>
      <div class="alert alert-warning">Faça login para continuar.</div>
    <?php endif; ?>
    <?php if (!empty($msg)): ?>
      <div class="alert alert-danger"><?= e($msg); ?></div>
    <?php endif; ?>
    <form method="post" novalidate>
      <?php csrf_field(); ?>
      <div class="mb-3">
        <label class="form-label form-required">E-mail</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label form-required">Senha</label>
        <input type="password" class="form-control" name="senha" required>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-primary" type="submit">Entrar</button>
        <a href="esqueci_senha.php">Esqueci minha senha</a>
      </div>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
