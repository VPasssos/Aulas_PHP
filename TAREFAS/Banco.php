<?php
    $bdServidor = "127.0.0.1";
    $bdUsuario = "root";
    $bdSenha = "";
    $bdBanco = "viniciuspassos";
    $conexao = mysqli_connect ($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
        if (mysqli_connect_errno()) {
            echo "Problema para conectar ao banco. Verifique os dados.";
            die();
        }
    
             
       
        function buscar_tarefas($conexao)
        {
            $sqlBuscar = 'SELECT * FROM tarefas';
            $resultado = mysqli_query($conexao, $sqlBuscar);
            $tarefas = array();
            while ($tarefa = mysqli_fetch_assoc($resultado))
            {
                $tarefas[] = $tarefa;
            }
        return $tarefas;
        }
    
        function gravar_tarefa ($conexao, $tarefa) {
            $sqlGravar = "
                INSERT INTO tarefa
                (nome, descricao, prioridade, prazo, concluida)
                VALUES
                (
                    '{$tarefa['nome']}',
                    '{$tarefa['descricao']}',
                    '{$tarefa['prioridade']}',
                    '{$tarefa['prazo']}',
                    '{$tarefa['concluida']}'
                )
                ";
            mysqli_query ($conexao,$sqlGravar);
        }
?>