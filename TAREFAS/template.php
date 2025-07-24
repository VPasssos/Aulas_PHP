<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>     
    <form action="" method="">
        <fieldset>
            <legend>Nova Tarefa</legend>
            <label>
                Tarefa:
                <br>
                <input type="text" name="nome">
                <br>
            </label>
            
            <label>
                Descrição (Opcional):
                <br>
                <textarea name="descricao"></textarea>
                <br>
            </label>
            <label>
                Prazo (Opcional):
                <br>
                <input type="text" name="prazo">
                <br>
            </label>
            <br>
            <fieldset>
                <legend>Prioridade:</legend>
                <label>
                    <input type="radio" name="prioridade" value="baixa" checked/>
                    Baixa
                    <input type="radio" name="prioridade" value="medio" />
                    Média
                    <input type="radio" name="prioridade" value="alta" />
                    Alta
                </label>
                <br>
            </fieldset>

            <label>
                Tarefa concluída:
                <input type="checkbox" name="concluida" value="sim"/>
            </label>

            <input type="submit" value="Cadastrar">
        </fieldset>
    </form>

    <table>
        <tr>
            <th>Tarefas</th>
            <th>Descricao</th>
            <th>Prazo</th>
            <th>Prioridade</th>
            <th>ConcluÍda</th>
        </tr>

        <?php foreach ($lista_tarefas as $tarefa) : ?>

        <tr>
            <td><?php echo $tarefa['nome']; ?></td>
            <td><?php echo $tarefa['descricao']; ?></td>
            <td><?php echo $tarefa['prazo']; ?></td>
            <td><?php echo $tarefa['prioridade']; ?></td>
            <td><?php echo $tarefa['concluida']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>