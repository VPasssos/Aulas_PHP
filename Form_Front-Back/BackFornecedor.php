<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>INFORMAÇÔES DO FORNECEDOR</h1>
    <?php
        echo "Nome: ".$_GET["fornecedor_nome"];
        echo "<br>";
        echo "CNPJ: ".$_GET["fornecedor_cnpj"];
        echo "<br>";
        echo "Telefone: ".$_GET["fornecedor_telefone"];
        echo "<br>";
        echo "Email: ".$_GET["fornecedor_email"];
        echo "<br>";
        echo "Web Site: ".$_GET["fornecedor_website"];
        echo "<br>";
        echo "Cep: ".$_GET["fornecedor_cep"];
        echo "<br>";
        echo "Estado: ".$_GET["fornecedor_estado"];
        echo "<br>";
        echo "Cidade: ".$_GET["fornecedor_cidade"];
        echo "<br>";
        echo "Bairro: ".$_GET["fornecedor_bairro"];
        echo "<br>";
        echo "Rua: ".$_GET["fornecedor_rua"];
        echo "<br>";
        echo "Numero: ".$_GET["fornecedor_num_rua"];
        echo "<br>";
    ?>
</body>
</html>