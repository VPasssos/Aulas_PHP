<?php
session_start(); // Inicia a sessão para armazenar os dados

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cria um array com os dados do fornecedor
    $fornecedor = array(
        'nome' => $_POST['fornecedor_nome'],
        'cnpj' => $_POST['fornecedor_cnpj'],
        'telefone' => $_POST['fornecedor_telefone'],
        'email' => $_POST['fornecedor_email'],
        'website' => $_POST['fornecedor_website'],
        'cep' => $_POST['fornecedor_cep'],
        'estado' => $_POST['fornecedor_estado'],
        'cidade' => $_POST['fornecedor_cidade'],
        'bairro' => $_POST['fornecedor_bairro'],
        'rua' => $_POST['fornecedor_rua'],
        'num_rua' => $_POST['fornecedor_num_rua']
    );

    // Verifica se a variável de sessão 'fornecedores' existe, senão cria um array vazio
    if (!isset($_SESSION['fornecedores'])) {
        $_SESSION['fornecedores'] = array();
    }

    // Adiciona o fornecedor à lista na sessão
    $_SESSION['fornecedores'][] = $fornecedor;
    
    // Redireciona para a página de exibição
    header("Location: fornecedores.php");
    exit();
}
?>
