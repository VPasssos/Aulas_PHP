
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
require_once 'includes/mailer.php';

$msg = '';
$ok  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $msg = 'Informe um e-mail válido.';
    } else {
        $stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $agora = (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s');
            $upd = $conn->prepare("UPDATE usuarios SET token_recuperacao = ?, data_token = ? WHERE id = ?");
            $upd->execute([$token, $agora, $user['id']]);

            $link = sprintf('%s://%sredefinir_senha.php?token=%s',
                (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http',
                $_SERVER['HTTP_HOST'] ?? 'localhost',
                urlencode($token)
            );

            $subject = 'Recuperação de Senha';
            $message = '<p>Olá, ' . e($user['nome']) . '.</p>' .
                       '<p>Use o link abaixo para redefinir sua senha (válido por 1 hora):</p>' .
                       '<p><a href="'.$link.'">'.$link.'</a></p>';

            if (enviar_email($email, $subject, $message)) {
                $ok = 'Se o e-mail existir, enviaremos um link de recuperação.';
            } else {
                $ok = 'Não foi possível enviar e-mail agora. Tente novamente mais tarde.';
            }
        } else {
            $ok = 'Se o e-mail existir, enviaremos um link de recuperação.';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-3">Esqueci minha senha</h1>
    <?php if ($msg): ?><div class="alert alert-danger"><?= e($msg); ?></div><?php endif; ?>
    <?php if ($ok): ?><div class="alert alert-info"><?= e($ok); ?></div><?php endif; ?>
    <form method="post">
      <?php csrf_field(); ?>
      <div class="mb-3">
        <label class="form-label form-required">E-mail</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <button class="btn btn-primary" type="submit">Enviar link</button>
    </form>
    <div class="mt-3"><a href="login.php">Voltar ao login</a></div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
