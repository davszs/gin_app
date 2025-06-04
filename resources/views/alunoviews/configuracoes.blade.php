@extends('layouts.alunoheader')

@section('title', 'Configurações')
@section('page-title', 'Configurações')

@section('content')
<div class="config-container">
    <h2 class="config-title" id="config-title">Alterar Dados Cadastrais</h2>

    <div class="tabs">
        <div class="tab active" data-tab="conta">MINHA CONTA</div>
        <div class="tab" data-tab="plano">MEU PLANO</div>
    </div>
<div class="tab-pane" id="tab-conta">
    <form action="{{ route('atualizar.dados') }}" id="tab-conta" method="POST" enctype="multipart/form-data" class="config-form">
        @csrf
        @method('PUT')

        <div class="avatar-wrapper">
            <img id="preview-avatar" class="avatar-img" src="{{ asset('storage/' . ($aluno->avatar ?? 'default-avatar.png')) }}" alt="Avatar">
            <label for="avatar-upload" class="avatar-button">✎ Alterar foto</label>
            <input id="avatar-upload" type="file" name="avatar" accept="image/*" hidden>
        </div>

        <div class="form-section">
            <h3>Dados Pessoais</h3>

            <label>Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $aluno->nome) }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $aluno->email) }}" required>

            <label>Telefone</label>
            <input type="text" name="telefone" value="{{ old('telefone', $aluno->telefone) }}">

            <label>Endereço</label>
            <input type="text" name="endereco" value="{{ old('endereco', $aluno->endereco) }}">

            <button type="submit" class="save-button">✔ Salvar dados</button>
        </div>
    </form>
</div>

  <div class="tab-pane" id="tab-plano" style="display: none;">
    <h3>Meu Plano</h3>
    @if($plano)
        <p><strong>Nome do Plano:</strong> {{ $plano->nome }}</p>
        <p><strong>Valor Total:</strong> R$ {{ number_format($plano->valor_total, 2, ',', '.') }}</p>
        <p><strong>Status:</strong> {{ $plano->status }}</p>

        <h4>Aulas Inscritas</h4>
        <ul>
           @foreach($plano->aulas() as $aula)
    <li>{{ $aula->nome }} - R$ {{ number_format($aula->valor, 2, ',', '.') }}</li>
            @endforeach
        </ul>
    @else
        <p>Você não possui um plano ativo.</p>
    @endif
</div>
</div>
@endsection

@push('styles')

<style>
.config-container {
    max-width: 700px;
    font-family: "Segoe UI", sans-serif;
    padding: 20px;
}

.config-title {
    font-size: 24px;
    margin-bottom: 20px;
}

.tabs {
    display: flex;
    border-bottom: 2px solid #eee;
    margin-bottom: 30px;
}

.tab {
    padding: 10px 20px;
    cursor: pointer;
    font-weight: bold;
    color: #555;
}

.tab.active {
    color: #065ca3;
    border-bottom: 3px solid #0b34bdb0;
}

.avatar-wrapper {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.avatar-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #312f2fa6;
}

.avatar-button {
    padding: 8px 14px;
    border: 2px solid #007ca1;
    border-radius: 6px;
    color: #00c3ff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.avatar-button:hover {
    background-color: #04719cc2;
    color: white;
}

.config-form label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #333;
}

.config-form input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.save-button {
    margin-top: 25px;
    background-color: #1552a1;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.save-button:hover {
    background-color: #25b4f7d2;
}
#tab-plano {
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-top: 20px;
}

#tab-plano h3, #tab-plano h4 {
    color: #1552a1;
    margin-bottom: 15px;
}

#tab-plano p, #tab-plano li {
    font-size: 16px;
    margin-bottom: 10px;
    color: #333;
}

#tab-plano ul {
    padding-left: 20px;
    list-style: disc;
}
.tab-pane {
    display: none;
    animation: fadeIn 0.3s ease-in-out;
}

.tab-pane.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab');
    const panes = document.querySelectorAll('.tab-pane');
    const title = document.getElementById('config-title');

    const tabTitles = {
        conta: 'Alterar Dados Cadastrais',
        plano: 'Visualizar Plano'
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Alterna a aba ativa
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const tabName = tab.getAttribute('data-tab');

            // Exibe o conteúdo correspondente
            panes.forEach(pane => {
                pane.classList.remove('active');
                pane.style.display = 'none';
            });
            const activePane = document.getElementById('tab-' + tabName);
            activePane.classList.add('active');
            activePane.style.display = 'block';

            // Atualiza título
            title.textContent = tabTitles[tabName];
        });
    });

    // Inicializa a primeira aba
    const initialTab = document.querySelector('.tab.active')?.getAttribute('data-tab');
    if (initialTab) {
        document.getElementById('tab-' + initialTab).classList.add('active');
        document.getElementById('tab-' + initialTab).style.display = 'block';
        title.textContent = tabTitles[initialTab];
    }
});

document.getElementById('avatar-upload').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('preview-avatar');
        preview.src = URL.createObjectURL(file);
    }
});
</script>
@endpush