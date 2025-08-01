<?php 

    require_once "conexao.php";

    $conexao = conectadb();

    $sql = "SELECT id_cliente, nome, email FROM cliente";

    $result = $conexao->query($sql);

    if ($result->num_rows > 0){
        while ($linha = $result->fetch_assoc()){
            echo "ID", $linha["id_cliente"].".Nome:".$linha["nome"].".Email".$linha["email"]."</br>"; 
        }
    } else{
        echo "Nenhum resultado encontrado:";
    }
    $conexao->close();
?>