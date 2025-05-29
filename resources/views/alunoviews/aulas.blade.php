@extends('layouts.alunoheader')

@section('title', 'Aulas')
@section('page-title', 'Aulas')

@section('content')
    {{-- Seção Minhas Aulas --}}
    <h2>Minhas Aulas</h2><br>
    @if($aulas->isEmpty())
        <p>Você ainda não está inscrito em nenhuma aula.</p>
    @else
        <div class="cards-container">
            @foreach($aulas as $aula)
                <div class="card-aula">
                    <h3>{{ $aula->nome }}</h3>
                    <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
                    <p><strong>Dia(s) na Semana:</strong> {{ $aula->dia_semana }}</p>
                    <p><strong>Horário:</strong> {{ $aula->horario_inicio }}</p>
                    <p><strong>Professor:</strong> {{ $aula->instrutor }}</p>

                    <form action="{{ route('inscricao.cancelar', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta inscrição?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn-cancelar">Cancelar Inscrição</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
    <br>

    {{-- Seção Aulas Disponíveis --}}
    <h2>Inscreve-se em Aulas</h2>
    <br>
    <form method="GET" action="{{ route('aulas.filtro') }}" class="form-filtro">
    <label for="modalidade">Modalidade:</label>
    <input type="text" name="modalidade" id="modalidade" value="{{ old('modalidade', $modalidade ?? '') }}">

    <label for="dia">Dia da Semana:</label>
    <input type="text" name="dia" id="dia" value="{{ old('dia', $dia ?? '') }}">

    <button type="submit">Filtrar</button>
</form><br>
    @if($aulasDisponiveis->isEmpty())
        <p>Não há aulas disponíveis no momento.</p>
    @else
        <div class="cards-container">
            @foreach($aulasDisponiveis as $aula)
                <div class="card-aula">
                    <h3>{{ $aula->nome }}</h3>
                    <p><strong>Descrição:</strong> {{ $aula->descricao }}</p>
                    <p><strong>Dia(s) na Semana:</strong> {{ $aula->dia_semana }}</p>
                    <p><strong>Horário:</strong> {{ $aula->horario_inicio }}</p>
                    <p><strong>Professor:</strong> {{ $aula->instrutor }}</p>

                    <form action="{{ route('inscricao.inscrever', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja se inscrever nessa aula?')">
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

</style>
@endpush
