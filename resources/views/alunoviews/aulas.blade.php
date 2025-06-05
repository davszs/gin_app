@extends('layouts.alunoheader')

@section('title', 'Aulas')
@section('page-title', 'Aulas')

@section('content')
    {{-- Seção Minhas Aulas --}}
    <h2>Minhas Aulas</h2><br>
   @foreach($aulas as $aula)
    @php
        // Procura se já existe solicitação pendente de cancelamento para esta aula
        $solicitacaoCancelamento = $solicitacoesPendentes->firstWhere(function($sol) use ($aula) {
            return $sol->aula_id == $aula->id && $sol->tipo == 'cancelamento';
        });
    @endphp

    <div class="card-aula">
        <h3>{{ $aula->nome }}</h3>
        <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
        <p><strong>Dia(s) na Semana:</strong> {{ $aula->dia_semana }}</p>
        <p><strong>Horário:</strong> {{ $aula->horario_inicio }}</p>
        <p><strong>Professor:</strong> {{ $aula->instrutor }}</p>

        @if($solicitacaoCancelamento)
            <button class="btn-solicitado-cancelar" disabled>Solicitação de Cancelamento Enviada</button>
        @else
            <form action="{{ route('inscricao.cancelar', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta inscrição?')">
                @csrf
                @method('PUT')
                <button type="submit" class="btn-cancelar">Solicitar Cancelamento</button>
            </form>
        @endif
    </div>
@endforeach
        </div>
    <br>

    {{-- Seção Aulas Disponíveis --}}
    <h2>Inscreve-se em Aulas</h2>
    <br>
    @foreach($aulasDisponiveis as $aula)
    @php
        // Procura se já existe solicitação pendente de inscrição para esta aula
        $solicitacaoInscricao = $solicitacoesPendentes->firstWhere(function($sol) use ($aula) {
            return $sol->aula_id == $aula->id && $sol->tipo == 'inscricao';
        });
    @endphp

    <div class="card-aula">
        <h3>{{ $aula->nome }}</h3>
        <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
        <p><strong>Dia(s) na Semana:</strong> {{ $aula->dia_semana }}</p>
        <p><strong>Horário:</strong> {{ $aula->horario_inicio }}</p>
        <p><strong>Professor:</strong> {{ $aula->instrutor }}</p>

        @if($solicitacaoInscricao)
            <button class="btn-solicitado-inscrever" disabled>Solicitação de Inscrição Enviada</button>
        @else
            <form action="{{ route('inscricao.inscrever', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja se inscrever nessa aula?')">
                @csrf
                <button type="submit" class="btn-inscrever">Solicitar Inscrição</button>
            </form>
        @endif
    </div>
@endforeach<br>

    {{-- Seção Aulas Pendentes --}}
    <h2>Status de últimas solicitações</h2><br>
    @if($solicitacoesPendentes->isEmpty())
    <p>Você não possui solicitações pendentes.</p>
@else
    <div class="cards-container">
        @foreach($solicitacoesPendentes as $solicitacao)
            <div class="card-aula">
                <h3>{{ $solicitacao->aula->nome }}</h3>
                <p><strong>Tipo:</strong> {{ ucfirst($solicitacao->tipo) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($solicitacao->status) }}</p>
                <p><strong>Data:</strong> {{ $solicitacao->created_at->format('d/m/Y H:i') }}</p>
            </div>
        @endforeach
    </div>
@endif

@if(session('info'))
    <div class="alert alert-warning">
        {{ session('info') }}
    </div>
@endif
@if(session('sucesso'))
    <div class="alert alert-success">
        {{ session('sucesso') }}
    </div>
@endif

@endsection




@push('styles')
<style>
.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}
.card-aula {
    background: #afc2ff;
    border-radius: 8px;
    box-shadow: 0 0 6px rgba(0,0,0,0.1);
    padding: 1rem;
    width: 280px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card-aula h3 {
    margin-bottom: 0.5rem;
}
.btn-cancelar {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
}
.btn-cancelar:hover {
    background-color: #c0392b;
}
.btn-inscrever {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
}
.btn-inscrever:hover {
    background-color: #2980b9;
}
.form-filtro {
    margin-bottom: 1rem;
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}
.form-filtro label {
    font-weight: bold;
}
.form-filtro input, .form-filtro select {
    padding: 0.3rem;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.form-filtro button {
    padding: 0.4rem 1rem;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
}
.btn-solicitado-inscrever {
    background-color: #2ecc71; /* verde */
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 4px;
    cursor: not-allowed;
    margin-top: 1rem;
}

.btn-solicitado-cancelar {
    background-color: #f1c40f; /* amarelo */
    color: black;
    border: none;
    padding: 0.5rem;
    border-radius: 4px;
    cursor: not-allowed;
    margin-top: 1rem;
}

</style>
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os formulários de solicitação
    document.querySelectorAll('form').forEach(form => {
       form.addEventListener('submit', function(e) {
    const btn = form.querySelector('button');

    // Pergunta de confirmação
    const confirmar = form.onsubmit ? form.onsubmit() : confirm('Tem certeza?');
    if (!confirmar) {
        e.preventDefault(); // se cancelar, não faz nada
        return;
    }

    if (btn) {
        e.preventDefault(); // previne o envio imediato
        btn.disabled = true;

        if (btn.classList.contains('btn-cancelar')) {
            btn.style.backgroundColor = '#f1c40f';
            btn.textContent = 'Solicitação de Cancelamento Enviada';
        } else if (btn.classList.contains('btn-inscrever')) {
            btn.style.backgroundColor = '#2ecc71';
            btn.textContent = 'Solicitação de Inscrição Enviada';
        }

        setTimeout(() => form.submit(), 500);
    }
});
</script>
@endpush
