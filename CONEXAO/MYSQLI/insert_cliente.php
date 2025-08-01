<?php 

    require_once "conexao.php";

    $conexao = conectadb();

    $nome = "Vinicius dos Passos";
    $endereco = "plasd erw 11";
    $telefone = "(47) 99987-5122";
    $email = "ViniciusdosPassos@gmail.com";

    $stmt = $conexao->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss",$nome,$endereco,$telefone,$email);

    if ($stmt->execute()){
        echo "Cliente adicionado com sucessos!";
    } else {
        echo "Erro ao adicionar cliente: ".$stmt->error;
    }

    $stmt->close();
    $conexao->close();
        
?>