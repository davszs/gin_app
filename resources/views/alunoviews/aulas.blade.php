@extends('layouts.alunoheader')

@section('title', 'Minhas Aulas')

@section('page-title', 'Minhas Aulas')

@section('content')

   

    @if($aulas->isEmpty())
        <p>Você ainda não está inscrito em nenhuma aula.</p>
    @else
        <div class="cards-container">
            @foreach($aulas as $aula)
                <div class="card-aula">
                    <h3>{{ $aula->nome }}</h3>
                    <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
                    <p><strong>Dia(s) da Semana:</strong> {{ $aula->dia_semana }}</p>
                    <p><strong>Horário:</strong> {{ $aula->horario_inicio }}</p>

                    <form action="{{ route('inscricao.cancelar', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta inscrição?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn-cancelar">Cancelar Inscrição</button>
                    </form>
                </div>
            @endforeach
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

</style>
@endpush
