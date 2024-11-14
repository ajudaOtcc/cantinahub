<?php
include_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Captura os dados enviados pelo formulário
    $id = $_GET['id'];

    // Prepara a consulta para atualizar os dados do cliente
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);

    // Redireciona de volta para a página principal após a atualização
    header('Location: ../index.php');
    exit();
}
?>