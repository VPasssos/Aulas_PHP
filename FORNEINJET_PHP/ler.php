<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

$sql = "SELECT * FROM Funcionario";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lista de Funcionários</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Usuário</th>
        <th>Permissão</th>
        <th>Situação</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($funcionarios as $f): ?>
    <tr>
        <td><?= $f['ID_Funcionario'] ?></td>
        <td><?= $f['nome'] ?></td>
        <td><?= $f['cargo'] ?></td>
        <td><?= $f['telefone'] ?></td>
        <td><?= $f['email'] ?></td>
        <td><?= $f['usuario'] ?></td>
        <td><?= $f['permissao'] ?></td>
        <td><?= $f['situacao'] ?></td>
        <td>
            <a href="atualizar.php?id=<?= $f['ID_Funcionario'] ?>" class="btn btn-warning btn-sm">Editar</a>
            <a href="deletar.php?id=<?= $f['ID_Funcionario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>