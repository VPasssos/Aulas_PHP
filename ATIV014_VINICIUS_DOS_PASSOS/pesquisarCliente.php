<?php
require_once 'conexao.php';
include 'menu.php';

$conexao = conectarBanco();
$busca = $_GET['busca'] ?? "";
?>

<div class="container mt-5">
    <h2>Pesquisar Cliente</h2>

    <form action="pesquisarCliente.php" method="GET" class="row g-3 mb-4">
        <div class="col-md-8">
            <label for="busca" class="form-label">Digite o ID ou Nome:</label>
            <input type="text" id="busca" name="busca" class="form-control" required value="<?= htmlspecialchars($busca) ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
        </div>
    </form>

    <?php if ($busca): ?>
        <?php
            if (is_numeric($busca)) {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
                $stmt->bindParam(":id", $busca, PDO::PARAM_INT);
            } else {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
                $buscaNome = "%$busca%";
                $stmt->bindParam(":nome", $buscaNome, PDO::PARAM_STR);
            }

            $stmt->execute();
            $clientes = $stmt->fetchAll();
        ?>

        <?php if (!$clientes): ?>
            <div class="alert alert-danger mt-3">Nenhum cliente encontrado com esse termo.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente["id_cliente"]) ?></td>
                            <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                            <td><?= htmlspecialchars($cliente["endereco"]) ?></td>
                            <td><?= htmlspecialchars($cliente["telefone"]) ?></td>
                            <td><?= htmlspecialchars($cliente["email"]) ?></td>
                            <td>
                                <a href="atualizarCliente.php?id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="deletarCliente.php?id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-danger">Excluir</a>
                                <a href="buscarCliente.php?id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-info">Buscar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
