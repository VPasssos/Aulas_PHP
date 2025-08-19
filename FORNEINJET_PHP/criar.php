<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $permissao = $_POST['permissao'];
    $situacao = $_POST['situacao'];
    $data_admissao = $_POST['data_admissao'];

    try {
        $sql = "INSERT INTO Funcionario (nome, cargo, telefone, email, usuario, senha, permissao, situacao, data_admissao) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cargo, $telefone, $email, $usuario, $senha, $permissao, $situacao, $data_admissao]);
        
        echo "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>

<h2>Novo Funcionário</h2>
<form method="post">
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Cargo:</label>
        <input type="text" name="cargo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Usuário:</label>
        <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Permissão:</label>
        <select name="permissao" class="form-control" required>
            <option value="admin">Administrador</option>
            <option value="usuario">Usuário</option>
            <option value="gestor">Gestor</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Situação:</label>
        <select name="situacao" class="form-control" required>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Data de Admissão:</label>
        <input type="date" name="data_admissao" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
</div>
</body>
</html>