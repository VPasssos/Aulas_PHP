<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<br>";
    $AmazomProduto = array(
        array("Codigo" => "Livro", "Descreção" => "Livros", "Preço" => 50),
        array("Codigo" => "DvDs", "Descreção" => "Filmes", "Preço" => 15),
        array("Codigo" => "CDs", "Descreção" => "Musicas", "Preço" => 20));
    for ($linha = 0; $linha < 3; $linha++){ ?>
    <p> | <?= $AmazomProduto[$linha]["Codigo"] ?>
        | <?= $AmazomProduto[$linha]["Descreção"] ?>
        | <?= $AmazomProduto[$linha]["Preço"] ?>
    </p>

    <?php   
    }
    ?>
</body>
</html>