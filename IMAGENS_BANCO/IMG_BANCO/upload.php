<?php
    require_once 'conecta.php';

    // OBTÉM OS DADOS ENVIADOS PELO FORMULÁRIO
    $evento = $_POST['evento'];
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem']['tmp_name'];
    $tamanho = $_FILES['imagem']['size']; // TAMANHO DA IMAGEM POR 'size'
    $tipo = $_FILES['imagem']['type']; // TIPO DA IMAGEM POR 'type'
    $nome = $_FILES['imagem']['name']; // NOME DA IMAGEM POR 'name'

    // VERIFICA SE O ARQUIVO FOI ENVIADO CORRETAMENTE
    if(!empty($imagem) && $tamanho > 0) {
        // LÊ O CONTEÚDO DO ARQUIVO
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, filesize($imagem));
        fclose($fp);
    
        // PROTEGE CONTRA PROBLEMAS DE CARACTÉRES NO SQL
        $conteudo = mysqli_real_escape_string($conexao, $conteudo);
    
        // INSERE OS DADOS NO BD
        $query_insercao = "INSERT INTO tabela_imagens(evento, descricao, nome_imagem, tamanho_imagem, tipo_imagem, imagem) 
                        VALUES ('$evento', '$descricao', '$nome', '$tamanho', '$tipo', '$conteudo')";

        $resultado = mysqli_query($conexao, $query_insercao);

        // VERIFICA SE A INSERÇÃO FOI BEM-SUCEDIDA
        if ($resultado) {
            echo 'Registro inserido com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            die("Erro ao inserir no banco: ".$mysqli_error($conexao));
        }
    } else {
        echo "Erro: Nenhuma imagem foi enviada.";
    }
?> 