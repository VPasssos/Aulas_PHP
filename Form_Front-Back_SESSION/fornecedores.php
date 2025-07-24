<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores Cadastrados</title>
</head>
<body>
    <h1>Lista de Fornecedores Cadastrados</h1>

    <?php
        // Verifica se existem fornecedores na sessão
        if (isset($_SESSION['fornecedores']) && count($_SESSION['fornecedores']) > 0) {
            echo '<table border="1">';
            echo '<tr><th>Nome</th><th>CNPJ</th><th>Telefone</th><th>Email</th><th>Website</th><th>CEP</th><th>Estado</th><th>Cidade</th><th>Bairro</th><th>Rua</th><th>Numero</th></tr>';

            // Exibe os fornecedores cadastrados
            foreach ($_SESSION['fornecedores'] as $fornecedor) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($fornecedor['nome']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['cnpj']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['telefone']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['email']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['website']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['cep']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['estado']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['cidade']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['bairro']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['rua']) . '</td>';
                echo '<td>' . htmlspecialchars($fornecedor['num_rua']) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>Não há fornecedores cadastrados.</p>';
        }
    ?>

    <br><br>
    <a href="index.html">Voltar para o formulário</a>
</body>
</html>
