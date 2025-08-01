<?php 

    require_once "conexao.php";

    $conexao = conectadb();

    $nome = "Vinicius dos Passos";
    $endereco = "plasd ersadw 11";
    $telefone = "(47) 99987-5122";
    $email = "ViniciusdosPassos@gmail.com";

    $id_cliente = 1;

    $stmt = $conexao->prepare("UPDATE cliente SET nome = ?, endereco = ?, telefone = ?, email = ? WHERE id_cliente = ?");

    $stmt->bind_param("ssssi",$nome,$endereco,$telefone,$email);

    if ($stmt->execute()){
        echo "Cliente atualizado com sucessos!";
    } else {
        echo "Erro ao atualizar cliente: ".$stmt->error;
    }

    $stmt->close();
    $conexao->close();
?>