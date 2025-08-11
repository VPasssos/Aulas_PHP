<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

$sql = "SELECT * FROM funcionarios";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lista de Funcionários</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Foto</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($funcionarios as $f): ?>
    <tr>
        <td><?= $f['id'] ?></td>
        <td><?= $f['nome'] ?></td>
        <td><?= $f['cargo'] ?></td>
        <td>
            <?php if ($f['foto']): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($f['foto']) ?>" width="80">
            <?php endif; ?>
        </td>
        <td>
            <a href="atualizar.php?id=<?= $f['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
            <a href="deletar.php?id=<?= $f['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>