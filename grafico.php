<?php
include 'include/db.php';

// Consulta para agrupar entradas por data
$sql = "
SELECT 
    DATE(criado_em) AS data_entrada, 
    SUM(valor) AS total_valor 
FROM 
    entradas
GROUP BY 
    DATE(criado_em)
ORDER BY 
    data_entrada ASC;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$entradas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cantina HUB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #38686a;">
    <a class="navbar-brand" href="index.php">Cantina HUB</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
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
                <a class="nav-link" href="logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2>Gráfico de Linha de Entradas Diárias</h2>
    <canvas id="entradasChart1" width="400" height="200"></canvas>
</div>
<div class="container mt-4">
    <h2>Gráfico de Barras de Entradas Diárias</h2>
    <canvas id="entradasChart2" width="400" height="200"></canvas>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script SRC="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Passando os dados PHP para JavaScript
const dataEntradas = <?= json_encode(array_column($entradas, 'data_entrada')) ?>;
const valorEntradas = <?= json_encode(array_column($entradas, 'total_valor')) ?>;

document.addEventListener('DOMContentLoaded', () => {
    // Configuração do gráfico
    const ctx = document.getElementById('entradasChart1').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line', // Tipo do gráfico: linha
        data: {
            labels: dataEntradas, // Datas das entradas
            datasets: [{
                label: 'Entradas Diárias',
                data: valorEntradas, // Valores das entradas
                borderColor: '#38686a', // Cor da linha
                backgroundColor: 'rgba(56, 104, 106, 0.2)', // Cor do preenchimento
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `R$ ${context.raw.toFixed(2).replace('.', ',')}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Datas'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Valores (R$)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Configuração do gráfico de barras
    const ctx = document.getElementById('entradasChart2').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar', // Tipo do gráfico: barras
        data: {
            labels: dataEntradas, // Datas das entradas
            datasets: [{
                label: 'Entradas Diárias (R$)',
                data: valorEntradas, // Valores das entradas
                backgroundColor: 'rgba(56, 104, 106, 0.8)', // Cor das barras
                borderColor: '#38686a', // Cor das bordas
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `R$ ${context.raw.toFixed(2).replace('.', ',')}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Datas'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Valores (R$)'
                    },
                    beginAtZero: true // Começa o eixo Y no zero
                }
            }
        }
    });
});
</script>
</body>
</html>