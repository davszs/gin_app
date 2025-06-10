@extends('layouts.admheader')

@section('title', 'Cadastro de Alunos')
@section('page-title', 'Gerenciamento de Alunos')

@section('content') 
    <div class="actions-bar">
        <form method="GET" action="{{ route('alunos.index') }}" class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" name="q" placeholder="Pesquisar alunos..." value="{{ request('q') }}">
        </form>

        <a href="{{route('alunos.create')}}" class="add-button">
            <i class="fas fa-plus"></i>
            Novo Aluno
        </a>
    </div> <br>

    @if(session('status'))
    <div class="overlay-message" id="overlayMessage">
        <div class="alert-box">
            <p>{{ session('status') }}</p>
            <button id="okBtn">Ok</button>
        </div>
    </div>
    @endif

    @if ($alunos->count())
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Plano atual</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno)                            
                <tr>
                    <td>{{ $aluno->user->id }}</td>
                    <td>{{ $aluno->user->nome }}</td>
                    <td>{{ $aluno->user->cpf }}</td>
                    <td>{{ $aluno->user->email }}</td>
                    <td>{{ $aluno->telefone }}</td>
                    <td>Mensal</td>
                  <td>
    @if($aluno->user->status === 'ativo')
        <span class="status active">Ativo</span>
    @elseif($aluno->user->status === 'bloqueado')
        <span class="status blocked">Bloqueado</span>
    @else
        <span class="status">{{ ucfirst($aluno->user->status) }}</span>
    @endif
</td>
<td>
                        <div class="action-buttons">
                          

                            <a href="{{ route('alunos.edit', $aluno) }}" class="action-button edit-button" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este aluno?')" style="display:inline;">
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
    <div id="modalAluno" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="fecharModalAluno()">&times;</span>
        <h2>Informações do Aluno</h2>
        <div class="container">
            <div style="display: flex; gap: 20px;">
                 <img id="alunoAvatar" class="avatar-img" 
                src="{{ asset('storage/' . ($aluno->avatar ?? 'default-avatar.png')) }}" 
                    alt="Avatar">
                <div>
                    <p><strong>Nome:</strong> <span id="alunoNome"></span></p>
                    <p><strong>CPF:</strong> <span id="alunoCPF"></span></p>
                    <p><strong>Email:</strong> <span id="alunoEmail"></span></p>
                    <p><strong>Telefone:</strong> <span id="alunoTelefone"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
    @else
    <p>Nenhum aluno cadastrado!</p>
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
    });
    function abrirModalAluno(el) {
    document.getElementById('alunoNome').innerText = el.dataset.nome;
    document.getElementById('alunoCPF').innerText = el.dataset.cpf;
    document.getElementById('alunoEmail').innerText = el.dataset.email;
    document.getElementById('alunoTelefone').innerText = el.dataset.telefone;
    document.getElementById('alunoAvatar').src = el.dataset.avatar;

    document.getElementById('modalAluno').style.display = 'flex';
}

function fecharModalAluno() {
    document.getElementById('modalAluno').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('overlayMessage');
    const okBtn = document.getElementById('okBtn');

    if (okBtn && overlay) {
      okBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
      });
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
        background-color:#4287c9;
        padding: 15px;
        text-align: left;
        font-size: 14px;
        color: #000000;
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
        background-color: #4288c95b;
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
        cursor: pointer;
    }

    .edit-button {
        background-color: #f1f8fe;
        color: #3498db;
    }

    .delete-button {
        background-color: #fff2f2;
        color: #e74c3c;
    }

    .status.active {
        color: #27ae60;
        font-weight: 600;
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

     #modalAluno {
        display: flex; /* importante para centralizar */
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 999;
    overflow-y: auto; /* caso o conteúdo ultrapasse a altura da tela */
    padding: 20px;
}

.modal-content {
    background-color: #fff;
    border-radius: 12px;
    padding: 25px 30px;
    width: 100%;
    max-width: 500px; /* REDUZIDO de 700px */
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    font-family: 'Segoe UI', sans-serif;
    position: relative;
}
    .modal-content h2 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #2c3e50;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .modal-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .modal-tab {
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        background-color: #ecf0f1;
        font-weight: bold;
        color: #34495e;
        transition: background-color 0.2s ease;
    }

    .modal-tab.active {
        background-color: #3498db;
        color: #fff;
    }

    .modal-body {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .avatar-container {
        flex: 0 0 120px;
    }

    .avatar-container img {
        width: 100%;
        height: auto;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #3498db;
    }

    .info-grid {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 20px;
    }

    .info-grid label {
        font-size: 14px;
        color: #555;
        font-weight: bold;
    }

    .info-grid span {
        font-size: 14px;
        color: #333;
        display: block;
        margin-top: 2px;
    }

   .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 22px;
    font-weight: bold;
    cursor: pointer;
    color: #aaa;
    z-index: 10; /* garante que fique acima de outros elementos */
    background: none;
    border: none;
}

    .close:hover {
        color: #e74c3c;
    }
    .avatar-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #312f2fa6;
}
.status.blocked {
    color: #e74c3c; /* vermelho */
    font-weight: 600;
}
</style>
@endpush
