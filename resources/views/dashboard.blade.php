<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gerenciamento de Academia</title>
    <style>
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

        .sidebar-item {
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

        .sidebar-item:hover, .sidebar-item.active {
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
        <div class="sidebar-item">
            <i class="fas fa-sync-alt"></i>
        </div>
        <div class="sidebar-item active">
            <i class="fas fa-home"></i>
            <span>Início</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-user-graduate"></i>
            <span>Alunos</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Professores</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-book"></i>
            <span>Aulas</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-users"></i>
            <span>Turmas</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-dollar-sign"></i>
            <span>Financeiro</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-cog"></i>
            <span>Configurações</span>
        </div>
        <div class="sidebar-item" style="margin-top: auto;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1>Dashboard</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <div class="avatar">A</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Date Filter -->
            <div class="date-filter">
                <label for="date-inicio">Data Início:</label>
                <input type="date" id="date-inicio" name="date-inicio">
                <label for="date-fim">Data Fim:</label>
                <input type="date" id="date-fim" name="date-fim">
                <button type="button">Filtrar</button>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-value">157</div>
                    <div class="card-title">Alunos Ativos</div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="card-value">28</div>
                    <div class="card-title">Alunos Inativos</div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-value">5</div>
                    <div class="card-title">Total de Professores</div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-value">42</div>
                    <div class="card-title">Total de Aulas</div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-value">12</div>
                    <div class="card-title">Total de Turmas</div>
                </div>
            </div>

            <!-- Notice Board -->
            <div class="notice-board">
                <div class="section-title">
                    <i class="fas fa-bullhorn"></i>
                    Quadro de Avisos
                </div>
                <div class="notice-item">
                    <div class="notice-date">08/04/2025</div>
                    <div class="notice-text">Manutenção programada no sistema para o dia 12/04/2025 das 23h às 6h. O sistema ficará indisponível durante este período.</div>
                </div>
                <div class="notice-item">
                    <div class="notice-date">05/04/2025</div>
                    <div class="notice-text">Nova turma de Yoga será aberta a partir do dia 15/04. Interessados devem procurar a recepção.</div>
                </div>
                <div class="notice-item">
                    <div class="notice-date">01/04/2025</div>
                    <div class="notice-text">Lembramos que o horário de funcionamento aos domingos será alterado para 8h às 14h a partir deste mês.</div>
                </div>
            </div>

            <!-- Quick Alerts -->
            <div class="alerts-container">
                <div class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Alertas Rápidos
                </div>
                <div class="alert-item critical">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-text">12 alunos com pagamentos em atraso há mais de 10 dias</div>
                </div>
                <div class="alert-item">
                    <div class="alert-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="alert-text">8 planos vencendo nos próximos 7 dias</div>
                </div>
                <div class="alert-item">
                    <div class="alert-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="alert-text">3 novos alunos aguardando aprovação de matrícula</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>