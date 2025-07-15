<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars($_POST["fornecedor_nome"]);
    $cnpj = htmlspecialchars($_POST["fornecedor_cnpj"]);
    $telefone = htmlspecialchars($_POST["fornecedor_telefone"]);
    $email = htmlspecialchars($_POST["fornecedor_email"]);
    $website = htmlspecialchars($_POST["fornecedor_website"]);
    $cep = htmlspecialchars($_POST["fornecedor_cep"]);
    $estado = htmlspecialchars($_POST["fornecedor_estado"]);
    $cidade = htmlspecialchars($_POST["fornecedor_cidade"]);
    $bairro = htmlspecialchars($_POST["fornecedor_bairro"]);
    $rua = htmlspecialchars($_POST["fornecedor_rua"]);
    $numero = htmlspecialchars($_POST["fornecedor_numero"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fornecedor</title>
    <link rel="stylesheet" type="text/css" href="ESTILOFORMULARIO.css" media="all">
</head>
<body>

<form method="post" action="">
    <table>
        <tr>
            <th rowspan="2"><img src="LogoForneInjet.png" alt="LOGO_ForneInjet" height="80"></th>
            <th class="TITULO">Cadastro</th>
        </tr>
        <tr>
            <th class="TITULO">Fornecedor</th>
        </tr>
        <tr><th colspan="2"><br></th></tr>

        <tr><th>Nome:</th><th><input type="text" name="fornecedor_nome" required></th></tr>
        <tr><th>CNPJ:</th><th><input type="text" name="fornecedor_cnpj" required></th></tr>
        <tr><th>Telefone:</th><th><input type="text" name="fornecedor_telefone" required></th></tr>
        <tr><th>E-mail:</th><th><input type="email" name="fornecedor_email" required></th></tr>
        <tr><th>Website:</th><th><input type="url" name="fornecedor_website"></th></tr>
        <tr><th>CEP:</th><th><input type="text" name="fornecedor_cep"></th></tr>
        <tr><th>Estado:</th><th><input type="text" name="fornecedor_estado"></th></tr>
        <tr><th>Cidade:</th><th><input type="text" name="fornecedor_cidade"></th></tr>
        <tr><th>Bairro:</th><th><input type="text" name="fornecedor_bairro"></th></tr>
        <tr><th>Rua:</th><th><input type="text" name="fornecedor_rua"></th></tr>
        <tr><th>Número:</th><th><input type="text" name="fornecedor_numero"></th></tr>

        <tr>
            <td colspan="2" style="text-align: center;"><br>
                <input type="submit" value="Cadastrar Fornecedor">
            </td>
        </tr>
    </table>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <h2>Fornecedor Cadastrado</h2>
    <ul>
        <li><strong>Nome:</strong> <?= $nome ?></li>
        <li><strong>CNPJ:</strong> <?= $cnpj ?></li>
        <li><strong>Telefone:</strong> <?= $telefone ?></li>
        <li><strong>Email:</strong> <?= $email ?></li>
        <li><strong>Website:</strong> <?= $website ?></li>
        <li><strong>CEP:</strong> <?= $cep ?></li>
        <li><strong>Estado:</strong> <?= $estado ?></li>
        <li><strong>Cidade:</strong> <?= $cidade ?></li>
        <li><strong>Bairro:</strong> <?= $bairro ?></li>
        <li><strong>Rua:</strong> <?= $rua ?></li>
        <li><strong>Número:</strong> <?= $numero ?></li>
    </ul>
<?php endif; ?>

<br><br>
<address>
    Vinicius dos Passos - Estudante - Técnico - Desenvolvimento de Sistemas
</address>

</body>
</html>
