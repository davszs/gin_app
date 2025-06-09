@extends('layouts.alunoheader')

@section('title', 'Comunicados')
@section('page-title', 'Comunicados')

@section('content')      
<div class="comunicados-container">
    <!-- Filtros -->
    <div class="comunicados-filtros">
        <button class="filtro-btn ativo" data-filter="todos">Todos</button>
        <button class="filtro-btn" data-filter="geral">Geral</button>
        <button class="filtro-btn" data-filter="aulas">Aulas</button>
    </div>
 </div>
 
    <!-- Lista de Comunicados -->
<div class="comunicados-lista-completa">
    @if($comunicados->isEmpty())
        <div class="sem-comunicados">
            <p>📭 Nenhum comunicado disponível no momento.</p>
        </div>
    @else
        @foreach($comunicados as $comunicado)
            <div class="comunicado-card {{ $comunicado->importante ? 'importante' : '' }}" data-tipo="{{ $comunicado->tipo }}">
                <div class="comunicado-header">
                    <div class="comunicado-info">
                        <span class="comunicado-data">{{ \Carbon\Carbon::parse($comunicado->data)->format('d/m/Y') }}</span>
                        <span class="comunicado-tag">{{ ucfirst($comunicado->tipo) }}</span>
                    </div>
                    @if($comunicado->importante)
                        <div class="comunicado-importante-badge">
                            <i class="fas fa-exclamation-circle"></i> Importante
                        </div>
                    @endif
                </div>
                <div class="comunicado-body">
                    <h3 class="comunicado-titulo">{{ $comunicado->titulo }}</h3>
                    <p class="comunicado-texto">{{ $comunicado->descricao }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
    
</div>
@endsection
<style>
.comunicados-container {
    padding: 2rem;
    max-width: 1000px;
    margin: 0 auto;
    font-family: 'Segoe UI', sans-serif;
}

.comunicados-filtros {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.filtro-btn {
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 8px;
    background-color: #eee;
    color: #333;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
}

.filtro-btn.ativo,
.filtro-btn:hover {
    background-color: #0859d396;
    color: #000;
}

.comunicados-lista-completa {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

/* Em telas pequenas, volta para 1 coluna */
@media (max-width: 768px) {
    .comunicados-lista-completa {
        grid-template-columns: 1fr;
    }
}

.comunicado-card {
    background-color: #eee;
    border-left: 6px solid #189df5;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.08);
    transition: transform 0.2s ease;
}

.comunicado-card:hover {
    transform: translateY(-4px);
}

.comunicado-card.importante {
    border-left-color: yellow;
    background-color: #eee;
}

.comunicado-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.8rem;
}

.comunicado-info {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.comunicado-tag {
    background-color: #189df583;
    padding: 0.2rem 0.6rem;
    border-radius: 4px;
    font-weight: bold;
    font-size: 0.85rem;
    text-transform: uppercase;
}

.comunicado-card.importante .comunicado-tag {
    background-color:  rgba(255, 255, 0, 0.808);
   
}

.comunicado-importante-badge {
    background-color: yellow;
    color: #ff0000bd;
    padding: 0.3rem 0.7rem;
    border-radius: 6px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.comunicado-body {
    color: #444;
}

.comunicado-titulo {
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    font-weight: bold;
}

.comunicado-texto {
    font-size: 1rem;
    line-height: 1.6;
}

/* Mensagem quando não há comunicados */
.sem-comunicados {
    text-align: center;
    padding: 60px 20px;
    font-size: 1.2rem;
    color: #888;
    background-color: #f9f9f9;
    border-radius: 10px;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const botoesFiltro = document.querySelectorAll('.filtro-btn');
    const comunicados = document.querySelectorAll('.comunicado-card');

    botoesFiltro.forEach(botao => {
        botao.addEventListener('click', function () {
            // Ativar/desativar botões
            botoesFiltro.forEach(btn => btn.classList.remove('ativo'));
            this.classList.add('ativo');

            const filtro = this.getAttribute('data-filter');

            comunicados.forEach(card => {
                const tipo = card.getAttribute('data-tipo');

                if (filtro === 'todos' || filtro === tipo) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>