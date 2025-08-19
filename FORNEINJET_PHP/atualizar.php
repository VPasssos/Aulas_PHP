<?php 
include 'includes/cabecalho.php'; 
include 'includes/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $permissao = $_POST['permissao'];
    $situacao = $_POST['situacao'];
    $data_admissao = $_POST['data_admissao'];

    // Verifica se a senha foi alterada
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    try {
        if ($senha) {
            $sql = "UPDATE Funcionario SET nome=?, cargo=?, telefone=?, email=?, usuario=?, senha=?, permissao=?, situacao=?, data_admissao=? WHERE ID_Funcionario=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cargo, $telefone, $email, $usuario, $senha, $permissao, $situacao, $data_admissao, $id]);
        } else {
            $sql = "UPDATE Funcionario SET nome=?, cargo=?, telefone=?, email=?, usuario=?, permissao=?, situacao=?, data_admissao=? WHERE ID_Funcionario=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cargo, $telefone, $email, $usuario, $permissao, $situacao, $data_admissao, $id]);
        }

        echo "<div class='alert alert-success'>Atualizado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao atualizar: " . $e->getMessage() . "</div>";
    }
}

$sql = "SELECT * FROM Funcionario WHERE ID_Funcionario=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$f = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Editar Funcionário</h2>
<form method="post">
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?= $f['nome'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Cargo:</label>
        <input type="text" name="cargo" class="form-control" value="<?= $f['cargo'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control" value="<?= $f['telefone'] ?>">
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="<?= $f['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Usuário:</label>
        <input type="text" name="usuario" class="form-control" value="<?= $f['usuario'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Nova Senha (deixe em branco para manter a atual):</label>
        <input type="password" name="senha" class="form-control">
    </div>
    <div class="mb-3">
        <label>Permissão:</label>
        <select name="permissao" class="form-control" required>
            <option value="admin" <?= $f['permissao'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="usuario" <?= $f['permissao'] == 'usuario' ? 'selected' : '' ?>>Usuário</option>
            <option value="gestor" <?= $f['permissao'] == 'gestor' ? 'selected' : '' ?>>Gestor</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Situação:</label>
        <select name="situacao" class="form-control" required>
            <option value="ativo" <?= $f['situacao'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
            <option value="inativo" <?= $f['situacao'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Data de Admissão:</label>
        <input type="date" name="data_admissao" class="form-control" value="<?= $f['data_admissao'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>
</div>
</body>
</html>