
# Sistema de Gestão para Cantina

Este projeto é um sistema de gestão desenvolvido em PHP com interface Bootstrap, projetado para atender às necessidades de gerenciamento de clientes e entradas de uma cantina. Ele inclui funcionalidades de CRUD (Criar, Ler, Atualizar, Excluir), autenticação de usuários, relatórios e gráficos dinâmicos para visualização de dados.

---

## Funcionalidades

- **Autenticação de Usuários**:
  - Tela de login com verificação de credenciais.
  - Controle de sessões para segurança.
- **Gerenciamento de Clientes**:
  - Cadastro, edição, exclusão e listagem de clientes.
  - Utilização de modais para interação com formulários.
  - Listagem de clientes com DataTables e suporte a busca e paginação em português.
- **Gerenciamento de Entradas**:
  - CRUD completo para registros de entradas financeiras associadas a clientes.
  - Relacionamento entre tabelas utilizando chave estrangeira.
- **Relatórios**:
  - Exibição de relatórios financeiros dos clientes.
  - Cálculo do total de entradas com destaque para valores negativos.
- **Gráficos Interativos**:
  - Gráficos dinâmicos para visualização de entradas diárias, com suporte a gráficos de linha e barras, utilizando Chart.js.
- **Interface Responsiva**:
  - Uso do Bootstrap para garantir compatibilidade com dispositivos móveis e desktops.

---

## Tecnologias Utilizadas

- **Backend**: PHP com PDO para interação com o banco de dados.
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap.
- **Bibliotecas**:
  - [Chart.js](https://www.chartjs.org/): Para gráficos dinâmicos.
  - [DataTables](https://datatables.net/): Para tabelas interativas.
- **Banco de Dados**: MySQL.

---

## Pré-requisitos

Antes de iniciar, certifique-se de ter os seguintes componentes instalados:

1. **Servidor Web**: Apache (com suporte ao PHP).
2. **PHP**: Versão 7.4 ou superior.
3. **Banco de Dados**: MySQL 5.7 ou superior.
4. **Composer**: Para gerenciamento de dependências (se necessário).

---

## Configuração do Ambiente

1. Clone o repositório:
   ```bash
   git clone https://github.com/usuario/sistema-cantina.git
   cd sistema-cantina
   ```

2. Configure o banco de dados:
   - Crie um banco de dados no MySQL.
   - Importe o arquivo `database.sql` para configurar as tabelas.

3. Configure o arquivo de conexão:
   - Edite `db.php` e atualize as credenciais do banco de dados:
     ```php
     $host = 'localhost';
     $dbname = 'nome_do_banco';
     $username = 'usuario';
     $password = 'senha';
     ```

4. Configure o servidor local:
   - Coloque o projeto na pasta do servidor web (exemplo: `htdocs` do XAMPP).
   - Acesse o sistema no navegador: `http://localhost/sistema-cantina`.

---

## Como Usar

1. **Login**:
   - Acesse a tela de login e insira suas credenciais.
   - Usuários podem ser gerenciados diretamente no banco de dados (ou usando um formulário dedicado).

2. **Gerenciar Clientes**:
   - Na aba "Clientes", você pode adicionar, editar ou excluir registros utilizando modais.

3. **Gerenciar Entradas**:
   - Na aba "Entradas", registre valores financeiros associados aos clientes.
   - Utilize filtros para facilitar a navegação pelos registros.

4. **Relatórios e Gráficos**:
   - Acesse relatórios detalhados com gráficos de entradas diárias na aba "Relatórios".

---

## Estrutura de Arquivos

```
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
```

---

## Próximos Passos

- Adicionar suporte a permissões de usuários (exemplo: administrador e usuários padrão).
- Implementar notificações visuais (ex.: alerta para clientes com limite ultrapassado).
- Melhorar o design do dashboard para incluir indicadores de desempenho.

---

## Contribuição

Se quiser contribuir com este projeto, abra uma **issue** ou envie um **pull request** no repositório oficial.

---

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
