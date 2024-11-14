<?php
include_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
   
    // Atualiza a entrada com os novos dados
    $stmt = $pdo->prepare("DELETE FROM entradas WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Retorna uma resposta de sucesso como JSON
        echo json_encode(['status' => 'success', 'message' => 'Entrada excluída com sucesso!']);
    } else {
        // Retorna uma resposta de erro como JSON
        echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir a entrada.']);
    }
}
?>
