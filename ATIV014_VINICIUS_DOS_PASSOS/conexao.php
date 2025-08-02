<?php
function conectarBanco() {
    $dsn = "mysql:host=localhost;dbname=empresa;chareet=utf8";
    $usuario = "root";
    $senha = "";
    try{
        $conexao = new PDO($dsn, $usuario, $senha,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $conexao;
    
    } catch (PDOException $e) {
        error_log("Erro ao conectar ao banco:". $e->getMessage());
        // LOG SEM EXPOR ERRO AO USUARIO
        die("ERRO ao conectar ao banco.");
    }
}

?>