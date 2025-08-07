<?php 

    require ("conecta.php");

    // OBTEM O ID VIA GET GARANTINDO QUE SEJA INTEIRO

    $id_imagem = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // VERIFICA SE O ID É VALIDA (MAIOR QUE ZERO)
    if($id_imagem > 0){
        // CRIA UMA QUERY SEGURA USANDO O PREPARED STATEMENT
        $queryExlusao = "DELETE FROM tabela_imagens FROM codigo = ?";

        // PREPARE A QUERY
        
        $stmt = $conexao->prepare($queryExlusao);
        $stmt->bind_param("i", $id_imagem); // DEFINE O ID COMO UM INTEIRO

        // EXECLUITA A EXCLUISAO
        if($stmt->execute()){
            echo "Imagem excluida com sucesso!";
        }else{
            die("ERRO ao Excluir imagem: ".$stmt->error);
        }
        // FECHA A CONSULTA
    } else {
        echo "ID Invalido!";
    }

    // REDIRECIONA PARA INDEX PHP E GARANTE QUE O SCRIPT PARE
    header("Location: index.php");
    exit();
?>