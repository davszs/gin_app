@extends('layouts.admheader')

@section('title', 'Gerenciar Planos')
@section('page-title', 'Gerenciamento de Planos')

@section('content')

<!-- Filtro de busca -->
<div class="mb-4">
    <label for="filtroAluno" class="form-label fw-bold">🔍 Filtro de pesquisa:</label>
    <input type="text" class="form-control shadow-sm border-1" id="filtroAluno" placeholder="Pesquisar aluno pelo nome...">
</div>

<!-- Nav Tabs -->
<ul class="nav nav-tabs nav-fill border rounded shadow-sm" id="tabsStatus" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-semibold text-dark" id="ativos-tab" data-bs-toggle="tab" data-bs-target="#ativos" type="button" role="tab" aria-controls="ativos" aria-selected="true">
            ✅ Planos Ativos
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold text-dark" id="cancelados-tab" data-bs-toggle="tab" data-bs-target="#cancelados" type="button" role="tab" aria-controls="cancelados" aria-selected="false">
            ❌ Planos Cancelados
        </button>
    </li>
</ul>

<div class="tab-content mt-4" id="tabsStatusContent">
    <!-- Planos Ativos -->
    <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="planosAtivosContainer">
            @foreach($planos->where('status', 'ativo') as $plano)
                <div class="col plano-card-wrapper" data-aluno="{{ strtolower($plano->aluno->user->nome) }}">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top">
                            <h5 class="mb-0 small">Nome do plano:<br> {{ $plano->nome }}</h5>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary text-light text-uppercase mb-3">Aluno: {{ $plano->aluno->user->nome }}</span>
                            <h6 class="fw-bold mb-3">Inscrições nas Aulas:</h6>
                            <ul class="list-group mb-3 flex-grow-1 overflow-auto" style="max-height: 150px;">
                                @forelse($plano->inscricoes as $inscricao)
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-2">
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

                            <button class="btn btn-sm btn-outline-secondary mb-3" data-bs-toggle="modal" data-bs-target="#addAulaModal" data-plano-id="{{ $plano->id }}">
                                <i class="bi bi-plus-lg"></i> Adicionar Aula
                            </button>

                            <div class="mb-3">
                                <strong>Total Atualizado:</strong> 
                                <span class="text-success">R$ {{ number_format($plano->valor_total, 2, ',', '.') }}</span>
                            </div>

                            <button class="btn btn-outline-danger w-100 mt-auto" type="button"
                                onclick="confirmarAcao('{{ route('planos.cancelar', $plano->id) }}', 'Tem certeza que deseja cancelar este plano?', 'Plano cancelado com sucesso!')">
                                <i class="bi bi-x-circle"></i> Cancelar Plano
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Planos Cancelados -->
    <div class="tab-pane fade" id="cancelados" role="tabpanel" aria-labelledby="cancelados-tab">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="planosCanceladosContainer">
            @foreach($planos->where('status', 'cancelado') as $plano)
                <div class="col plano-card-wrapper" data-aluno="{{ strtolower($plano->aluno->user->nome) }}">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top">
                            <h5 class="mb-0 small">Nome do plano:<br> {{ $plano->nome }}</h5>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary text-light text-uppercase mb-3">Aluno: {{ $plano->aluno->user->nome }}</span>
                            <h6 class="fw-bold mb-3">Inscrições nas Aulas:</h6>
                            <ul class="list-group mb-3 flex-grow-1 overflow-auto" style="max-height: 150px;">
                                @forelse($plano->inscricoes as $inscricao)
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-2">
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

                            <button class="btn btn-sm btn-outline-secondary mb-3" data-bs-toggle="modal" data-bs-target="#addAulaModal" data-plano-id="{{ $plano->id }}">
                                <i class="bi bi-plus-lg"></i> Adicionar Aula
                            </button>

                            <div class="mb-3">
                                <strong>Total Atualizado:</strong> 
                                <span class="text-success">R$ {{ number_format($plano->valor_total, 2, ',', '.') }}</span>
                            </div>

                            <button class="btn btn-outline-success w-100 mt-auto" type="button"
                                onclick="confirmarAcao('{{ route('planos.ativar', $plano->id) }}', 'Deseja ativar este plano novamente?', 'Plano ativado com sucesso!')">
                                <i class="bi bi-check-circle"></i> Ativar Plano
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Ação -->
<div class="modal fade" id="acaoModal" tabindex="-1" aria-labelledby="acaoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" id="acaoModalBody">
        <!-- Conteúdo será inserido dinamicamente -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmarAcaoBtn">Confirmar</button>
      </div>
    </div>
  </div>
</div>
                </div>
            </div>
       
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
                
    @php
    $aulasDisponiveis = $aulas->filter(fn($aula) => !$plano->inscricoes->contains('aula_id', $aula->id));

@endphp

@if($aulasDisponiveis->isEmpty())
    <option disabled selected>— Nenhuma aula disponível para inscrição —</option>
@else
    @foreach($aulasDisponiveis as $aula)
        <option value="{{ $aula->id }}" {{ old('aula_id') == $aula->id ? 'selected' : '' }}>
    {{ $aula->nome }} - R$ {{ number_format($aula->valor, 2, ',', '.') }}
</option>
    @endforeach
@endif

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
    color: #ffffff;
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
/* Filtros e TABs */
  #filtroAluno:focus {
        border-color: #03c6e9;
        box-shadow: 0 0 0 0.2rem rgba(7, 114, 255, 0.25);
    }

   /* Container dos botões de aba */
.nav-tabs.custom-tabs {
    border-bottom: none;
    gap: 1rem;
    justify-content: center;
    margin-top: 20px;
}

/* Botões de aba */
.nav-tabs.custom-tabs .nav-link {
    background: none;
    border: none;
    color: #1552a1;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 8px 8px 0 0;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.nav-tabs.custom-tabs .nav-link:hover {
    background-color: #e7f1ff;
}

/* Aba ativa */
.nav-tabs.custom-tabs .nav-link.active {
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 3px solid #000;
    color: #000;
    border-radius: 8px 8px 0 0;
}

/* Conteúdo das abas */
.tab-content {
    background-color: white;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 8px 8px;
    padding: 20px;
    margin-top: -1px; /* alinhamento perfeito com a aba ativa */
}

/* Animação de entrada */
.tab-pane {
    display: none;
    animation: fadeIn 0.3s ease-in-out;
}

.tab-pane.active {
    display: block;
}

/* Títulos e textos das abas */
.tab-pane h3,
.tab-pane h4 {
    color: #1552a1;
    margin-bottom: 15px;
}

.tab-pane p,
.tab-pane li {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

.tab-pane ul {
    padding-left: 20px;
    list-style: disc;
}

/* Animação */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
     function confirmarAcao(url, mensagem, sucessoMsg) {
        const modal = new bootstrap.Modal(document.getElementById('acaoModal'));
        document.getElementById('acaoModalBody').innerText = mensagem;

        const confirmarBtn = document.getElementById('confirmarAcaoBtn');
        confirmarBtn.onclick = function () {
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    modal.hide();
                    alert(sucessoMsg);
                    location.reload();
                } else {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Erro ao realizar ação.');
                    });
                }
            })
            .catch(error => {
                alert('Erro: ' + error.message);
            });
        };

        modal.show();
    }
     function filtrarPlanos(containerId, filtro) {
    const planos = document.querySelectorAll(`#${containerId} .plano-card-wrapper`);
    planos.forEach(plano => {
        const nomeAluno = plano.getAttribute('data-aluno')?.toLowerCase() || '';
        if (nomeAluno.includes(filtro)) {
            plano.style.display = '';
        } else {
            plano.style.display = 'none';
        }
    });
}

document.getElementById('filtroAluno').addEventListener('input', function () {
    const filtro = this.value.toLowerCase();

    filtrarPlanos('planosAtivosContainer', filtro);
    filtrarPlanos('planosCanceladosContainer', filtro);
});
</script>
@endpush
