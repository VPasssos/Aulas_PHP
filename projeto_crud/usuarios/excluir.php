
<?php
require_once __DIR__.'/../includes/auth.php';

if (!is_admin()) {
    http_response_code(403);
    die('Apenas administradores podem excluir usuários.');
}

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if (!$id) { die('ID inválido.'); }

// Busca usuário
$stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$u = $stmt->fetch();
if (!$u) { die('Usuário não encontrado.'); }

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === 'sim') {
        $del = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $del->execute([$u['id']]);
        header('Location: /projeto_crud/usuarios/listar.php');
        exit;
    } else {
        header('Location: /projeto_crud/usuarios/listar.php');
        exit;
    }
}
?>
<?php include __DIR__.'/../includes/header.php'; ?>
<h1 class="h3 mb-3">Excluir Usuário</h1>
<div class="alert alert-warning">
  Tem certeza que deseja excluir o usuário <strong><?= e($u['nome']); ?></strong> (ID: <?= e($u['id']); ?>)?
</div>
<form method="post">
  <?php csrf_field(); ?>
  <input type="hidden" name="confirmar" value="sim">
  <button class="btn btn-danger" type="submit">Confirmar exclusão</button>
  <a class="btn btn-secondary" href="/projeto_crud/usuarios/listar.php">Cancelar</a>
</form>
<?php include __DIR__.'/../includes/footer.php'; ?>
