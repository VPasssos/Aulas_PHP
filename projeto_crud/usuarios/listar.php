
<?php
require_once __DIR__.'/../includes/auth.php';

// Apenas admin pode gerenciar usuários (exemplo simples)
if (!is_admin()) {
    http_response_code(403);
    die('Acesso negado.');
}

$q = $_GET['q'] ?? '';

if ($q) {
    $stmt = $conn->prepare("SELECT id, nome, email, permissao, created_at FROM usuarios 
                            WHERE nome LIKE ? OR email LIKE ? ORDER BY id DESC");
    $like = '%'.$q.'%';
    $stmt->execute([$like, $like]);
} else {
    $stmt = $conn->query("SELECT id, nome, email, permissao, created_at FROM usuarios ORDER BY id DESC");
}

$usuarios = $stmt->fetchAll();
?>
<?php include __DIR__.'/../includes/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Usuários</h1>
  <a class="btn btn-success" href="/projeto_crud/usuarios/cadastrar.php">Cadastrar</a>
</div>

<form class="row g-2 mb-3" method="get">
  <div class="col-auto">
    <input type="text" class="form-control" name="q" placeholder="Buscar por nome ou e-mail" value="<?= e($q); ?>">
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-primary">Buscar</button>
  </div>
</form>

<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Permissão</th>
      <th>Criado em</th>
      <th class="text-end">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarios as $u): ?>
      <tr>
        <td><?= e($u['id']); ?></td>
        <td><?= e($u['nome']); ?></td>
        <td><?= e($u['email']); ?></td>
        <td><?= e($u['permissao']); ?></td>
        <td><?= e($u['created_at']); ?></td>
        <td class="text-end table-actions">
          <a class="btn btn-sm btn-primary" href="/projeto_crud/usuarios/editar.php?id=<?= e($u['id']); ?>">Editar</a>
          <a class="btn btn-sm btn-outline-danger" href="/projeto_crud/usuarios/excluir.php?id=<?= e($u['id']); ?>">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php include __DIR__.'/../includes/footer.php'; ?>
