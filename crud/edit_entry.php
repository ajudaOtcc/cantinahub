<?php
session_start();
include_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cliente_id = $_POST['cliente_id'];
    $valor = $_POST['valor'];

    // Atualiza a entrada com os novos dados
    $stmt = $pdo->prepare("UPDATE entradas SET cliente_id = ?, valor = ? WHERE id = ?");
    if ($stmt->execute([$cliente_id, $valor, $id])) {
        // Retorna uma resposta de sucesso como JSON
        echo json_encode(['status' => 'success', 'message' => 'Entrada atualizada com sucesso!']);
    } else {
        // Retorna uma resposta de erro como JSON
        echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar entrada.']);
    }
}
?>