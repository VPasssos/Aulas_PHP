<?php
include 'includes/conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM funcionarios WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: ler.php");
exit;
