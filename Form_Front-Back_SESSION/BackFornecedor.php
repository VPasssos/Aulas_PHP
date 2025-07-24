<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<?php
   
    $formforn = array();
    if (
        isset($_GET["fornecedor_nome"]) && isset($_GET["fornecedor_cnpj"]) && isset($_GET["fornecedor_telefone"])
        && isset($_GET["fornecedor_email"]) && isset($_GET["fornecedor_website"])
        && isset($_GET["fornecedor_cep"]) && isset($_GET["fornecedor_estado"]) && isset($_GET["fornecedor_cidade"])
        && isset($_GET["fornecedor_bairro"]) && isset($_GET["fornecedor_rua"]) && isset($_GET["fornecedor_num_rua"])
    ) {
        $_SESSION['formforn'][] = $_GET["fornecedor_nome"];
        $_SESSION['formforn'][] = $_GET["fornecedor_cnpj"];
        $_SESSION['formforn'][] = $_GET["fornecedor_telefone"];
        $_SESSION['formforn'][] = $_GET["fornecedor_email"];
        $_SESSION['formforn'][] = $_GET["fornecedor_website"];
        $_SESSION['formforn'][] = $_GET["fornecedor_cep"];
        $_SESSION['formforn'][] = $_GET["fornecedor_estado"];
        $_SESSION['formforn'][] = $_GET["fornecedor_cidade"];
        $_SESSION['formforn'][] = $_GET["fornecedor_bairro"];
    }
    $formforn = array();
    if (isset($_SESSION['formforn'])) {

        $formforn = $_SESSION['formforn'];


    }

?>

    <table>
        <tr>
            <th>
                <h1>INFORMAÇÔES DO FORNECEDOR</h1>
            </th>
        </tr>
        <?php foreach ($formforn as $echoforn)
        : ?>
            <tr>
                <td><?php echo $echoforn; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>