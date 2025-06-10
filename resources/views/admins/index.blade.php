@extends('layouts.admheader')

@section('title', 'Cadastro de Administradores')
@section('page-title', 'Gerenciamento de Administradores')

@section('content')   
<div class="actions-bar">
    <form method="GET" action="{{ route('admins.index') }}" class="search-container">
        <i class="fas fa-search"></i>
        <input type="text" name="q" placeholder="Pesquisar administradores..." value="{{ request('q') }}">
    </form>

    <a href="{{ route('admins.create') }}" class="add-button">
        <i class="fas fa-plus"></i>
        Novo administrador
    </a>
</div><br>

@if(session('status'))
<div class="overlay-message" id="overlayMessage">
    <div class="alert-box">
        <p>{{ session('status') }}</p>
        <button id="okBtn">Ok</button>
    </div>
</div>
@endif

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
                <td>{{ $admin->user->id }}</td>
                <td>{{ $admin->user->nome }}</td>
                <td>{{ $admin->user->cpf }}</td>
                <td>{{ $admin->user->email }}</td>
                <td>{{ $admin->telefone }}</td>
                <td>
                    <div class="action-buttons">
                        
                        <a href="{{ route('admins.edit', $admin) }}" class="action-button edit-button" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admins.destroy', $admin) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este administrador?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete-button" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
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
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const okBtn = document.getElementById("okBtn");
        const overlay = document.getElementById("overlayMessage");

        if (okBtn && overlay) {
            okBtn.addEventListener("click", function () {
                overlay.style.display = "none";
            });

            // Fecha automaticamente após 5s
            setTimeout(() => overlay.style.display = "none", 5000);
        }
    });
</script>
@endpush

@push('styles')
<style>
    .content {
        padding: 20px;
    }

    .actions-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
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
        padding: 10px 20px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    .add-button i {
        margin-right: 8px;
    }

    .add-button:hover {
        background-color: #2980b9;
    }

    .table-container {
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
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

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .action-button {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        text-decoration: none;
        font-size: 16px;
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
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex; justify-content: center; align-items: center;
        z-index: 999;
    }

    .alert-box {
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        text-align: center;
    }

    .alert-box p {
        margin-bottom: 15px;
    }

    .alert-box button {
        padding: 8px 16px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
@endpush
