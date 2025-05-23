<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Academia - Alunos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            display: flex;
            background-color: #f5f5f5;
        }
        
        /* Sidebar */
        .sidebar {
            width: 60px;
            background-color: #2c3e50;
            height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
        }
        
        .sidebar-item {
            height: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            padding: 10px 0;
            cursor: pointer;
            text-decoration: none;
        }
        
        .sidebar-item.active {
            background-color: #1a2530;
            border-left: 4px solid #3498db;
        }
        
        .sidebar-item i {
            font-size: 20px;
            margin-bottom: 3px;
        }
        
        /* Main content */
        .main-content {
            margin-left: 60px;
            flex: 1;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            font-size: 22px;
            color: #333;
        }
        
        .admin-profile {
            display: flex;
            align-items: center;
        }
        
        .admin-profile span {
            margin-right: 10px;
            font-size: 14px;
        }
        
        .admin-avatar {
            width: 35px;
            height: 35px;
            background-color: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        /* Content */
        .content {
            padding: 20px;
        }
        
        /* Search and Add button */
        .actions-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .search-container {
            position: relative;
            flex: 1;
            max-width: 500px;
        }
        
        .search-container input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-container i {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #777;
        }
        
        .add-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        
        .add-button i {
            margin-right: 8px;
        }
        
        /* Table */
        .table-container {
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead th {
            background-color: #f9f9f9;
            padding: 15px;
            text-align: left;
            font-size: 14px;
            color: #555;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }
        
        tbody td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #333;
        }
        
        tbody tr:hover {
            background-color: #f5f8fa;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .status.active {
            background-color: #e3f9e5;
            color: #2ecc71;
        }
        
        .status.inactive {
            background-color: #ffeaea;
            color: #e74c3c;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .action-button {
            width: 30px;
            height: 30px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }
        
        .edit-button {
            background-color: #f1f8fe;
            color: #3498db;
        }
        
        .delete-button {
            background-color: #fff2f2;
            color: #e74c3c;
        }
    </style>
    <!-- Font Awesome CDN para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.html" class="sidebar-item">
            <i class="fas fa-home"></i>
            <span>Início</span>
        </a>
        <a href="alunos.html" class="sidebar-item active">
            <i class="fas fa-user-graduate"></i>
            <span>Alunos</span>
        </a>
        <a href="professores.html" class="sidebar-item">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Professores</span>
        </a>
        <a href="aulas.html" class="sidebar-item">
            <i class="fas fa-book"></i>
            <span>Aulas</span>
        </a>
        <a href="turmas.html" class="sidebar-item">
            <i class="fas fa-users"></i>
            <span>Turmas</span>
        </a>
        <a href="financeiro.html" class="sidebar-item">
            <i class="fas fa-dollar-sign"></i>
            <span>Financeiro</span>
        </a>
        <a href="configuracoes.html" class="sidebar-item">
            <i class="fas fa-cog"></i>
            <span>Configurações</span>
        </a>
        <a href="logout.html" class="sidebar-item" style="margin-top: auto;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Alunos</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <div class="admin-avatar">A</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Search and Add button -->
            <div class="actions-bar">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Pesquisar alunos...">
                </div>
                <button action={{route('alunos.tabela')}} class="add-button">
                    <i class="fas fa-plus"></i>
                    Novo Aluno
                </button>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Plano atual</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ana Silva</td>
                            <td>123.456.789-10</td>
                            <td>ana.silva@email.com</td>
                            <td>Mensal</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>João Pereira</td>
                            <td>987.654.321-00</td>
                            <td>joao.pereira@email.com</td>
                            <td>Trimestral</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Maria Santos</td>
                            <td>456.789.123-45</td>
                            <td>maria.santos@email.com</td>
                            <td>Anual</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Carlos Ferreira</td>
                            <td>789.123.456-78</td>
                            <td>carlos.ferreira@email.com</td>
                            <td>Semestral</td>
                            <td><span class="status inactive">Inativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Fernanda Oliveira</td>
                            <td>234.567.890-12</td>
                            <td>fernanda.oliveira@email.com</td>
                            <td>Mensal</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Roberto Almeida</td>
                            <td>345.678.901-23</td>
                            <td>roberto.almeida@email.com</td>
                            <td>Mensal</td>
                            <td><span class="status inactive">Inativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Luiza Castro</td>
                            <td>567.890.123-45</td>
                            <td>luiza.castro@email.com</td>
                            <td>Trimestral</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Marcelo Lima</td>
                            <td>678.901.234-56</td>
                            <td>marcelo.lima@email.com</td>
                            <td>Anual</td>
                            <td><span class="status active">Ativo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-button delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>