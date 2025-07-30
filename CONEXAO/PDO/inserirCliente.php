<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadasstro de Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadasstro de Cliente</h2>
    <form action="processarinsercao.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>
        <br><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <button type="submit" >Cadasstro de Cliente</button>
        


    </form>
</body>
</html>