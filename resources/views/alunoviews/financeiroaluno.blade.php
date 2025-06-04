@extends('layouts.alunoheader')

@section('title', 'Mensalidades')
@section('page-title', 'Mensalidades')
@section('content')

    <div class="financeiro-container">
        <!-- Resumo Financeiro -->
        <div class="card resumo-financeiro">
            <!-- ... (mesmo código do resumo) -->
        </div>

        <!-- Lista de Mensalidades -->
        <div class="card mensalidades-card">
            <div class="card-header">
                <h2>Mensalidades</h2>
                <div class="card-header-actions">
                    <select class="filtro-select" onchange="filtrarMensalidades(this.value)">
                        <option value="todas">Todas</option>
                        <option value="pago">Pagas</option>
                        <option value="pendente">Pendentes</option>
                        <option value="vencido">Atrasadas</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="tabela-responsive">
                    <table class="tabela-mensalidades" id="tabela-mensalidades">
                        <thead>
                            <tr>
                                <th>Referência</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagamentos as $pagamento)
                                <tr data-status="{{ $pagamento->status }}" 
                                    data-id="{{ $pagamento->id }}"
                                    data-referencia="{{ \Carbon\Carbon::parse($pagamento->data_referencia)->format('F/Y') }}"
                                    data-vencimento="{{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}"
                                    data-valor="{{ number_format($pagamento->valor, 2, ',', '.') }}"
                                    data-status-text="{{ ucfirst($pagamento->status) }}"
                                    data-plano="{{ $pagamento->plano->nome ?? 'Plano não definido' }}"
                                >
                                    <td>{{ \Carbon\Carbon::parse($pagamento->data_referencia)->format('M/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($pagamento->status) {
                                                'pago' => 'pago',
                                                'pendente' => 'pendente',
                                                'vencido' => 'atrasada',
                                                default => '',
                                            };
                                        @endphp
                                        <span class="status {{ $statusClass }}">
                                            {{ ucfirst($pagamento->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="acoes-btns">
                                            <a href="{{ route('pagamento.gerarBoleto', $pagamento->id) }}" class="btn-acao btn-gerar" title="Gerar Boleto" target="_blank">
                                                <i class="fas fa-qrcode"></i>
                                                <span>Pague com pix</span>
                                            </a>
                                            <br> <button class="btn-acao btn-detalhe" data-pagamento-id="{{ $pagamento->id }}">
                                                <i class="fas fa-eye"></i>
                                                <span>Ver-Detalhes</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if($pagamentos->isEmpty())
                                <tr>
                                    <td colspan="5">Nenhum pagamento encontrado.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Detalhamento de Mensalidade -->
    <!-- Modal Detalhamento -->
<div id="modal-detalhamento" class="modal" style="display: none;">
    <div class="modal-content">
        <button id="btn-fechar-detalhamento" class="btn-fechar">&times;</button>
        <div class="card detalhamento-card">
            <div class="card-header">
                <h2>Detalhamento da Mensalidade</h2>
                <div class="card-header-badge" id="detalhamento-referencia"></div>
            </div>
            <div class="card-body">
                <div class="detalhamento-info">
                    <div class="info-grupo">
                        <h3>Informações Gerais</h3>
                        <div class="info-linha">
                            <span class="info-label">Aluno:</span>
                            <span class="info-valor">{{ $aluno->nome }}</span>
                        </div>
                        <div class="info-linha">
                            <span class="info-label">Plano:</span>
                            <span class="info-valor" id="detalhamento-plano"></span>
                        </div>
                        <div class="info-linha">
                            <span class="info-label">Referência:</span>
                            <span class="info-valor" id="detalhamento-mes-ano"></span>
                        </div>
                        <div class="info-linha">
                            <span class="info-label">Vencimento:</span>
                            <span class="info-valor" id="detalhamento-vencimento"></span>
                        </div>
                    </div>

                    <div class="info-grupo">
                        <h3>Itens Cobrados</h3>
                        <div class="itens-tabela">
                            <div class="item-cobranca header">
                                <span class="item-descricao">Descrição</span>
                                <span class="item-valor">Valor</span>
                            </div>
                            <div class="item-cobranca">
                                <span class="item-descricao" id="detalhamento-descricao"></span>
                                <span class="item-valor" id="detalhamento-valor"></span>
                            </div>
                            <div class="item-cobranca destaque">
                                <span class="item-descricao">Total</span>
                                <span class="item-valor" id="detalhamento-total"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
    function atualizarDetalhamento(row) {
        // Preenche os dados
        document.getElementById('detalhamento-referencia').textContent = row.getAttribute('data-referencia');
        document.getElementById('detalhamento-plano').textContent = row.getAttribute('data-plano');
        document.getElementById('detalhamento-mes-ano').textContent = row.getAttribute('data-referencia');
        document.getElementById('detalhamento-vencimento').textContent = row.getAttribute('data-vencimento');

        const valor = row.getAttribute('data-valor');
        const planoNome = row.getAttribute('data-plano');

        document.getElementById('detalhamento-descricao').textContent = 'Mensalidade Plano ' + planoNome;
        document.getElementById('detalhamento-valor').textContent = 'R$ ' + valor;
        document.getElementById('detalhamento-total').textContent = 'R$ ' + valor;

        // Mostra o modal
        document.getElementById('modal-detalhamento').style.display = 'flex';
    }

    // Delegação de evento para os botões 'Ver Detalhes'
    document.querySelector('#tabela-mensalidades tbody').addEventListener('click', function(e) {
        if (e.target.closest('.btn-detalhe')) {
            const button = e.target.closest('.btn-detalhe');
            const pagamentoId = button.getAttribute('data-pagamento-id');
            const row = document.querySelector(`tr[data-id='${pagamentoId}']`);
            if (row) {
                atualizarDetalhamento(row);
            }
        }
    });

    // Fechar modal
    document.getElementById('btn-fechar-detalhamento').addEventListener('click', () => {
        document.getElementById('modal-detalhamento').style.display = 'none';
    });

    // Fecha modal se clicar fora do conteúdo
    document.getElementById('modal-detalhamento').addEventListener('click', (e) => {
        if (e.target.id === 'modal-detalhamento') {
            document.getElementById('modal-detalhamento').style.display = 'none';
        }
    });

});


    // Função global (se quiser que o select funcione)
    window.filtrarMensalidades = filtrarMensalidades;
    // Função para filtrar (se já quiser usar no carregamento)
    function filtrarMensalidades(status) {
        const rows = document.querySelectorAll("#tabela-mensalidades tbody tr");
        rows.forEach(row => {
            const rowStatus = row.getAttribute("data-status");
            if (status === 'todas' || rowStatus === status) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }


    </script>

@endsection

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5); /* Fundo escuro transparente */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000; /* na frente de tudo */
}

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
}

.btn-fechar {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 2rem;
    line-height: 1;
    cursor: pointer;
    color: #333;
}
.tabela-mensalidades {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.tabela-mensalidades th,
.tabela-mensalidades td {
    border: 1px solid #ddd; /* Linha divisória */
    padding: 8px;
    text-align: left;
}

.tabela-mensalidades th {
    background-color: #f5f5f5;
    font-weight: bold;
}
</style>
