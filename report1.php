<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'include/db.php';

$orderBy = $_GET['orderby'] ?? 'nome'; // Campo padrão de ordenação
$orderDir = $_GET['orderdir'] ?? 'asc'; // Direção padrão de ordenação
$orderDir = $orderDir === 'asc' ? 'desc' : 'asc'; // Alterna a direção de ordenação

// Consulta de clientes com ordenação
$sql = "SELECT 
            c.id AS cliente_id,
            c.nome,
            c.ano,
            c.curso,
            c.responsavel,
            c.telefone,
            c.limite,
            COALESCE(SUM(e.valor), 0) AS gastos,
            c.limite - COALESCE(SUM(e.valor), 0) AS saldo
        FROM 
            clientes c
        LEFT JOIN 
            entradas e ON c.id = e.cliente_id
        GROUP BY 
            c.id, c.nome, c.limite";
    
$stmt = $pdo->prepare("SELECT * FROM clientes ORDER BY $orderBy $orderDir");
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #38686a;">
    <a class="navbar-brand" href="index.php">Cantina HUB</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Página Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center" style="color: #38686a;">Relatório de Clientes</h1>
    
    <table class="table table-bordered mt-4" id='tabela-relatorio'>
        <thead class="table table-bordered">
            <tr>
                <th><a href="?orderby=id&orderdir=<?= $orderDir ?>">ID</a></th>
                <th><a href="?orderby=nome&orderdir=<?= $orderDir ?>">Nome</a></th>
                <th><a href="?orderby=ano&orderdir=<?= $orderDir ?>">Ano</a></th>
                <th><a href="?orderby=curso&orderdir=<?= $orderDir ?>">Curso</a></th>
                <th><a href="?orderby=limite&orderdir=<?= $orderDir ?>">Limite</a></th>
                <th><a href="?orderby=responsavel&orderdir=<?= $orderDir ?>">Nome do Responsável</a></th>
                <th><a href="?orderby=telefone&orderdir=<?= $orderDir ?>">Telefone do Responsável</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['id']) ?></td>
                    <td><?= htmlspecialchars($client['nome']) ?></td>
                    <td><?= htmlspecialchars($client['ano']) ?></td>
                    <td><?= htmlspecialchars($client['curso']) ?></td>
                    <td><?= htmlspecialchars($client['limite']) ?></td>
                    <td><?= htmlspecialchars($client['responsavel']) ?></td>
                    <td><?= htmlspecialchars($client['telefone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    //new DataTable('#tabela-relatorio');
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script SRC="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</body>
</html>
