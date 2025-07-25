<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $name = "teste";
    $name = null;
    
    if (isset($name))
    {
        print "Variavel 'name' com Dados";
    }
    else
    {
        print "Variavel 'name' sem Dados";
    }
    ?>
</body>
</html>