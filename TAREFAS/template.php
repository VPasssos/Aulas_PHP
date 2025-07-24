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
    <f-orm action="" method="">
        <fieldset>
            <legend>Nova Tarefa</legend>
            <label>
                Tarefa:
                <br>
                <input type="text" name="nome">
                <br>
            </label>
            <label>
                Descrição (Opicional):
                <br>
                <textarea name="descricao"></textarea>
                <br>
            </label>
            <label>
                Preazo (Opicional):
                <br>
                <input type="text" name="prazo">
                <br>
            </label>
            <fieldset>
                <legend>Prioridade</legend>
                    <label>
                        <input type="radio" name="prioridade" value="baixa" checkdate />
                        Baixa
                        <input type="radio" name="prioridade" value="medio"/>
                        Médio
                        <input type="radio" name="prioridade" value="alta"/>
                        Alta
                    </label>
            </fieldset>
            <label>
                Tarefa Comcluida:
                <input type="checkbox" name="concluida" value="sim">
            </label>
            
            <input type="submit" value="Cadastrar">
        </fieldset>
    </form>
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