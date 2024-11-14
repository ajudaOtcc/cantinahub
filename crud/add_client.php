<?php 
include_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados enviados pelo formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $ano = $_POST['ano'];
    $curso = $_POST['curso'];
    $limite = $_POST['limite'];
    $responsavel = $_POST['responsavel'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, ano, curso, limite, responsavel, telefone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    

    if ($stmt->execute([$nome, $email, $ano, $curso, $limite, $responsavel, $telefone])) {
        // Redireciona de volta para a página principal após a atualização
        header('Location: ../client.php');
        exit();
    } else {
        header('Location: ../client.php?error=true');
        exit();
    }

   
}

?>

