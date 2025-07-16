<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $nota = 2;

    $situacao = ($nota >= 7);
    
    if ($situacao)
    {
        echo "Aprovado<br>";
    }
    
    $situacao = ($nota < 7 & nota > 3);

    if ($situacao)
    {
        echo "Recuperação<br>";
    }
        
    $situacao = ($nota < 3);
    
    if ($situacao)
    {
        echo "Repovado<br>";
    }

    ?> 
</body>
</html>