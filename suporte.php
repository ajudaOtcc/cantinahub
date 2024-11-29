<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'include/db.php'; 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cantina Hub</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
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

<p id="tit">Tutoriais</p><br>

<p class="lh-base"><b>➤ Página Clientes:</b><br>
A Página Clientes do site permite a gestão eficiente dos registros de clientes. Abaixo está uma descrição detalhada de suas funcionalidades: <br><br>
<b>1 - Adicionar Cliente</b><br>

Ao clicar no botão "Adicionar Cliente", um modal será exibido com um formulário.
Os campos obrigatórios a serem preenchidos no formulário são:<br><br>
•Nome do Cliente<br>
•E-mail<br>
•Ano do Curso<br>
•Limite Disponível para Gastos<br>
•Nome do Responsável<br>
•Telefone do Responsável<br><br>
Após preencher todas as informações, clique no botão "Salvar" para concluir a criação da conta. O cliente será adicionado à tabela imediatamente.<br><br>

<b>2 - Gerenciamento de Contas</b><br>

Cada conta criada será exibida em uma tabela, com dois botões ao lado:<br><br>
<b>Editar:</b> Abre o mesmo formulário utilizado na criação, permitindo modificar as informações do cliente. Após realizar as alterações, clique novamente em "Salvar" para confirmar.<br><br>
<b>Excluir:</b> Exclui a conta permanentemente, incluindo todos os dados associados, como registros de entradas de valores. <b>Atenção: Essa ação é irreversível. Certifique-se antes de confirmar.</b><br><br>

<b>3 - Barra de Pesquisa</b><br>

Utilize a barra de pesquisa para localizar rapidamente contas específicas. É possível buscar por:<br><br>
•Nome<br>
•ID<br>
•E-mail<br><br>

<b>4 - Paginação e Exibição</b><br>

Abaixo do botão <b>"Adicionar Cliente"</b>, você encontrará a opção para ajustar o número de resultados exibidos por página. Escolha a quantidade desejada e navegue entre as páginas usando o botão <b>"Próximo"</b>, localizado ao final da tabela.</p><br>



<p class="lh-base"><b>➤ Página Entradas:</b><br>
A Página Entradas é utilizada para gerenciar os registros de compras e pagamentos dos clientes. Abaixo estão os detalhes das suas funcionalidades:<br><br>
<b>1 - Adicionar Entrada</b><br>

1◦ Clique no botão "Adicionar Entrada" para abrir uma janela modal.<br>
2◦ Nesta janela, selecione o cliente desejado na lista e insira o valor da entrada.<br><br>
<b>•Compra Realizada:</b> Insira um valor <b>positivo</b> (ex.: 10). Isso aumentará a dívida do cliente, descontando a quantia informada do saldo disponível.
<br>
•<b>Pagamento Realizado:</b> Insira um valor <b>negativo</b> (ex.: -10). Isso reduzirá a dívida do cliente, adicionando o valor informado ao saldo disponível.
<br><br>

<b>2 - Gerenciamento de Entradas</b><br>

As entradas registradas serão exibidas em uma tabela. Cada registro possui dois botões ao lado:<br><br>

<b>Editar:</b> Abre o mesmo formulário utilizado na criação, permitindo modificar as informações do cliente. Após realizar as alterações, clique novamente em "Salvar" para confirmar.<br><br>
<b>Excluir:</b> Exclui a conta permanentemente, incluindo todos os dados associados, como registros de entradas de valores. <b>Atenção: Essa ação é irreversível. Certifique-se antes de confirmar.</b><br><br>

<b>3 - Barra de Pesquisa</b><br>

Utilize a barra de pesquisa para localizar rapidamente contas específicas. É possível buscar por:<br><br>
•Nome<br>
•ID<br>
•E-mail<br><br>

<b>4 - Paginação e Exibição</b><br>

Abaixo do botão "Adicionar Cliente", você encontrará a opção para ajustar o número de resultados exibidos por página. Escolha a quantidade desejada e navegue entre as páginas usando o botão <b>"Próximo"</b>, localizado ao final da tabela.</p><br>



<p class="lh-base"><b>➤ Página Relatório:</b><br>
A Página Relatório fornece uma visão analítica sobre os gastos dos clientes, apresentando dados financeiros de forma gráfica e clara. Abaixo estão as funcionalidades desta página:<br><br>
<b>1 - Gráfico de Gastos</b><br>

Nesta página, não é possível interagir diretamente com a tabela. Em vez disso, os dados dos clientes são apresentados em formato gráfico.<br>
O gráfico exibe informações detalhadas sobre as contas dos clientes, incluindo:<br><br>

•Limite da Conta<br>
•Quantia Já Gasta<br>
•Saldo Restante<br>
•Saldo Negativo (caso o cliente tenha ultrapassado o limite da conta)
<br><br>

<b>2 - Barra de Pesquisa</b><br>

Assim como nas outras páginas, a barra de pesquisa permite localizar contas específicas.<br><br>
<b>•Observação:</b> Ao digitar <b>"-"</b> (Sinal de Menos) na barra de pesquisa, a tabela exibirá <b>somente</b> as contas com saldos negativos, ou seja, aquelas que ultrapassaram o limite definido.<br><br>

<b>3 - Paginação e Exibição</b><br>

A tabela pode ser visualizada em múltiplas páginas. A opção de visualizar o número de registros por página está disponível, e você pode navegar para as próximas páginas utilizando o botão<b>"Próximo"</b>, localizado abaixo da tabela.</p><br>


<p class="lh-base"><b>➤ Login:</b><br>
A Página de Login foi projetada para garantir a segurança e o acesso exclusivo ao sistema. Abaixo estão as informações detalhadas sobre como o processo de login funciona:<br><br>
<b>1 - Login com Código do Site</b><br>

O login no sistema deve ser realizado utilizando o código do site. Este método de login foi escolhido para garantir que apenas usuários autorizados, como a proprietária da cantina, possam acessar o sistema.<br>
<b>•Nota:</b> Como o projeto foi desenvolvido especificamente para a proprietária da cantina local, não há uma conexão direta do navegador para gerenciar usuários de forma dinâmica. Portanto, a autenticação é realizada diretamente por meio de código.
<br><br>

<b>2 - Suporte e Criação de Novo Usuário</b><br>

•Caso haja algum imprevisto ou falha grave com a conta, ou se a proprietária desejar criar um novo usuário, ela deve entrar em contato com o suporte.<br>
•Os desenvolvedores do sistema serão responsáveis por adicionar manualmente um novo usuário ao código, com o nome e senha escolhidos pela proprietária.<br>
•Para isso, a equipe de suporte fará a modificação necessária no código-fonte, criando o novo usuário e fornecendo as credenciais desejadas.<br><br>

A Página de Login oferece uma camada extra de segurança, utilizando a abordagem de autenticação via código para garantir que somente pessoas autorizadas possam acessar o sistema. Qualquer alteração ou criação de novas contas será feita exclusivamente pelos desenvolvedores, em resposta a uma solicitação formal.<br><br>

<p class="lh-base"><b>➤ Logout:</b><br>
Para sair de sua conta como usuário administrador, basta clicar em “Sair” no menu de navegação. Sua conta será desconectada no mesmo instante.


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script SRC="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</body>
</html>