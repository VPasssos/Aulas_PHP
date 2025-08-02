<?php
require_once 'conexao.php';
include 'menu.php';

$conexao = conectarBanco();

$sql = "SELECT id_cliente, nome, endereco, telefone, email FROM cliente ORDER BY nome ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2 class="mb-4">Todos os Clientes Cadastrados</h2>

    <?php if (!$clientes): ?>
        <div class="alert alert-warning">Nenhum cliente encontrado no banco de dados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td>
                                <a href="atualizarCliente.php?id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-warning">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
