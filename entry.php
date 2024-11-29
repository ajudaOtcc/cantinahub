<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include_once 'include/db.php';


$entries = $pdo->query("SELECT entradas.*, clientes.nome as cliente_nome FROM entradas JOIN clientes ON entradas.cliente_id = clientes.id")->fetchAll(PDO::FETCH_ASSOC);
$clientes = $pdo->query("SELECT id, nome FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #38686a;">
    <a class="navbar-brand" href="index.php">Cantina Hub</a>
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
                <a class="nav-link" href="suporte.php">Suporte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-4">


<div class="container mt-5">
<h1 class="text-center" style="color: #38686a;">Lista de Entradas</h1>
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addEntryModal">Adicionar Entrada</button>
    <table class="table table-bordered" id='tabela-entrada'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="entriesTable">
            <?php foreach ($entries as $entry): ?>
                <tr data-id="<?= $entry['id'] ?>">
                    <td><?= $entry['id'] ?></td>
                    <td><?= htmlspecialchars($entry['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars(number_format($entry['valor'], 2, ',', '.')) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $entry['id'] ?>">Editar</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $entry['id'] ?>" >Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para Adicionar Entrada -->
<div class="modal fade" id="addEntryModal" tabindex="-1" aria-labelledby="addEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEntryForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEntryModalLabel">Adicionar Entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="cliente_id" class="form-control" id="cliente_id" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="number" name="valor" class="form-control" step="0.05" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Entrada -->
<div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="editEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEntryForm">
                <input type="hidden" name="id" id="editEntryId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEntryModalLabel">Editar Entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="cliente_id" id="editClienteId" class="form-control" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="number" name="valor" id="editValor" class="form-control" step="0.05" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// Adicionar nova entrada
$('#addEntryForm').submit(function(e) {
    e.preventDefault();
    $.post('crud/add_entry.php', $(this).serialize(), function(data) {
        $('#addEntryModal').modal('hide');
        location.reload();
    });
});

// Editar entrada - preencher dados no modal
$('.edit-btn').click(function() {
    var id = $(this).data('id');
    $.get('crud/get_entry.php', { id: id }, function(data) {
        $('#editEntryId').val(data.id);
        $('#editClienteId').val(data.cliente_id);
        $('#editValor').val(data.valor);
        $('#editEntryModal').modal('show');
    }, 'json');
});

// Salvar alterações na entrada
$('#editEntryForm').submit(function(e) {
    e.preventDefault();
    $.post('crud/edit_entry.php', $(this).serialize(), function(data) {
        $('#editEntryModal').modal('hide');
        location.reload();
    });
});

// Excluir entrada
$('.delete-btn').click(function() {
    if (confirm('Tem certeza que deseja excluir?')) {
        var id = $(this).data('id');
        $.post('crud/delete_entry.php', { id: id }, function(data) {
            location.reload();
        });
    }
});

$(document).ready(function() {
    $('#cliente_id').select2();
});

$(document).ready(function() {
    $('#tabela-entrada').DataTable({
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