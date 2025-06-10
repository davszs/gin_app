@extends('layouts.admheader')

@section('title', 'Solicitações')
@section('page-title', 'Solicitações de Alunos')


@section('content')

    {{-- Seção: Solicitações Pendentes --}}
    <h2>Solicitações Pendentes</h2><br>
    @if($solicitacoesPendentes->isEmpty())
        <p>Não há solicitações pendentes.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Aula</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitacoesPendentes as $solicitacao)
                    <tr>
                        <td>{{ $solicitacao->aluno->user->nome ?? 'Desconhecido' }}</td>
                        <td>{{ $solicitacao->aula->nome }}</td>
                        <td>{{ ucfirst($solicitacao->tipo) }}</td>
                        <td>{{ $solicitacao->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('solicitacoes.aprovar', $solicitacao->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button class= "aprovar" type="submit" onclick="return confirm('Confirmar aprovação?')">Aprovar</button>
                            </form>
                            <form action="{{ route('solicitacoes.rejeitar', $solicitacao->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                                @csrf
                                @method('PUT')
                                <button class= "rejeitar" type="submit" onclick="return confirm('Confirmar rejeição?')">Rejeitar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
<br>
    {{-- Seção: Solicitações Processadas --}}
    <h2 style="margin-top: 2rem;">Solicitações Processadas</h2><br>
    @if($solicitacoesProcessadas->isEmpty())
        <p>Não há solicitações processadas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Aula</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitacoesProcessadas as $solicitacao)
                    <tr>
                        <td>{{ $solicitacao->aluno->user->nome ?? 'Desconhecido' }}</td>
                        <td>{{ $solicitacao->aula->nome }}</td>
                        <td>{{ ucfirst($solicitacao->tipo) }}</td>
                        <td>{{ ucfirst($solicitacao->status) }}</td>
                        <td>{{ $solicitacao->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

@push('styles')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    th, td {
        padding: 0.75rem;
        border: 1px solid #ccc;
        text-align: left;
    }

    th {
         background-color: #4287c9;
    }
    tbody tr:hover {
        background-color: #4288c95b;
    }

    button {
        
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        cursor: pointer;
    }
    .aprovar{
background-color: #34db42;
    }

    .rejeitar{
        background-color: #db3434;
    }

    button:hover {
        background-color: #a1a1a1;
        color: black;
    }
</style>
@endpush
