<?php 

    require_once "conexao.php";

    $conexao = conectarBanco();

    $buscar = $_GET['busca'] ?? "";

    if(!$buscar) {
        ?>
        <form action="pesquisarCliente.php" method="GET">
            <label for="buscar">Digite o ID ou Nome:</label>
            <input type="text" id="buscar" name="buscar" required>
            <button type="submit">Pesquisar</button>
        </form>
        <?php
        exit;
        }

    if (is_numeric($buscar)) {
        $stml = $conexao->prepare("SELECT id_cliente,
        nome, endereco, telefone, email FROM cliente WHERE
        id_cliente = :id");
        $stml->bindParam(":id", $buscar, PDO::PARAM_INT);
    } else{
        $stml = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
        $buscarNome = "%$buscar%";
        $stmt->bindParam(":nome", $buscarNome, PDO::PARAM_STR);
    }

    $stml->execut();
    $clientes = $stmt->fetchAll();

    if (!$clientes){
        die("ERRO: Nenhum cliente encintrado.");
    }
    ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?=htmlspecialchars($cliente["id_cliente"]) ?></td>
                <td><?=htmlspecialchars($cliente["nome"]) ?></td>
                <td><?=htmlspecialchars($cliente["endereco"]) ?></td>
                <td><?=htmlspecialchars($cliente["telefone"]) ?></td>
                <td><?=htmlspecialchars($cliente["email"]) ?></td>
                <td>
                    <a href="atualizarCliente.php?id=<?= $cliente['id_cliente']?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
