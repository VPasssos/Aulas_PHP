
<?php
require_once __DIR__.'/../includes/auth.php';

if (!is_admin()) {
    http_response_code(403);
    die('Apenas administradores podem editar usuários.');
}

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if (!$id) { die('ID inválido.'); }

// Busca o usuário
$stmt = $conn->prepare("SELECT id, nome, email, permissao FROM usuarios WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$u = $stmt->fetch();
if (!$u) { die('Usuário não encontrado.'); }

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $nome  = sanitize($_POST['nome'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $perm  = $_POST['permissao'] ?? $u['permissao'];
    $senha = $_POST['senha'] ?? '';

    if (!$nome || !$email) {
        $msg = 'Nome e e-mail são obrigatórios.';
    } else {
        // Evita duplicidade de e-mail
        $chk = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id <> ? LIMIT 1");
        $chk->execute([$email, $u['id']]);
        if ($chk->fetch()) {
            $msg = 'E-mail já está em uso por outro usuário.';
        } else {
            if ($senha) {
                if (strlen($senha) < 6) {
                    $msg = 'A nova senha deve ter ao menos 6 caracteres.';
                } else {
                    $hash = password_hash($senha, PASSWORD_DEFAULT);
                    $upd = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, permissao = ? WHERE id = ?");
                    $upd->execute([$nome, $email, $hash, $perm, $u['id']]);
                }
            } else {
                $upd = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, permissao = ? WHERE id = ?");
                $upd->execute([$nome, $email, $perm, $u['id']]);
            }
            if (!$msg) {
                header('Location: /projeto_crud/usuarios/listar.php');
                exit;
            }
        }
    }
}
?>
<?php include __DIR__.'/../includes/header.php'; ?>
<h1 class="h3 mb-3">Editar Usuário</h1>
<?php if ($msg): ?><div class="alert alert-danger"><?= e($msg); ?></div><?php endif; ?>
<form method="post">
  <?php csrf_field(); ?>
  <div class="mb-3">
    <label class="form-label form-required">Nome</label>
    <input type="text" class="form-control" name="nome" value="<?= e($u['nome']); ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label form-required">E-mail</label>
    <input type="email" class="form-control" name="email" value="<?= e($u['email']); ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Permissão</label>
    <select class="form-select" name="permissao">
      <option value="usuario" <?= $u['permissao']==='usuario'?'selected':''; ?>>Usuário</option>
      <option value="admin" <?= $u['permissao']==='admin'?'selected':''; ?>>Administrador</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Nova senha (opcional)</label>
    <input type="password" class="form-control" name="senha" placeholder="Deixe em branco para manter">
  </div>
  <button class="btn btn-primary" type="submit">Salvar</button>
  <a class="btn btn-secondary" href="/projeto_crud/usuarios/listar.php">Cancelar</a>
</form>
<?php include __DIR__.'/../includes/footer.php'; ?>
