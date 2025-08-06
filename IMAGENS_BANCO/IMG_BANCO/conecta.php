<?php

# DEFINIÇÃO DAS CREDENCIAIS DE CONEXÂO

$servidorname = "localhost";
$username = "root";
$password = "";
$dbname = "armazena_imagem";

// CRIANDO A CONEXAO USANDO MYSQLI

$conexao = new mysqli($servidorname, $username, $password, $dbname);

// VERIFICANDO SE TEVE ERRO NA CONEXÂO

if($conexao->connect_error){
    die("FALHA NA CONEXAO".$conexao->connect_error);
}

?>