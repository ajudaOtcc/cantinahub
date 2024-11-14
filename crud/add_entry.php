<?php
include_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $valor = $_POST['valor'];

    // Insere uma nova entrada no banco de dados
    $stmt = $pdo->prepare("INSERT INTO entradas (cliente_id, valor) VALUES (?, ?)");
    if ($stmt->execute([$cliente_id, $valor])) {
        // Retorna uma resposta de sucesso como JSON
        echo json_encode(['status' => 'success', 'message' => 'Entrada adicionada com sucesso!']);
    } else {
        // Retorna uma resposta de erro como JSON
        echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar entrada.']);
    }
}
?>
