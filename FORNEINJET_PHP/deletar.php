<?php
include 'includes/conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Primeiro, verifique se há endereços associados
        $sql_check = "SELECT COUNT(*) FROM EnderecoFuncionario WHERE ID_Funcionario=?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([$id]);
        $count = $stmt_check->fetchColumn();
        
        if ($count > 0) {
            // Se houver endereços, delete-os primeiro
            $sql_delete_endereco = "DELETE FROM EnderecoFuncionario WHERE ID_Funcionario=?";
            $stmt_endereco = $pdo->prepare($sql_delete_endereco);
            $stmt_endereco->execute([$id]);
        }
        
        // Depois delete o funcionário
        $sql = "DELETE FROM Funcionario WHERE ID_Funcionario=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        die("Erro ao deletar: " . $e->getMessage());
    }
}

header("Location: ler.php");
exit;