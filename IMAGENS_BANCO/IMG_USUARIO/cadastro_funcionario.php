<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">

        <h1>Cadastro</h1>
        <h2>Funcionario</h2>

        <!-- FORMULARIO PARA CADASTRAR UM FUNCIONARIO -->

        <form action="salvar_funcionario" method="POST" endtype="multipart/form-data">

            <label for="name">Nome: </label>
            <input type="text" name="nome" id="nome" required><br><br>

            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" required><br><br>

            <label for="foto">Foto: </label>
            <input type="file" name="foto" id="foto" required><br><br>

            <button type="submit">CADASTRAR</button>


        </form>
    </div>
</body>
</html>