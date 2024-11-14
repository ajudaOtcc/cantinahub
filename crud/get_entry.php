<?php
include_once '../include/db.php';

$id = $_GET['id'];

// Consulta para obter os dados da entrada com o ID especificado
$stmt = $pdo->prepare("SELECT * FROM entradas WHERE id = ?");
$stmt->execute([$id]);
$entry = $stmt->fetch(PDO::FETCH_ASSOC);

if ($entry) {
    // Retorna os dados da entrada como JSON
    echo json_encode($entry);
} else {
    // Retorna uma resposta de erro se a entrada não for encontrada
    echo json_encode(['status' => 'error', 'message' => 'Entrada não encontrada.']);
}
?>