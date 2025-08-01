<?php 

    require_once "conexao.php";

    $conexao = conectadb();

    $id_cliente = 1;

    $stmt = $conexao->prepare("DELETE FROM cliente WHERE id_clinete = ?");

    $stmt->bind_param("i",$id_cliente);


    if ($stmt->execute()){
        echo "Cliente atualizado com sucessos!";
    } else {
        echo "Erro ao atualizar cliente: ".$stmt->error;
    }

    $stmt->close();
    $conexao->close();
?>