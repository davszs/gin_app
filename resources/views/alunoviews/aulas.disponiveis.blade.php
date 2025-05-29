@extends('layouts.app')

@section('title', 'Aulas Disponíveis')
@section('page-title', 'Aulas Disponíveis')

@section('content')
    @if($aulasDisponiveis->isEmpty())
        <p>Não há aulas disponíveis no momento.</p>
    @else
        <div class="cards-container">
            @foreach($aulasDisponiveis as $aula)
                <div class="card-aula">
                    <h3>{{ $aula->nome }}</h3>
                    <p><strong>Modalidade:</strong> {{ $aula->modalidade }}</p>
                    <p><strong>Dias da Semana:</strong> {{ $aula->dias_semana }}</p>
                    <p><strong>Horário:</strong> {{ $aula->horario }}</p>

                    <form action="{{ route('inscricao.inscrever', $aula) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-inscrever">Inscrever-se</button>
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
    background: #fff;
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
</style>
@endpush
