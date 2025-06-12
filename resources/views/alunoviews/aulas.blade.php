@extends('layouts.alunoheader')

@section('title', 'Aulas')
@section('page-title', 'Aulas')

@section('content')
 {{-- Seção Minhas Aulas --}}
<h2>Minhas Aulas</h2><br>
<div class="row g-3 mx-3">
@foreach($aulas as $aula)
@php
        // Procura se já existe solicitação pendente de cancelamento para esta aula
        $solicitacaoCancelamento = $solicitacoesPendentes->firstWhere(function($sol) use ($aula) {
            return $sol->aula_id == $aula->id && $sol->tipo == 'cancelamento';
        });
    @endphp
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2-4">
        <div class="card-aula h-100 d-flex flex-column">
            <h3>{{ $aula->nome }}</h3>
            <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
            <p><strong>Dia(s):</strong> {{ $aula->dia_semana }}</p>
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
            <br>
        </div>
    </div>
@endforeach
</div>

        
    <br>

    {{-- Seção Aulas Disponíveis --}}
<h2>Inscreva-se em Aulas</h2>
<br>
<div class="row g-3 mx-3">
@foreach($aulasDisponiveis as $aula)
    @php
        $solicitacaoInscricao = $solicitacoesPendentes->firstWhere(function($sol) use ($aula) {
            return $sol->aula_id == $aula->id && $sol->tipo == 'inscricao';
        });
    @endphp

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2-4">
        <div class="card-aula h-100 d-flex flex-column">
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
    </div>
@endforeach
</div>


    {{-- Seção Aulas Pendentes --}}
    <h2>Status de últimas solicitações</h2><br>
    @if($solicitacoesPendentes->isEmpty())
    <p>Você não possui solicitações pendentes.</p>
@else
    
        @foreach($solicitacoesPendentes as $solicitacao)
            <div class="card-aula">
                <h3>{{ $solicitacao->aula->nome }}</h3>
                <p><strong>Tipo:</strong> {{ ucfirst($solicitacao->tipo) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($solicitacao->status) }}</p>
                <p><strong>Data:</strong> {{ $solicitacao->created_at->format('d/m/Y H:i') }}</p>
            </div>
        @endforeach
   
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



.card-aula {
    background-color: #f5f7fa;
    border-left: 6px solid #0859d3; /* azul padrão */
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 1.5rem;
    width: 100%; /* 4 cards por linha com gap */
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease;
    cursor: default;
}

.card-aula:hover {
    transform: translateY(-6px);
}

.card-aula h3 {
    margin-bottom: 0.6rem;
    color: #0859d3;
    font-weight: 700;
    font-size: 1.2rem;
}

.card-aula p {
    color: #555;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.btn-cancelar,
.btn-inscrever,
.btn-solicitado-cancelar,
.btn-solicitado-inscrever {
    border: none;
    padding: 0.6rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    margin-top: auto;
    transition: background-color 0.3s ease;
    width: 100%;
    text-align: center;
    display: inline-block;
    user-select: none;
}

.btn-cancelar {
    background-color: #e63946; /* vermelho */
    color: white;
}

.btn-cancelar:hover:not(:disabled) {
    background-color: #b43136;
}

.btn-inscrever {
    background-color: #0859d3; /* azul escuro */
    color: white;
}

.btn-inscrever:hover:not(:disabled) {
    background-color: #063d8a;
}

.btn-solicitado-cancelar {
    background-color: #f1c40f; /* amarelo */
    color: black;
    cursor: not-allowed;
}

.btn-solicitado-inscrever {
    background-color: #2ecc71; /* verde */
    color: white;
    cursor: not-allowed;
}
.row.g-3 {
    --bs-gutter-x: 1rem;
    --bs-gutter-y: 1rem;
}

@media (min-width: 1200px) {
    .col-xl-2-4 {
        flex: 0 0 auto;
        width: 33%;
        max-width: 33%;
    }
    
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
