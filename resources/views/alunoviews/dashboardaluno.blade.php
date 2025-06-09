@extends('layouts.alunoheader')

@section('title', 'Painel de Controle')
@section('page-title', 'Painel de Controle')

@section('content')

<div class="row-cards">
{{-- Card Pagamentos --}}
<div class="card pagamento-card">
    <div class="card-header">
        <h2>Status de Pagamentos</h2>
    </div>
    <div class="card-body">
        <div class="pagamento-info">
            {{-- Mês Atual --}}
            <div class="pagamento-item">
                <strong>Mês Atual:</strong>
                @if($pagamentoAtual)
                    <span class="status {{ $pagamentoAtual->status }}">{{ ucfirst($pagamentoAtual->status) }}</span>
                    <div class="pagamento-data">
                        @if($pagamentoAtual->status === 'pago')
                            <small>Pago em {{ \Carbon\Carbon::parse($pagamentoAtual->data_pagamento)->format('d/m/Y') }}</small>
                        @else
                            <small>Vencimento: {{ \Carbon\Carbon::parse($pagamentoAtual->data_vencimento)->format('d/m/Y') }}</small>
                        @endif
                    </div>
                @else
                    <span class="status pendente">Não registrado</span>
                @endif
            </div>

            {{-- Mês Anterior --}}
            <div class="pagamento-item"><br>
                <strong>Mês Anterior:</strong>
                @if($pagamentoAnterior)
                    <span class="status {{ $pagamentoAnterior->status }}">{{ ucfirst($pagamentoAnterior->status) }}</span>
                    <div class="pagamento-data">
                        @if($pagamentoAnterior->status === 'pago')
                            <small>Pago em {{ \Carbon\Carbon::parse($pagamentoAnterior->data_pagamento)->format('d/m/Y') }}</small>
                        @else
                            <small>Vencimento: {{ \Carbon\Carbon::parse($pagamentoAnterior->data_vencimento)->format('d/m/Y') }}</small>
                        @endif
                    </div>
                @else
                    <span class="status pendente">Não registrado</span>
                @endif
            </div>
        </div><br>
        <a href="{{ route('pagamento.aluno') }}" class="btn btn-primary">Visualizar Mensalidades</a>
    </div>
</div>


{{-- Card Solicitações de Matrícula --}}
<div class="card solicitacoes-card">
    <div class="card-header">
        <h2>Solicitações de Matrícula</h2>
    </div>
    <div class="card-body">
        <div class="solicitacoes-info">
            <div class="solicitacao-pendentes"><strong>Pendentes:</strong> {{ $solicitacoes['pendentes'] }}</div>
            <div class="solicitacao-aceitas"><strong>Aceitas:</strong> {{ $solicitacoes['aceitas'] }}</div>
            <div class="solicitacao-rejeitadas"><strong>Rejeitadas:</strong> {{ $solicitacoes['recusadas'] }}</div>
        </div>
        <br>
        <a href="{{ route('aulas.aluno') }}" class="btn btn-primary">Visualizar Mátriculas</a>
    </div>
</div>
</div>
<div class="row-cards">
{{-- Card Agenda de Aulas --}}
<div class="card agenda-card">
    <div class="card-header">
        <h2>Agenda da Semana</h2>
    </div>
    <div class="card-body">
        <div class="agenda-dias">
            @forelse($aulas as $aula)
                <div class="agenda-item">
                    <div class="agenda-dia">{{ ucfirst($aula->dia_semana) }}</div>
                    <div class="agenda-aulas">
                        <div class="aula">
                            <span class="aula-horario">{{ $aula->horario_inicio }}</span>
                            <span class="aula-nome">{{ $aula->nome }}</span>
                            <span class="aula-prof">{{ $aula->instrutor }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p>Você não está inscrito em nenhuma aula nesta semana.</p>
            @endforelse
        </div><br>
        <a href="{{ route('aulas.aluno') }}" class="btn btn-primary">Ver todas as aulas</a>
    </div>
</div>

{{-- Card Comunicados --}}
<div class="card comunicados-card">
    <div class="card-header">
        <h2>Comunicados Recentes</h2>
    </div>
    <div class="card-body">
        <div class="comunicados-lista">
            @forelse($comunicados as $comunicado)
                <div class="comunicado">
                    <strong>{{ $comunicado->titulo }}</strong><br>
                    <div class="comunicado-data">{{ $comunicado->data->format('d/m/Y') }}</div>
                    <p class="comunicado-conteudo">{{ Str::limit($comunicado->descricao, 100) }}</p>
                </div>
            @empty
                <p>Nenhum comunicado recente.</p>
            @endforelse
        </div>
    </div>
    
        <a href="{{ route('comunicados.aluno') }}" class="btn btn-primary">Ver todos os comunicados</a>
</div>
</div>
@endsection
<style>
    .card {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 24px;
        padding: 20px;
    }
    .card-header h2 {
        margin-bottom: 16px;
        font-size: 22px;
        border-left: 6px solid #077bff;
        padding-left: 12px;
        color: #333;
    }
    .status {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: bold;
        text-transform: capitalize;
    }
    .status.pago { background-color: #d4edda; color: #155724; }
    .status.pendente { background-color: #fff3cd; color: #856404; }
    .status.atrasado, .status.rejeitada { background-color: #f8d7da; color: #721c24; }

    .info-item, .solicitacao-item {
        margin-bottom: 8px;
    }
    .solicitacao-aceitas{  color: #155724; }
    .solicitacao-pendentes {  color: #856404; }
    .solicitacao-rejeitadas { color: #721c24; }


    .agenda-item {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 12px;
        border-left: 5px solid #7ad2f5a8;
    }

    .aula {
        display: flex;
        flex-direction: column;
        font-size: 14px;
        margin-top: 5px;
    }

    .aula span {
        margin: 2px 0;
    }

    .comunicado {
        background-color: #f1f1f1;
        border-left: 4px solid #343a40;
        padding: 12px;
        margin-bottom: 12px;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #343a40;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #07b0ffbe;
        color: #343a40;
    }
    .pagamento-data small {
    display: block;
    margin-top: 4px;
    font-size: 13px;
    color: #555;
}
.row-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-bottom: 24px;
}

/* Cada card ocupará 50% do espaço em telas largas */
.row-cards .card {
    flex: 1 1 calc(50% - 12px);
}

/* Em telas pequenas, os cards ficam empilhados */
@media (max-width: 768px) {
    .row-cards .card {
        flex: 1 1 100%;
    }
}


</style>