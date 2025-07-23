<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>
    <!-- Aqui irá o restante dos códigos... -->
    <form action="" method="">
        <fieldset>
            <legend>Nova Tarefa</legend>
            <label>
                Tarefa:
                <input type="text" name="nome">
            </label>
            <input type="submit" value="Cadastrar">
        </fieldset>
    </form>

    <?php
        $lista_tarefas = array();
        if (isset($_GET['nome'])) {
            $_SESSION['lista_tarefas'][] = $_GET['nome'];

        }

        $lista_tarefas = array();
        if (isset($_SESSION['lista_tarefas'])) {
            $lista_tarefas = $_SESSION['lista_tarefas'];
        }
    ?>

    <table>
        <tr>
            <th>Tarefas</th>
        </tr>

        <?php foreach ($lista_tarefas as $tarefa) : ?>

        <tr>
            <td><?php echo $tarefa; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>