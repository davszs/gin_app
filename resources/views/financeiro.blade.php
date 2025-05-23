<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro</title>
    {{-- <link rel="stylesheet" href="{{asset('css/estilo_basico.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

        .logout-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .logout-box {
        background: white;
        padding: 30px 40px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        font-family: 'Poppins', sans-serif;
    }

    .logout-box p {
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .logout-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .logout-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        font-size: 1rem;
    }

    .logout-buttons .confirm {
        background-color: #dc3545;
        color: white;
    }

    .logout-buttons .cancel {
        background-color: #6c757d;
        color: white;
    }

    .logout-buttons .confirm:hover {
        background-color: #c82333;
    }

    .logout-buttons .cancel:hover {
        background-color: #5a6268;
    }
        .overlay-message {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.6); /* fundo escuro transparente */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .alert-box {
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        font-family: 'Poppins', sans-serif;
    }

    .alert-box p {
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .alert-box button {
        padding: 10px 25px;
        background-color: #007BFF;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        font-size: 1rem;
    }

    .alert-box button:hover {
        background-color: #0056b3;
    }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 68px;
            background-color: #2c3e50;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .sidebar-item a {
            color: white;
            text-decoration: none;
            height: 68px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 10px 0;
            
        }

        .sidebar-item a:hover, .sidebar-item a.active {
            background-color: #1c2e40;
        }

        .sidebar-item i {
            font-size: 18px;
            margin-bottom: 5px;
        }

        /* Content */
        .content {
            margin-left: 68px;
            width: calc(100% - 68px);
        }

        /* Header */
        .header {
            background-color: white;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 18px;
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

        .avatar {
            width: 36px;
            height: 36px;
            background-color: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Main Content */
        .main-content {
            padding: 20px;
        }

        /* Date Filter */
        .date-filter {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }

        .date-filter label {
            margin-right: 10px;
            font-size: 14px;
            color: #666;
        }

        .date-filter input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 15px;
        }

        .date-filter button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .date-filter button:hover {
            background-color: #2980b9;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card-icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #3498db;
        }

        .card-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .card-title {
            font-size: 14px;
            color: #666;
        }

        /* Notice Board */
        .notice-board {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 8px;
            color: #3498db;
        }

        .notice-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .notice-item:last-child {
            border-bottom: none;
        }

        .notice-date {
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }

        .notice-text {
            font-size: 14px;
            color: #333;
        }

        /* Quick Alerts */
        .alerts-container {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .alert-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
        }

        .alert-icon {
            margin-right: 12px;
            color: #ffc107;
            font-size: 18px;
        }

        .alert-text {
            font-size: 14px;
            color: #333;
        }

        .alert-item.critical {
            background-color: #ffeaed;
            border-left: 4px solid #e74c3c;
        }

        .alert-item.critical .alert-icon {
            color: #e74c3c;
        }

        /* Font Awesome icons */
        .fas, .far {
            font-family: "Font Awesome";
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    


</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item active">
             <a href="#"><i class="fas fa-home"></i>
            <span>Início</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-user-graduate"></i>
            <span>Alunos</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-chalkboard-teacher"></i>
            <span>Professores</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-book"></i>
            <span>Aulas</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-users"></i>
            <span>Turmas</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-dollar-sign"></i>
            <span>Financeiro</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-cog"></i>
            <span>Configurações</span></a>
    </li>
        <li class="sidebar-item">
            <a href="#" id="logoutTrigger"><i class="fas fa-sign-out-alt"></i><span>Desconectar</span></a>
        </li>
    </ul>
    </div>
    
     {{-- Modal de logout --}}
    <div id="logoutModal" class="logout-overlay" style="display: none;">
        <div class="logout-box">
            <p>Tem certeza que deseja desconectar a conta e sair?</p>
            <div class="logout-buttons">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm">Sim, sair</button>
                </form>
                <button class="cancel" id="cancelLogout">Cancelar</button>
            </div>
        </div>
    </div>

      @if (session('status'))
        <div class="overlay-message" id="overlayMessage">
            <div class="alert-box">
                <p>{{ session('status') }}</p>
                <button id="okBtn">OK</button>
            </div>
        </div>
        @endif
    </div>


    {{-- Scripts relacionados à sidebar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const okBtn = document.getElementById("okBtn");
            const overlay = document.getElementById("overlayMessage");
            if (okBtn && overlay) {
                okBtn.addEventListener("click", () => overlay.style.display = "none");
            }

            const logoutLink = document.getElementById("logoutTrigger");
            const logoutModal = document.getElementById("logoutModal");
            const cancelBtn = document.getElementById("cancelLogout");

            logoutLink?.addEventListener("click", e => {
                e.preventDefault();
                logoutModal.style.display = "flex";
            });

            cancelBtn?.addEventListener("click", () => {
                logoutModal.style.display = "none";
            });
        });
    </script>

   
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
    </div>]
    

</body>
</html>
