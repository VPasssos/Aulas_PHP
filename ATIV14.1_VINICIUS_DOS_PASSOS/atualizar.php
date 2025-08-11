<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];

    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $sql = "UPDATE funcionarios SET nome=?, cargo=?, foto=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cargo, $foto, $id]);
    } else {
        $sql = "UPDATE funcionarios SET nome=?, cargo=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cargo, $id]);
    }

    echo "<div class='alert alert-success'>Atualizado com sucesso!</div>";
}

$sql = "SELECT * FROM funcionarios WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$f = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Editar Funcionário</h2>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?= $f['nome'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Cargo:</label>
        <input type="text" name="cargo" class="form-control" value="<?= $f['cargo'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Foto:</label><br>
        <?php if ($f['foto']): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($f['foto']) ?>" width="80"><br>
        <?php endif; ?>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>
</div>
</body>
</html>