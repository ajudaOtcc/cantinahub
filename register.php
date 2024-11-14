<?php
session_start();
include 'include/db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nome'];
    $password = $_POST['senha'];
    $confirm_password = $_POST['confirma_senha'];

    if ($password !== $confirm_password) {
        $error = "As senhas não coincidem.";
    } else {
        // Verifica se o nome de usuário já existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) {
            $error = "Nome de usuário já existe. Escolha outro.";
        } else {
            // Hash da senha e inserção no banco de dados
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, senha) VALUES (?, ?)");
            
            if ($stmt->execute([$username, $hashed_password])) {
                $success = "Usuário registrado com sucesso!";
            } else {
                $error = "Erro ao registrar usuário. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Registrar Novo Usuário</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?> <a href="login.php"><b> Faça seu login no sistema! </b></a></div>
    <?php endif; ?>
    
    <form action="register.php" method="post">
        <div class="form-group">
            <label>Nome de Usuário</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Confirmar Senha</label>
            <input type="password" name="confirma_senha" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary" style="background-color: #38686a;">Registrar</button>
    </form>
</div>
</body>
</html>
