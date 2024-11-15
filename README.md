Sistema de Gestão para Cantina

Este projeto é um sistema de gestão desenvolvido em PHP com interface Bootstrap, projetado para atender às necessidades de gerenciamento de clientes e entradas de uma cantina. Ele inclui funcionalidades de CRUD (Criar, Ler, Atualizar, Excluir), autenticação de usuários, relatórios e gráficos dinâmicos para visualização de dados.
Funcionalidades

    Autenticação de Usuários:
        Tela de login com verificação de credenciais.
        Controle de sessões para segurança.
    Gerenciamento de Clientes:
        Cadastro, edição, exclusão e listagem de clientes.
        Utilização de modais para interação com formulários.
        Listagem de clientes com DataTables e suporte a busca e paginação em português.
    Gerenciamento de Entradas:
        CRUD completo para registros de entradas financeiras associadas a clientes.
        Relacionamento entre tabelas utilizando chave estrangeira.
    Relatórios:
        Exibição de relatórios financeiros dos clientes.
        Cálculo do total de entradas com destaque para valores negativos.
    Gráficos Interativos:
        Gráficos dinâmicos para visualização de entradas diárias, com suporte a gráficos de linha e barras, utilizando Chart.js.
    Interface Responsiva:
        Uso do Bootstrap para garantir compatibilidade com dispositivos móveis e desktops.

Tecnologias Utilizadas

    Backend: PHP com PDO para interação com o banco de dados.
    Frontend: HTML5, CSS3, JavaScript, Bootstrap.
    Bibliotecas:
        Chart.js: Para gráficos dinâmicos.
        DataTables: Para tabelas interativas.
    Banco de Dados: MySQL.

Pré-requisitos

Antes de iniciar, certifique-se de ter os seguintes componentes instalados:

    Servidor Web: Apache (com suporte ao PHP).
    PHP: Versão 7.4 ou superior.
    Banco de Dados: MySQL 5.7 ou superior.
    Composer: Para gerenciamento de dependências (se necessário).

Configuração do Ambiente

    Clone o repositório:

git clone https://github.com/usuario/sistema-cantina.git
cd sistema-cantina

Configure o banco de dados:

    Crie um banco de dados no MySQL.
    Importe o arquivo database.sql para configurar as tabelas.

Configure o arquivo de conexão:

    Edite db.php e atualize as credenciais do banco de dados:

        $host = 'localhost';
        $dbname = 'nome_do_banco';
        $username = 'usuario';
        $password = 'senha';

    Configure o servidor local:
        Coloque o projeto na pasta do servidor web (exemplo: htdocs do XAMPP).
        Acesse o sistema no navegador: http://localhost/sistema-cantina.

Como Usar

    Login:
        Acesse a tela de login e insira suas credenciais.
        Usuários podem ser gerenciados diretamente no banco de dados (ou usando um formulário dedicado).

    Gerenciar Clientes:
        Na aba "Clientes", você pode adicionar, editar ou excluir registros utilizando modais.

    Gerenciar Entradas:
        Na aba "Entradas", registre valores financeiros associados aos clientes.
        Utilize filtros para facilitar a navegação pelos registros.

    Relatórios e Gráficos:
        Acesse relatórios detalhados com gráficos de entradas diárias na aba "Relatórios".

Estrutura de Arquivos

.
├── index.php           # Página inicial (login)
├── dashboard.php       # Painel principal
├── clientes.php        # Gerenciamento de clientes
├── entradas.php        # Gerenciamento de entradas
├── relatorios.php      # Página de relatórios
├── db.php              # Configuração do banco de dados
├── assets/             # Recursos estáticos (CSS, JS, imagens)
│   ├── css/
│   ├── js/
│   └── img/
└── sql/
    └── database.sql    # Script para criação do banco de dados

Próximos Passos

    Adicionar suporte a permissões de usuários (exemplo: administrador e usuários padrão).
    Implementar notificações visuais (ex.: alerta para clientes com limite ultrapassado).
    Melhorar o design do dashboard para incluir indicadores de desempenho.

Contribuição

Se quiser contribuir com este projeto, abra uma issue ou envie um pull request no repositório oficial.
Licença

Este projeto está licenciado sob a MIT License.
