<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$error = false;
if(isset($_GET['error'])){
   $error =  $_GET['error'];
}

include 'include/db.php'; 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cantina HUB</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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
<?php if (isset($error) && $error == true): ?>
    <div class="alert alert-danger">
        O cadastro não pode ser realizado, verifique os dados informados.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<h1 class="text-center" style="color: #38686a;">Lista de Clientes</h1>
    <button class="btn btn-primary mb-2" style="background-color: #38686a;" data-toggle="modal" data-target="#addClientModal">Adicionar Cliente</button>
    <table class="table table-bordered" id="tabela-clientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ano</th>
                <th>Curso</th>
                <th>Limite</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM clientes");
            while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['nome']}</td>
                        <td>{$client['email']}</td>
                        <td>{$client['ano']}</td>
                        <td>{$client['curso']}</td>
                        <td>{$client['limite']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm edit-btn' data-id='{$client['id']}' data-nome='{$client['nome']}' data-email='{$client['email']}' data-ano='{$client['ano']}' data-curso='{$client['curso']}' data-limite='{$client['limite']}' data-responsavel='{$client['responsavel']}' data-telefone='{$client['telefone']}' data-toggle='modal' data-target='#editClientModal'>Editar</button>
                            <a href='crud/delete_client.php?id={$client['id']}' class='btn btn-danger btn-sm'>Excluir</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para Adicionar Cliente -->
<div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="crud/add_client.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ano</label>
                        <input type="text" name="ano" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Limite</label>
                        <input type="text" name="limite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Responsável</label>
                        <input type="text" name="responsavel" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #38686a;">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Cliente -->
<div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="crud/edit_client.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="id" id="edit-cliente-id">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" id="edit-cliente-nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-cliente-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ano</label>
                        <input type="text" name="ano" id="edit-cliente-ano" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso" id="edit-cliente-curso" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Limite</label>
                        <input type="text" name="limite" id="edit-cliente-limite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Responsável</label>
                        <input type="text" name="responsavel" id="edit-cliente-responsavel" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" id="edit-cliente-telefone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #38686a;">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Preenche o modal de edição com os dados do cliente selecionado
    $(document).on('click', '.edit-btn', function() {
        $('#edit-cliente-id').val($(this).data('id'));
        $('#edit-cliente-nome').val($(this).data('nome'));
        $('#edit-cliente-email').val($(this).data('email'));
        $('#edit-cliente-ano').val($(this).data('ano'));
        $('#edit-cliente-curso').val($(this).data('curso'));
        $('#edit-cliente-limite').val($(this).data('limite'));
        $('#edit-cliente-responsavel').val($(this).data('responsavel'));
        $('#edit-cliente-telefone').val($(this).data('telefone'));
        
    });

    //new DataTable('#tabela-clientes');

    $(document).ready(function() {
        $('#tabela-clientes').DataTable({
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