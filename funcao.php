<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nome = "stefanie hatcher";
        $lenght = strlen($nome);
        $cmp = strcmp($nome, "brian le");
        $index = strpos($nome, "e");
        $fist = substr($nome, 9, 5);
        $nome = strtoupper($nome);
        echo("NOME COMPLETO<br>");
        print($nome);
        echo("<br>CONTAGEM DE DIGITOS DO NOME<br>");
        print($lenght);
        echo("<br>COMPARA O &nome COM 'brian le'<br>");
        print($cmp);
        echo("<br>PROCURA DO INDICE DO 'e'<br>");
        print($index);
        echo("<br>UTIMA PARALAVRA DA FRASE<br>");
        print($fist);
    ?>
</body>
</html>