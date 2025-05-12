<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro</title>
    {{-- <link rel="stylesheet" href="{{asset('css/estilo_basico.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        
        .sidebar {
            width: 50px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: 100%;
            z-index: 100;
        }
        
        .sidebar a {
            color: white;
            text-decoration: none;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 0;
            font-size: 12px;
            transition: background-color 0.3s;
        }
        
        .sidebar a:hover {
            background-color: #34495e;
        }
        
        .sidebar a i {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .main-content {
            flex: 1;
            margin-left: 50px;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .header h1 {
            font-size: 22px;
            color: #333;
        }
        
        .profile {
            display: flex;
            align-items: center;
        }
        
        .profile span {
            margin-right: 10px;
        }
        
        .profile-icon {
            width: 40px;
            height: 40px;
            background-color: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .search-filters {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }
        
        .search-input {
            flex: 1;
            min-width: 200px;
            position: relative;
        }
        
        .search-input input {
            width: 100%;
            padding: 8px 30px 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-input i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        .status-filter {
            display: flex;
            gap: 10px;
        }
        
        .status-filter button {
            padding: 8px 12px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .status-filter button.active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        
        .status-filter button:hover:not(.active) {
            background-color: #e9e9e9;
        }
        
        .new-payment-btn {
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .new-payment-btn:hover {
            background-color: #2980b9;
        }
        
        .financeiro-table {
            width: 100%;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .financeiro-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .financeiro-table th {
            background-color: #f5f5f5;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        
        .financeiro-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #666;
        }
        
        .financeiro-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            min-width: 80px;
        }
        
        .status.pago {
            background-color: #e6f7ed;
            color: #2ecc71;
        }
        
        .status.pendente {
            background-color: #fff5e6;
            color: #f39c12;
        }
        
        .status.atrasado {
            background-color: #fce6e6;
            color: #e74c3c;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 4px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .edit-btn {
            background-color: #f1c40f;
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #d0a90d;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        .active-sidebar {
            background-color: #34495e;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" title="Início">
            <i class="fas fa-home"></i>
            <span>Início</span>
        </a>
        <a href="#" title="Alunos">
            <i class="fas fa-user-graduate"></i>
            <span>Alunos</span>
        </a>
        <a href="#" title="Professores">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Professores</span>
        </a>
        <a href="#" title="Aulas">
            <i class="fas fa-book-open"></i>
            <span>Aulas</span>
        </a>
        <a href="#" title="Turmas">
            <i class="fas fa-users"></i>
            <span>Turmas</span>
        </a>
        <a href="#" class="active-sidebar" title="Financeiro">
            <i class="fas fa-dollar-sign"></i>
            <span>Financeiro</span>
        </a>
        <a href="#" title="Configurações">
            <i class="fas fa-cog"></i>
            <span>Configurações</span>
        </a>
       </a>
    
    <!-- Formulário de logout -->
    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
        @csrf
    </form>

    <!-- Link para Sair, que submete o formulário -->
    <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" title="Sair" style="margin-top: auto;">
        <i class="fas fa-sign-out-alt"></i>
        <span>Sair</span>
    </a>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Financeiro</h1>
            <div class="profile">
                <span>Admin</span>
                <div class="profile-icon">A</div>
            </div>
        </div>
        
        <!-- Search and Filters -->
        <div class="search-filters">
            <div class="search-input">
                <input type="text" placeholder="Buscar por nome ou CPF">
                <i class="fas fa-search"></i>
            </div>
            <div class="status-filter">
                <button class="active">Todos</button>
                <button>Pagos</button>
                <button>Pendentes</button>
                <button>Atrasados</button>
            </div>
            <button class="new-payment-btn">
                <i class="fas fa-plus"></i> Novo Pagamento
            </button>
        </div>
        
        <!-- Financial Table -->
        <div class="financeiro-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Aluno</th>
                        <th>CPF</th>
                        <th>Plano</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Data de Vencimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>João Silva</td>
                        <td>123.456.789-00</td>
                        <td>Mensal</td>
                        <td>R$ 120,00</td>
                        <td><span class="status pago">Pago</span></td>
                        <td>10/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Maria Oliveira</td>
                        <td>987.654.321-00</td>
                        <td>Trimestral</td>
                        <td>R$ 320,00</td>
                        <td><span class="status pendente">Pendente</span></td>
                        <td>15/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Pedro Santos</td>
                        <td>456.789.123-00</td>
                        <td>Anual</td>
                        <td>R$ 1.100,00</td>
                        <td><span class="status atrasado">Atrasado</span></td>
                        <td>01/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Ana Souza</td>
                        <td>321.654.987-00</td>
                        <td>Mensal</td>
                        <td>R$ 120,00</td>
                        <td><span class="status pago">Pago</span></td>
                        <td>05/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Carlos Ferreira</td>
                        <td>789.123.456-00</td>
                        <td>Semestral</td>
                        <td>R$ 600,00</td>
                        <td><span class="status pendente">Pendente</span></td>
                        <td>20/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Fernanda Lima</td>
                        <td>654.321.987-00</td>
                        <td>Mensal</td>
                        <td>R$ 120,00</td>
                        <td><span class="status atrasado">Atrasado</span></td>
                        <td>28/03/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Roberto Alves</td>
                        <td>147.258.369-00</td>
                        <td>Trimestral</td>
                        <td>R$ 320,00</td>
                        <td><span class="status pago">Pago</span></td>
                        <td>12/04/2025</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>