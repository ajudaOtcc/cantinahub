<?php
session_start();
include 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nome'];
    $password = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['senha'])) {
        // Autenticação bem-sucedida
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        // Autenticação falhou
        $error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<h2 class="text-center" style="margin-top: 50px;">Login</h2>
<div class="container mt-5" style="margin-left:450px; ">
    
    <form action="login.php" method="post" class="form-signin">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="form-group" style="width: 500px;">
            <label>Nome de Usuário</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group" style="width: 500px;">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
       
        <button type="submit" class="btn btn-primary btn-block" style="background-color: #38686a;width: 500px;">Entrar</button>
    </form>
</div>
</body>
</html>
