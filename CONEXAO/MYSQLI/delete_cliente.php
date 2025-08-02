<?php 

    require_once "conexao.php";

    $conexao = conectadb();

    $id_cliente = 1;

    $stmt = $conexao->prepare("DELETE FROM cliente WHERE id_clinete = ?");

    $stmt->bind_param("i",$id_cliente);


    if ($stmt->execute()){
        echo "Cliente deletado com sucessos!";
    } else {
        echo "Erro ao deletar cliente: ".$stmt->error;
    }

    $stmt->close();
    $conexao->close();
?>