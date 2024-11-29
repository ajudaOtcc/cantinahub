<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'include/db.php';

// Consulta de clientes com ordenação
$sql = "SELECT 
            c.id,
            c.nome,
            c.ano,
            c.curso,
            c.responsavel,
            c.telefone,
            c.limite,
            COALESCE(SUM(e.valor), 0) AS gastos,
            c.limite - COALESCE(SUM(e.valor), 0) AS creditos
        FROM 
            clientes c
        LEFT JOIN 
            entradas e ON c.id = e.cliente_id
        GROUP BY 
            c.id, c.nome, c.limite";
    
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

//$saldo = $client['saldos'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cantina Hub</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #38686a;">
    <a class="navbar-brand" href="index.php">Cantina Hub</a>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Página Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="client.php">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="entry.php">Entradas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">Relatório</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="suporte.php">Suporte</a>
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
                <th>ID</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Curso</th>
                <th>Nome do Responsável</th>
                <th>Telefone do Responsável</th>
                <th>Limite</th>
                <th>Gastos</th>
                <th>Crédito</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): 
                // Define a classe CSS com base no valor de total_valor
                $valorClasse = ($client['creditos'] < 0) ? 'negative-value' : 'positive-value';
            ?>
                
                <tr>
                    <td><?= htmlspecialchars($client['id']) ?></td>
                    <td><?= htmlspecialchars($client['nome']) ?></td>
                    <td><?= htmlspecialchars($client['ano']) ?></td>
                    <td><?= htmlspecialchars($client['curso']) ?></td>
                    <td><?= htmlspecialchars($client['responsavel']) ?></td>
                    <td><?= htmlspecialchars($client['telefone']) ?></td>
                    <td><?= htmlspecialchars($client['limite']) ?></td>
                    <td><?= htmlspecialchars($client['gastos']) ?></td>
                    <td>
                        <span class="<?= $valorClasse ?>">
                            <?= number_format($client['creditos'], 2, ',', '.') ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    //new DataTable('#tabela-relatorio');
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabela-relatorio').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 20, 50, 100]
    });
});
</script>
</body>
</html>
