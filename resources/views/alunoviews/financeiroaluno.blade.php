@extends('layouts.alunoheader')

@section('title', 'Mensalidades')
@section('page-title', 'Mensalidades')
@section('content')

 @php
    // Conta quantidade de mensalidades conforme status
    $qtdPago = $pagamentos->where('status', 'pago')->count();
    $qtdPendente = $pagamentos->where('status', 'pendente')->count();
    $qtdVencido = $pagamentos->where('status', 'vencido')->count();
@endphp

<div class="card resumo-financeiro">
    <h2>Resumo Financeiro</h2>
    <div class="resumo-itens">
        <div class="resumo-item pago">
            <span class="resumo-label">Mensalidades Pagas</span>
            <span class="resumo-valor">{{ $qtdPago }}</span>
        </div>
        <div class="resumo-item pendente">
            <span class="resumo-label">Mensalidades em aberto</span>
            <span class="resumo-valor">{{ $qtdPendente }}</span>
        </div>
        <div class="resumo-item atrasado">
            <span class="resumo-label">Mensalidades em atraso</span>
            <span class="resumo-valor">{{ $qtdVencido }}</span>
        </div>
    </div>
</div>

        <!-- Lista de Mensalidades -->
        <div class="card mensalidades-card">
            <div class="card-header">
                <h2>Pagamentos</h2>
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
                            <span class="info-valor">{{ $aluno->user->nome }}</span>
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
    background-color: rgba(0, 0, 0, 0.75); /* Fundo escuro mais forte */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.modal-content {
    background: #accdff96; /* Preto bem escuro */
    padding: 30px 30px;
    border-radius: 8px;
    width: 95%;
    max-width: 650px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 0 15px #0859d396; /* Sombra azul */
    color: #eee;
}

.btn-fechar {
    position: absolute;
    top: 8px;
    right: 32px;
    background: none;
    border: none;
    font-size: 2.4rem;
    line-height: 2;
    cursor: pointer;
    color: rgb(99, 0, 0); /* Amarelo vibrante */
    transition: color 0.3s ease;
}
.btn-fechar:hover {
    color: #76e4ff;
}

/* Tabela mensalidades */
.tabela-mensalidades {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px; /* Espaço entre linhas para deixar mais leve */
    margin-top: 15px;
    font-size: 0.95rem;
      color: #333;
}

.tabela-mensalidades th,
.tabela-mensalidades td {
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
}

.tabela-mensalidades th {
    background-color:#0859d396; /* Fundo escuro para cabeçalho */
    color: #000000;
    font-weight: 600;
    letter-spacing: 0.05em;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
}

.tabela-mensalidades tbody tr {
    background-color: #eee;
    box-shadow: 0 1px 4px rgb(0 0 0 / 0.4);
    transition: background-color 0.3s ease;
    border-radius: 8px;
    display: table-row; /* para manter formatação */
}

.tabela-mensalidades tbody tr:hover {
    background-color: #3482a148;
    cursor: pointer;
}

/* Status */
.status {
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: capitalize;
    font-size: 0.85rem;
    display: inline-block;
    min-width: 80px;
    text-align: center;
}

.status.pago {
    background-color: #4caf50;
    color: #fff;
}

.status.pendente {
    background-color: #ffc400;
    color: #000;
}

.status.atrasada {
    background-color: #f44336;
    color: #fff;
}

/* Botões de ação */
.acoes-btns {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.btn-acao {
    background-color: rgb(63, 63, 63);
    border: none;
    color: #ffffff;
    padding: 7px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease;
    text-decoration: none;
    cursor: pointer;
    justify-content: center;
    white-space: nowrap;
}

.btn-acao i {
    font-size: 1.1rem;
}

/* Hover para botões */
.btn-acao:hover {
    background-color: aquamarine;
    color: #000000;
    text-decoration: none;
}

/* Card do modal */
.detalhamento-card {
    background-color: #eee;
    border-radius: 10px;
    border: 1px solid #0859d396;
    
}

.detalhamento-card .card-header {
    border-bottom: 1px solid #0859d396;
    padding-bottom: 12px;
    margin-bottom: 15px;
    color: #000000;
}

.card-header-badge {
    background-color: #189df5;
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-block;
    margin-left: 10px;
}

.detalhamento-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
    color: #000000;
}

.info-grupo h3 {
    margin-bottom: 8px;
    color: #000000;
    font-weight: 700;
    border-bottom: 1px solid #189df5;
    padding-bottom: 6px;
}

.info-linha {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 0.9rem;
}

.info-label {
    font-weight: 600;
    color: #000000;
}

.info-valor {
    font-weight: 400;
}

/* Itens cobrança */
.itens-tabela {
    border: 1px solid #189df5;
    border-radius: 8px;
    overflow: hidden;
}

.item-cobranca {
    display: flex;
    justify-content: space-between;
    padding: 10px 15px;
    font-size: 0.9rem;
    color: #000000;
}

.item-cobranca.header {
    background-color: #eee;
    font-weight: 700;
    color: #000000;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.item-cobranca.destaque {
    background-color: #0859d396;
    color: #000000;
    font-weight: 700;
    font-size: 1rem;
}

/* Responsividade */
@media (max-width: 480px) {
    .acoes-btns {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 6px;
    }

    .btn-acao {
        flex: 1 1 auto;
        font-size: 0.85rem;
        padding: 6px 8px;
    }

    .tabela-mensalidades th,
    .tabela-mensalidades td {
        padding: 8px 10px;
        font-size: 0.85rem;
    }
}
.resumo-financeiro {
    background-color: #0859d396;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.resumo-financeiro h2 {
    margin-bottom: 15px;
    color: rgb(63, 63, 63);
    font-weight: 700;
    font-size: 1.5rem;
}

.resumo-itens {
    display: flex;
    gap: 20px;
    justify-content: space-between;
}

.resumo-item {
    flex: 1;
    background-color: #eee;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 204, 255, 0.3);
    transition: background-color 0.3s ease;
}

.resumo-item:hover {
    background-color: aquamarine;
}

.resumo-label {
    display: block;
    font-size: 1rem;
    margin-bottom: 8px;
    color: #000000;
}

.resumo-valor {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1100ff;
}

/* Cores específicas para cada status */
.resumo-item.pago .resumo-valor {
    color: #4caf50; /* verde */
}

.resumo-item.pendente .resumo-valor {
    color: #ff9800; /* laranja */
}

.resumo-item.atrasado .resumo-valor {
    color: #f44336; /* vermelho */
}


</style>
