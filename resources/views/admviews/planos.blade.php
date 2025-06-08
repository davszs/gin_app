@extends('layouts.admheader')

@section('title', 'Gerenciar Planos')
@section('page-title', 'Gerenciamento de Planos')

@section('content')
<div class="container mt-4">
    <div class="row g-4">
        @foreach($planos as $plano)
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-sm plano-card h-100">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
                        <h5 class="mb-0"> Nome do plano: 
                            {{ $plano->nome }}<br>
                        </h5>
                        <span class="badge bg-warning text-dark text-uppercase">Aluno: {{ $plano->aluno->user->name }}</span>
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Inscrições nas Aulas:</h6>
                        <ul class="list-group mb-3">
                            @forelse($plano->inscricoes as $inscricao)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $inscricao->aula->nome }} 
                                        <small class="text-muted d-block">R$ {{ number_format($inscricao->aula->valor, 2, ',', '.') }}</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" title="Remover" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-url="{{ route('plano.removerInscricao', [$plano->id, $inscricao->id]) }}">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Sem inscrições.</li>
                            @endforelse
                        </ul>

                        <!-- Botão para adicionar aula -->
                        <button class="btn btn-sm btn-outline-secondary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#addAulaModal" data-plano-id="{{ $plano->id }}">
                            <i class="bi bi-plus-lg"></i> Adicionar Aula
                        </button><br>

                        <div class="mb-3"><br>
                            <strong>Total Atualizado:</strong> 
                            <span class="text-success">R$ {{ number_format($plano->valor_total, 2, ',', '.') }}</span>
                        </div><br>
                            <button class="btn btn-outline-primary w-100 btn-atualizar-boleto" type="button">

        <i class="bi bi-arrow-repeat"></i> Atualizar Plano
    </button><br>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal de confirmação de remoção -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="deleteForm" action="#" method="POST" onsubmit="return confirm('Deseja remover esta inscrição?')">

    @csrf
    @method('DELETE')
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Remoção</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja remover esta inscrição do plano?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Remover</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para adicionar aula -->
<div class="modal fade" id="addAulaModal" tabindex="-1" aria-labelledby="addAulaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" id="addAulaForm" action="#">
        @csrf
        <input type="hidden" name="plano_id" id="add-plano-id">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="addAulaLabel">Adicionar Aula ao Plano</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="aula_id">Selecione a Aula:</label>
              <select class="form-select" name="aula_id" id="aula_id" required>
                  <option value="" disabled selected>-- Escolha uma aula --</option>
                @foreach($aulas as $aula)
    @php
    $aulasDisponiveis = $aulas->reject(fn($aula) => $plano->inscricoes->contains('aula_id', $aula->id));
@endphp

@if($aulasDisponiveis->isEmpty())
    <option disabled selected>— Nenhuma aula disponível para inscrição —</option>
@else
    @foreach($aulasDisponiveis as $aula)
        <option value="{{ $aula->id }}">{{ $aula->nome }} - R$ {{ number_format($aula->valor, 2, ',', '.') }}</option>
    @endforeach
@endif
@endforeach
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal de mensagem de status -->
@if(session('sucesso') || session('erro'))
<div class="modal fade" id="statusMessageModal" tabindex="-1" aria-labelledby="statusMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header {{ session('sucesso') ? 'bg-success' : 'bg-danger' }} text-white">
        <h5 class="modal-title" id="statusMessageLabel">
          {{ session('sucesso') ? 'Sucesso' : 'Erro' }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        {{ session('sucesso') ?? session('erro') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
   /* Estilo limpo e moderno */

.plano-card {
    border: 1px solid #e0e0e0;
    border-top: 5px solid #2196f3;
    border-radius: 12px;
    background-color: #ffffff;
    transition: box-shadow 0.3s ease;
    width: 300px;
    padding-left: 5px;
    
}

.plano-card:hover {
    box-shadow: 0 8px 20px rgba(33, 150, 243, 0.2);
}

/* Cabeçalho do card */
.card-header {
    background-color: transparent;
    padding: 1rem 1.25rem 0.5rem;
    border-bottom: none;
    font-weight: 600;
    color: #333;
}

/* Badge moderno */
.badge.bg-warning {
    background-color: #e3f2fd;
    color: #000000;
    font-weight: 600;
    border-radius: 6px;
    font-size: 0.75rem;
}

/* Lista das aulas */
.list-group {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    
}

/* Cada item da lista será flex com espaço entre nome e botão */
.list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f8f9fa;
    border: none;
    font-weight: 500;
    color: #333;
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
}

/* Botão excluir aula fica pequeno e alinhado */
.list-group-item .btn-excluir-aula {
    background-color: transparent;
    border: none;
    color: #e53935;
    font-size: 5rem;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
}

.list-group-item .btn-excluir-aula:hover {
    color: #b71c1c;
}

/* Botões */
.btn-outline-danger {
    border: none;
    background-color: transparent;
    color: #e53935;
}

.btn-outline-danger:hover {
    color: #b71c1c;
    background-color: rgba(229, 57, 53, 0.1);
}

.list-group-item .btn-group {
    display: flex;
    gap: 0.5rem; /* Espaço entre os botões */
    align-items: center;
}

/* Botões, usando suas classes já existentes */
.btn-outline-secondary {
    background-color: #e3f2fd;
    color: #1976d2;
    font-weight: 600;
    border: none;
    padding: 0.25rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
    margin-left: 7px;
    margin-top: 5px;
}

.btn-outline-secondary:hover {
    background-color: #bbdefb;
    color: #0d47a1;
}

.btn-outline-primary {
    background-color: #2196f3;
    color: white;
    font-weight: 600;
    border: none;
    padding: 0.25rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-bottom: 10px;
    margin-left: 10px;
    margin-right: 10px;
    width: 50%;
}

.btn-outline-primary:hover {
    background-color: #1976d2;
}

/* Centralizar modais vertical e horizontalmente */
.modal-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
}

.modal-content {
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(2, 190, 247, 0.4);
    border: 1px solid #2196f3;
    background: #f9fbff;
    color: #0d47a1;
}

.modal-header {
    background-color: #acacac !important;
    color: white !important;
    font-weight: 700;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

/* Botão fechar no modal */
.btn-close {
    filter: brightness(0) invert(1);
}

/* Modal de status */
#statusMessageModal .modal-header.bg-success,
#statusMessageModal .modal-header.bg-danger {
    background-color: #2196f3 !important;
    color: white !important;
}

#statusMessageModal .modal-body {
    color: #333;
}

/* Inputs */
.form-control,
.form-select {
    border: 1px solid #cfd8dc;
    border-radius: 6px;
    transition: border-color 0.3s;
}

.form-control:focus,
.form-select:focus {
    border-color: #2196f3;
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    outline: none;
}

/* Labels e títulos */
label {
    font-weight: 600;
    color: #1976d2;
}

h5, h6, strong {
    color: #1976d2;
}

    .modal {
    display: none !important; /* Força esconder os modais */
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    transition: opacity 0.3s ease;
}

.modal.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: auto !important;
}
</style>
@endpush

@push('scripts')


<script>
    // Modal de remoção
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const form = deleteModal.querySelector('#deleteForm');
        form.setAttribute('action', url);
    });

   // Modal de adicionar aula
const addModal = document.getElementById('addAulaModal');
addModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const planoId = button.getAttribute('data-plano-id');

    const inputPlanoId = addModal.querySelector('#add-plano-id');
    inputPlanoId.value = planoId;

    // Atualiza a action do formulário dinamicamente
    const form = document.getElementById('addAulaForm');
    const routeTemplate = "{{ route('plano.adicionarInscricao', ['__PLANO_ID__']) }}";
    form.setAttribute('action', routeTemplate.replace('__PLANO_ID__', planoId));
});


    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar modal de status se existir
        const statusModal = document.getElementById('statusMessageModal');
        if (statusModal) {
            const modal = new bootstrap.Modal(statusModal);
            modal.show();
        }
    });
</script>
@endpush
