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

    $stmt = $conexao->prepare("SELECT * FROM cliente_teste WHERE nome= ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0){
        header("Location: area_restrita.php");
        exit();
        
    }else {
        echo "Nome não encontrado.";
    }
$stmt->close();
$conexao->close();


?>