@extends('layouts.admheader')

@section('title', 'Cadastro de Comunicados')
@section('page-title', 'Gerenciamento de Comunicados')

@section('content')   
<div class="actions-bar">
    <form method="GET" action="{{ route('comunicados.index') }}" class="search-container">
        <i class="fas fa-search"></i>
        <input type="text" name="q" placeholder="Pesquisar Comunicados..." value="{{ request('q') }}">
    </form>
    

    <button class="add-button" onclick="document.getElementById('modalCriarComunicado').style.display='flex'">
    Criar Comunicado
</button>

</div><br>

@if(session('success'))
<div class="overlay-message" id="overlayMessage">
    <div class="alert-box">
        <p>{{ session('success') }}</p>
        <button id="okBtn">Ok</button>
    </div>
</div>
@endif

@if ($comunicados->count())
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Importante</th>
                <th>Ações</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($comunicados as $comunicado)                            
            <tr>
                <td>{{ $comunicado->id }}</td>
                <td>{{ $comunicado->titulo }}</td>
                <td>{{ \Carbon\Carbon::parse($comunicado->data)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($comunicado->tipo) }}</td>
                <td>
    @if($comunicado->importante)
        <span class="tag-importante ativo" title="Importante">
            <i class="fas fa-star"></i> Importante
        </span>
    @else
        <span class="tag-importante" title="Não marcado como importante">
            <i class="far fa-star"></i> Não
        </span>
    @endif
</td>
                <td>
                    <div class="action-buttons">
                        <button class="edit-button" onclick="document.getElementById('modalEditarComunicado{{ $comunicado->id }}').style.display='block'"> Editar  </button>

                        <form action="{{ route('comunicados.destroy', $comunicado) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este comunicado?')">
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

   <!-- Modal Criar Comunicado -->
<div id="modalCriarComunicado" class="modal" >
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('modalCriarComunicado').style.display='none'">&times;</span>
        <form action="{{ route('comunicados.store') }}" method="POST">
            @csrf
            
            <h1>Novo Comunicado</h1>

            <div class="input-box">
                <label for="titulo">Título:</label><br>
                <input type="text" name="titulo" maxlength="255" required value="{{ old('titulo') }}">
            </div>

            <div class="input-box">
                <label for="descricao">Descrição:</label><br>
                <textarea name="descricao" rows="5" maxlength="500" required>{{ old('descricao') }}</textarea>
            </div>

            <div class="input-box">
                <label for="data">Data:</label><br>
                <input type="date" name="data" required value="{{ old('data', \Carbon\Carbon::parse($comunicado->data)->format('Y-m-d')) }}">
            </div>

            <div class="input-box">
                <label for="tipo">Tipo:</label><br>
                <select name="tipo" required>
                    <option value="geral" {{ old('tipo') == 'geral' ? 'selected' : '' }}>Geral</option>
                    <option value="aulas" {{ old('tipo') == 'aulas' ? 'selected' : '' }}>Aulas</option>
                </select>
            </div>

            <div class="input-box">
                <label>
                    <input type="checkbox" name="importante" {{ old('importante') ? 'checked' : '' }}>
                    <span class="important-label">Marcar como importante</span>
                </label>
            </div><br>

            <div>
                <input type="submit" class="login" value="Criar Comunicado">
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Comunicado -->
@foreach ($comunicados as $comunicado)
    <div id="modalEditarComunicado{{ $comunicado->id }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modalEditarComunicado{{ $comunicado->id }}').style.display='none'">&times;</span>
            <form action="{{ route('comunicados.update', $comunicado->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h1>Editar Comunicado</h1>

                <div class="input-box">
                    <label for="titulo">Título:</label><br>
                    <input type="text" name="titulo" maxlength="255" required value="{{ old('titulo', $comunicado->titulo) }}">
                </div>

                <div class="input-box">
                    <label for="descricao">Descrição:</label><br>
                    <textarea name="descricao" rows="5" maxlength="500" required>{{ old('descricao', $comunicado->descricao) }}</textarea>
                </div>

                <div class="input-box">
                    <label for="data">Data:</label><br>
                    <input type="date" name="data" required value="{{ old('data', \Carbon\Carbon::parse($comunicado->data)->format('Y-m-d')) }}">
                </div>

                <div class="input-box">
                    <label for="tipo">Tipo:</label><br>
                    <select name="tipo" required>
                        <option value="geral" {{ (old('tipo', $comunicado->tipo) == 'geral') ? 'selected' : '' }}>Geral</option>
                        <option value="aulas" {{ (old('tipo', $comunicado->tipo) == 'aulas') ? 'selected' : '' }}>Aulas</option>
                    </select>
                </div>

                <div class="input-box">
                    <label>
                        <input type="checkbox" name="importante" {{ old('importante', $comunicado->importante) ? 'checked' : '' }}>
                        <span class="important-label">Marcar como importante</span>
                    </label>
                </div><br>

                <div>
                    <input type="submit" class="login" value="Atualizar Comunicado">
                </div>
            </form>
        </div>
    </div>
@endforeach


@else
<p>Nenhum comunicado cadastrado!</p>
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

        setTimeout(() => overlay.style.display = "none", 5000);
    }
    document.querySelectorAll('.modal').forEach(modal => {
    modal.style.display = 'none';
  });
});

// Declara as funções no escopo global para poder usar no onclick do HTML
function abrirModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'flex';
    }
}

function fecharModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'none';
    }
}

// Fecha modal ao clicar fora (esse evento fica global)
window.addEventListener('click', function(event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
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
    >
   .modal {
    display: none; /* será ativado por JS */
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 999;
}
.modal-content {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
    overflow-y: auto;
    max-height: 90vh;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    font-weight: bold;
    color: #000;
    cursor: pointer;
}


    .container {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .input-box {
        display: flex;
        flex-direction: column;
    }

    .input-box input[type="text"],
    .input-box input[type="date"],
    .input-box select,
    .input-box textarea {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .important-label {
        background-color: #ffcc00;
        color: #333;
        font-weight: bold;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-block;
        margin-top: 10px;
    }

    .input-box input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 8px;
    }

    input.login {
        background-color: #2e86de;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input.login:hover {
        background-color: #216ab6;
    }

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
.tag-importante {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    padding: 6px 10px;
    border-radius: 20px;
    background-color: #f0f0f0;
    color: #777;
    border: 1px solid #ddd;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
}

.tag-importante.ativo {
    background-color: #ffeaa7;
    color: #d35400;
    border-color: #f9ca24;
}

.tag-importante i {
    font-size: 14px;
}

</style>
@endpush

