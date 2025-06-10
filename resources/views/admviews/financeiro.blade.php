@extends('layouts.admheader')

@section('title', 'Financeiro')
@section('page-title', 'Gerenciamento do Financeiro')

@section('content')
  @php
    $totalRecebido = $pagamentos->where('status', 'pago')->sum('valor');
@endphp

<div class="financeiro-cards">
    <div class="financeiro-card">
        <h6>Total de Entradas</h6>
        <h4 class="text-success">R$ {{ number_format($totalRecebido, 2, ',', '.') }}</h4>
    </div>
    <div class="financeiro-card despesa">
        <h6>Total de Despesas</h6>
        <h4 class="text-danger">R$ 0,00</h4> <!-- Para integração futura -->
    </div>
</div>
<form method="GET" action="{{ route('financeiro') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label for="mes" class="form-label">Mês:</label>
            <input type="month" name="mes" id="mes" value="{{ request('mes') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="aluno" class="form-label">Aluno:</label>
            <select name="aluno" id="aluno" class="form-select">
                <option value="">Todos os alunos</option>
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->user->id }}">{{ $aluno->user->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
<div class="container mt-4">

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#198754'
            });
        </script>
    @endif

    

    

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-bordered table-hover align-middle">
            
            <thead class="table-dark">
                <tr>
                    <th>Aluno</th>
                    <th>Plano</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Vencimento</th>
                    <th>Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                @foreach($pagamentos as $pagamento)
                    @php
                        $vencido = $pagamento->status === 'pendente' && \Carbon\Carbon::parse($pagamento->vencimento)->isPast();
                        $classe = $vencido ? 'table-danger' : '';
                    @endphp
                    <tr class="{{ $classe }}">
                        <td>{{ $pagamento->plano->aluno?->user?->nome ?? 'Aluno não encontrado' }}</td>
                        <td>{{ $pagamento->plano->nome }}</td>
                        <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $pagamento->status === 'pendente' ? 'warning' : ($pagamento->status === 'pago com atraso' ? 'danger' : 'success') }}">
                                {{ ucfirst($pagamento->status) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}</td>
                        <td>{{ $pagamento->data_pagamento ? \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($pagamento->status !== 'pago' && $pagamento->status !== 'pago com atraso')
                                <button class="btn btn-success btn-sm" 
                                        onclick="abrirModalPagamento({{ $pagamento->id }}, '{{ $pagamento->valor }}', '{{ $pagamento->vencimento }}')">
                                    Marcar como Pago
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pagamento -->
<div class="modal fade" id="modalPagamento" tabindex="-1" aria-labelledby="modalPagamentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('financeiro.atualizar') }}" class="modal-content">
      @csrf
      <input type="hidden" name="pagamento_id" id="pagamento_id">
      <input type="hidden" name="valor_original" id="valor_original">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPagamentoLabel">Marcar como Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="data_pagamento" class="form-label">Data do Pagamento:</label>
          <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" required>
        </div>
        <div id="avisoAtraso" class="alert alert-danger d-none">
          Pagamento em atraso! Multa de 10% será aplicada.
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>
  
   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@push('styles')
<style>
    .financeiro-card {
        background: #f9fafb;
        border-left: 5px solid #4CAF50;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        text-align: left;
        flex: 1;
    }

    .financeiro-card.despesa {
        border-left-color: #f44336;
    }

    .financeiro-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    

    
</style>
@endpush

@push('scripts')
<script>
    function abrirModalPagamento(pagamentoId, valor, vencimento) {
    const modal = new bootstrap.Modal(document.getElementById('modalPagamento'));
    document.getElementById('pagamento_id').value = pagamentoId;
    document.getElementById('valor_original').value = valor;

    const hoje = new Date();
    const dataVencimento = new Date(vencimento);
    const aviso = document.getElementById('avisoAtraso');

    aviso.classList.toggle('d-none', !(hoje > dataVencimento));
    modal.show();
}
</script>
@endpush