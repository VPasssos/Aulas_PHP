<?php 

$host = 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';

try{
    // CONEXAO COM O BANCO PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // RECUPERA TODOS OS FUNCIONARIOS DO BANCO DE DADOS

    $sql = "SELECT id, nome FROM funcionarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); // BUSSCA TODOS OS RESULTADO COMO UMA MATRIZ DE ASSOCTATIVA

    // VERIFICA SE DOI SOLICITADO A ESCLUSAO DE UM FUNCIONARIO
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['excluir_id'])){
        $excluir_id = $_POST['excluir_id'];
        $sql_exluir = "DELETE FROM funcionarios where id=:id";
        $stmt_excluir = $pdo->prepare($sql_exluir);
        $stmt_excluir->bindParam('id',$excluir_id,PDO::PARAM_INT);
        $stmt_excluir->execute();

        // REDIRECIONA PARA EVITAR REENVIO DO FORMULARIO
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}catch (PODException $e){
    echo "Erro: ".$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Funcionario</title>
</head>
<body>
    <h1>Consulta de Funcionario</h1>
    <ul>
    <?php foreach($funcionarios as $funcionario):?>
        <li>
            <!-- CODIGO ABAIXO CRIA LINK PARA VISUALIZAR DETALHES DO FUNCIONARIO -->
            <a href="visualizar_funcionarios.php? id=<?=$funcionario['id']?>">
                <?= htmlspecialchars($funcionario['nome'])?>
            </a>
            <!-- FORMULARIO PARA EXCLUIR FUNCIONARIOS -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="excluir_id" value="<?=$funcionario['id']?>">
                <button type ="submit">Excluir</button>
            </form>   
        </li>
        <?php endforeach; ?>


    </ul>
</body>
</html>