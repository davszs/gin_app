<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Academia - Administradores</title>
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
            text-decoration: none;
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
        
        .action-button a{
            text-decoration: none;
        }

        .edit-button {
            background-color: #f1f8fe;
            color: #3498db;
        }
        
        .delete-button {
            background-color: #fff2f2;
            color: #e74c3c;
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
            <h1>Administradores</h1>
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
                    <input type="text" placeholder="Pesquisar administradores...">
                </div>
                <a href="{{route('admins.create')}}" class="add-button">
                    <i class="fas fa-plus"></i>
                    Novo administrador
                </a>
            </div>

            @if(session('status'))
            <div class="overlay-message" id="overlayMessage">
            <div class="alert-box">
                <p>{{ session('status') }}</p>
                <button id="okBtn">Ok</button>
            </div>
            </div>
            @endif

            <!-- Table -->
            @if ($admins->count())
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)                            
                        <tr>
                            <td>{{$admin->user->id}}</td>
                            <td>{{$admin->user->nome}}</td>
                            <td>{{$admin->user->cpf}}</td>
                            <td>{{$admin->user->email}}</td>
                            <td>{{$admin->telefone}}</td>

                            <td>
                            <div class="action-as">
                            <button class="action-button">
                            <a href="{{ route('admins.show', $admin) }}" class="fas fa-eye"></a>
                            </button>

                            <button class="action-button edit-button">
                            <a class="fas fa-edit" href="{{ route('admins.edit', $admin) }}"></a>
                            </button>
                            <form action="{{ route('admins.destroy', $admin) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este administrador?')">
                                @csrf
                                @method('DELETE')
                                <button class="action-button delete-button"><i class="fas fa-trash"></i></button>
                            </form>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Nenhum administrador cadastrado!</p>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const okBtn = document.getElementById("okBtn");
        const overlay = document.getElementById("overlayMessage");

        if (okBtn && overlay) {
            okBtn.addEventListener("click", function () {
                overlay.style.display = "none";
            });
        }
    });
</script>
</body>
</html>