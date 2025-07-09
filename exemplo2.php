<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    //Função usada para definir fuso horario padão date_default_timezone_ser('America/Los_Angeçes');
    //Manipulando HTML e PHP
    $data_hoje = date ("d/m/y", time());
        
    ?>

    <p align="center">Hoje é dia <?php echo $data_hoje ;?></p>
</body>
</html>