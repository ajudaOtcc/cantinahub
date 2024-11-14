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

    // Prepara a consulta para atualizar os dados do cliente
    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, email = ?, ano = ?, curso = ?, limite = ?, responsavel = ?, telefone = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $ano, $curso, $limite, $responsavel, $telefone, $id]);

    // Redireciona de volta para a página principal após a atualização
    header('Location: ../index.php');
    exit();
}
?>