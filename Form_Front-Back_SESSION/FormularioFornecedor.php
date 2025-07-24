<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Fornecedor</title>
    <link rel="stylesheet" type="text/css" href="ESTILOFORMULARIO.css" media="all">
    <script src="FormularioFornecedor.js"></script>
</head>
<body>
<div class="card_form">
    <form action="BackFornecedor.php" method="GET">
    <table>
        <tr>
            <th rowspan="2"><img src="LogoForneInjet.png" alt="LOGO_ForneInjet" height="120"></th>
            <th class="TITULO">Cadastro</th>
        </tr>
        <tr>
            <th class="TITULO">Fornecedor</th>
        </tr>
        <tr>
            <th><br></th>
        </tr>
        <tr>
            <th>Nome:</th>
            <th><input type="text" name="fornecedor_nome" required onkeypress="mascara(this, text)"></th>
        </tr>
        <tr>
            <th>CNPJ:</th>
            <th><input type="text" name="fornecedor_cnpj" required onkeypress="mascara(this, cnpj)" maxlength="18"></th>
        </tr>
        <tr>
            <th>Telefone:</th>
            <th><input type="text" name="fornecedor_telefone" required onkeypress="mascara(this, telefone)" maxlength="14"></th>
        </tr>
        <tr>
            <th>E-mail:</th>
            <th><input type="text" name="fornecedor_email"></th>
        </tr>
        <tr>
            <th>Website:</th>
            <th><input type="text" name="fornecedor_website" ></th>
        </tr>
        <tr>
            <th>CEP:</th>
            <th><input type="text" name="fornecedor_cep" required onkeypress="mascara(this, cep)" maxlength="10"></th>
        </tr>
        <tr>
            <th>Estado:</th>
            <th><input type="text" name="fornecedor_estado" required onkeypress="mascara(this, text)"></th>
        </tr>
        <tr>
            <th>Cidade:</th>
            <th><input type="text" name="fornecedor_cidade" required onkeypress="mascara(this, text)"></th>
        </tr>
        <tr>
            <th>Bairro:</th>
            <th><input type="text" name="fornecedor_bairro" required onkeypress="mascara(this, text)"></th>
        </tr>
        <tr>
            <th>Rua:</th>
            <th><input type="text" name="fornecedor_rua"></th>
        </tr>
        <tr>
            <th>Numero:</th>
            <th><input type="text" name="fornecedor_num_rua" required onkeypress="mascara(this, ednum)"></th>
        </tr>
        </table>
    <br><br>
    <div class="botao">
        
        <input class="btn1" type="submit" onclick="return valida" value="Enviar">
        <input class="btn2" type="button" value="Cancelar">
        
    </div>
    </form>
    <br><br>
    <address>
        Vinicius dos Passos - Estudante - Tecnico - Desenvolvimento de Sistemas
    </address>
</div>
</body>
</html>