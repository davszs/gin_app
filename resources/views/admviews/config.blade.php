@extends('layouts.admheader')

@section('title', 'Configurações Gerais')
@section('page-title', 'Configurações ')

@section('content')
<div class="config-container">
    <h2 class="config-title" id="config-title">Alterar Senha</h2>

    <div class="tabs">
        <div class="tab active" data-tab="senha">ALTERAR SENHA</div>
        <div class="tab" data-tab="gerais">CONFIGURAÇÕES GERAIS</div>
    </div>

    <div class="tab-pane" id="tab-senha">
        <form method="POST" action="{{ route('admin.updatePassword') }}" class="config-form">
            @csrf
            @method('PUT')

            <label>Senha Atual</label>
            <input type="password" name="current_password" required>

            <label>Nova Senha</label>
            <input type="password" name="new_password" required>

            <label>Confirmar Nova Senha</label>
            <input type="password" name="new_password_confirmation" required>

            <button type="submit" class="save-button">✔ Salvar nova senha</button>
        </form>
    </div>

    <div class="tab-pane" id="tab-gerais" style="display: none;">
        <label>Tamanho da Fonte</label>
        <select onchange="setFontSize(this.value)">
            <option value="10px">Extra Pequena</option>
            <option value="14px">Pequena</option>
            <option value="16px" selected>Padrão</option>
            <option value="18px">Grande</option>
            <option value="22px">Extra Grande</option>
        </select>
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
        senha: 'Alterar Senha',
        gerais: 'Configurações Gerais'
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const tabName = tab.getAttribute('data-tab');
            panes.forEach(pane => {
                pane.classList.remove('active');
                pane.style.display = 'none';
            });

            const activePane = document.getElementById('tab-' + tabName);
            activePane.classList.add('active');
            activePane.style.display = 'block';

            title.textContent = tabTitles[tabName];
        });
    });

    const initialTab = document.querySelector('.tab.active')?.getAttribute('data-tab');
    if (initialTab) {
        document.getElementById('tab-' + initialTab).classList.add('active');
        document.getElementById('tab-' + initialTab).style.display = 'block';
        title.textContent = tabTitles[initialTab];
    }
});

const savedTheme = localStorage.getItem('theme');
if (savedTheme) toggleTheme(savedTheme);

const savedColor = localStorage.getItem('textColor');
if (savedColor) setTextColor(savedColor);

const savedFontSize = localStorage.getItem('fontSize');
if (savedFontSize) setFontSize(savedFontSize);

// Dentro das funções:
function toggleTheme(theme) {
    localStorage.setItem('theme', theme);
    if (theme === 'dark') {
        document.body.style.backgroundColor = '#121212';
        document.body.style.color = '#fff';
    } else {
        document.body.style.backgroundColor = '';
        document.body.style.color = '';
    }
}

function setTextColor(color) {
    localStorage.setItem('textColor', color);
    document.body.style.color = color;
}

function setFontSize(size) {
    localStorage.setItem('fontSize', size);
    document.body.style.fontSize = size;
}
</script>
@endpush
