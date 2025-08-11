<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $foto = null;

    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $sql = "INSERT INTO funcionarios (nome, cargo, foto) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $cargo);
    $stmt->bindParam(3, $foto, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar.</div>";
    }
}
?>

<h2>Novo Funcionário</h2>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Cargo:</label>
        <input type="text" name="cargo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Foto:</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
</div>
</body>
</html>