<?php

    require_once 'conexao.php';

    $conexao = conectarBanco();

    $idCliente = $_GET['id'] ?? null;
    $cliente = null;
    $msgErro = "";

    function buscarClientePorId ($idCliente, $conexao) {
        $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");

        $stmt->bindParam(":id", $idCliente, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    if ($idCliente && is_numeric($idCliente)) {
        $cliente = buscarClientePorId( $idCliente, $conexao );

        if (!$cliente) {
            $msgErro = "Erro: Cliente não encontrado!";
        }
    } else {
        $msgErro = "Digite o ID do cliente para buscar os dados.";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente</title>
    <script>
        function habilitarEdicao(campo) {
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>

    <h2>Atualizar Cliente</h2>

    <?php if ($msgErro): ?>
        <p style="color: red;"><?= htmlspecialchars($msgErro) ?></p>

        <form action="atualizarCliente.php" method="GET">
            <label for="id">ID do Cliente:</label>
            <input type="number" name="id" id="id" required>
            <button type="submit">Buscar</button>
        </form>
    
    <?php else: ?>
        <form action="processarAtualizacao.php" method="POST">
            <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente['id_cliente']) ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" readonly onclick="habilitarEdicao('nome')">

            <label for="endereco">Endereco:</label>
            <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" readonly onclick="habilitarEdicao('endereco')">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" readonly onclick="habilitarEdicao('telefone')">

            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" value="<?= htmlspecialchars($cliente['email']) ?>" readonly onclick="habilitarEdicao('email')">

            <button type="submit">Atualizar Cliente</button>
        </form>
        
    <?php endif; ?>


</body>
</html>