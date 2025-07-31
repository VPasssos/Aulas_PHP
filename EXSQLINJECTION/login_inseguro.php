<?php

    $Servidor = "localhost";
    $Usuario = "root";
    $Senha = "";
    $Banco = "empresa_teste";

    $conexao = mysqli_connect ($Servidor, $Usuario, $Senha, $Banco);
        if ($conexao->connect_error) {
            die("Erro de conexão:".$conexao->connect_error);
        }

    $nome =$_POST["nome"];

    $sql = "SELECT * FROM cliente_teste WHERE nome = '$nome'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0){
        header("Location: area_restrita.php");
        exit();
        
    }else {
        echo "Nome não encontrado.";
    }
$conexao->close();


?>