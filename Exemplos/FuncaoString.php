<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $vogais = array("a","e","i","o","u",
                    "A","E","I","O","U");
    echo "Hollo World of PHP <br>";
    $cons = str_replace($vogais,"", "Hello World og PHP");
    echo "Consoantes: ".$cons,"<br>";

    $test = "Hello World<br>";
    print "Posição da letra 'o': ";
    print strpos($test, "o")."<hr>";
    print "Posição da letra 'o' após 5º: ";
    print strpos($test, "o", 5)."<hr>";
    $message = "troca letra uma a uma";
    echo $message."<br>";
    $new_mensage = strtr($message, "abcdef", "123456");
    echo "Criptogrando: ".$new_mensage."<br>";
    $new_mensage = strtr($message, "123456", "abcdef");
    echo "Descriptogrando: ".$new_mensage."<br>";
    

    ?>
</body>
</html>