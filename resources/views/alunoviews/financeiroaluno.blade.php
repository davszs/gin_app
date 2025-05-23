<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Aluno - Financeiro</title>
    <link rel="stylesheet" href={{asset('css/estilo_basico.css')}}>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Estrutura principal -->
    <div class="container">
        <!-- Menu Lateral -->
        <nav class="sidebar">

             <div class="logo">
                <a href="#"><i class="fas fa-dumbbell"></i></a>
            </div>
            <ul class="nav-links">
                <li><a href="inicio.html" title="Início"><i class="fas fa-home"></i><span>Início</span></a></li>
                <li class="active"><a href="aulas.html" title="Aulas"><i
                            class="fas fa-calendar-alt"></i><span>Aulas</span></a></li>
                <li><a href="comunicados.html" title="Comunicados"><i
                            class="fas fa-bullhorn"></i><span>Comunicados</span></a></li>
                <li><a href="financeiro.html" title="Financeiro"><i
                            class="fas fa-wallet"></i><span>Financeiro</span></a></li>
                <li><a href="suporte.html" title="Suporte"><i class="fas fa-headset"></i><span>Suporte</span></a></li>
                <li class="sidebar-bottom">
                    <a href="configuracoes.html" title="Configurações"><i
                            class="fas fa-cog"></i><span>Configurações</span></a>
                </li>
               <li><a href="#" id="logoutTrigger"><i class="fas fa-sign-out-alt"></i><span>Desconectar</span></a></li>
            </ul>
        </nav>

         {{-- Modal de logout --}}
    <div id="logoutModal" class="logout-overlay" style="display: none;">
        <div class="logout-box">
            <p>Tem certeza que deseja desconectar a conta e sair?</p>
            <div class="logout-buttons">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm">Sim, sair</button>
                </form>
                <button class="cancel" id="cancelLogout">Cancelar</button>
            </div>
        </div>
        
    </div>

      @if (session('status'))
        <div class="overlay-message" id="overlayMessage">
            <div class="alert-box">
                <p>{{ session('status') }}</p>
                <button id="okBtn">OK</button>
            </div>
        </div>
        @endif
    </div>


    {{-- Scripts relacionados à sidebar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const okBtn = document.getElementById("okBtn");
            const overlay = document.getElementById("overlayMessage");
            if (okBtn && overlay) {
                okBtn.addEventListener("click", () => overlay.style.display = "none");
            }

            const logoutLink = document.getElementById("logoutTrigger");
            const logoutModal = document.getElementById("logoutModal");
            const cancelBtn = document.getElementById("cancelLogout");

            logoutLink?.addEventListener("click", e => {
                e.preventDefault();
                logoutModal.style.display = "flex";
            });

            cancelBtn?.addEventListener("click", () => {
                logoutModal.style.display = "none";
            });
        });
    </script>

        <!-- Conteúdo Principal -->
        <main class="content">
            <!-- Cabeçalho -->
            <header class="top-bar">
                <div class="page-title">
                    <h1>Financeiro</h1>
                </div>
                <div class="user-info">
                    <span>Logado como <strong>Aluno</strong></span>
                    <div class="user-avatar">
                        <img src="https://via.placeholder.com/40" alt="Avatar do usuário">
                    </div>
                </div>
            </header>

            <!-- Conteúdo Financeiro -->
            <div class="financeiro-container">
                <!-- Resumo Financeiro -->
                <div class="card resumo-financeiro">
                    <div class="card-header">
                        <h2>Resumo Financeiro</h2>
                    </div>
                    <div class="card-body">
                        <div class="resumo-cards">
                            <div class="mini-card">
                                <div class="mini-card-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="mini-card-content">
                                    <span class="mini-card-label">Mensalidades Pagas</span>
                                    <span class="mini-card-value">3</span>
                                </div>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-icon warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="mini-card-content">
                                    <span class="mini-card-label">Mensalidades Pendentes</span>
                                    <span class="mini-card-value">1</span>
                                </div>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-icon danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="mini-card-content">
                                    <span class="mini-card-label">Mensalidades Atrasadas</span>
                                    <span class="mini-card-value">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Mensalidades -->
                <div class="card mensalidades-card">
                    <div class="card-header">
                        <h2>Mensalidades</h2>
                        <div class="card-header-actions">
                            <select class="filtro-select">
                                <option value="todas">Todas</option>
                                <option value="pagas">Pagas</option>
                                <option value="pendentes">Pendentes</option>
                                <option value="atrasadas">Atrasadas</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tabela-responsive">
                            <table class="tabela-mensalidades">
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
                                    <tr>
                                        <td>Abr/2025</td>
                                        <td>15/04/2025</td>
                                        <td>R$ 89,90</td>
                                        <td><span class="status pendente">Pendente</span></td>
                                        <td>
                                            <div class="acoes-btns">
                                                <button class="btn-acao btn-gerar">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <span>Boleto</span>
                                                </button>
                                                <button class="btn-acao btn-detalhe" data-fatura="abr2025">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mar/2025</td>
                                        <td>15/03/2025</td>
                                        <td>R$ 89,90</td>
                                        <td><span class="status pago">Pago</span></td>
                                        <td>
                                            <div class="acoes-btns">
                                                <button class="btn-acao btn-recibo">
                                                    <i class="fas fa-receipt"></i>
                                                    <span>Recibo</span>
                                                </button>
                                                <button class="btn-acao btn-detalhe" data-fatura="mar2025">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fev/2025</td>
                                        <td>15/02/2025</td>
                                        <td>R$ 89,90</td>
                                        <td><span class="status pago">Pago</span></td>
                                        <td>
                                            <div class="acoes-btns">
                                                <button class="btn-acao btn-recibo">
                                                    <i class="fas fa-receipt"></i>
                                                    <span>Recibo</span>
                                                </button>
                                                <button class="btn-acao btn-detalhe" data-fatura="fev2025">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jan/2025</td>
                                        <td>15/01/2025</td>
                                        <td>R$ 89,90</td>
                                        <td><span class="status pago">Pago</span></td>
                                        <td>
                                            <div class="acoes-btns">
                                                <button class="btn-acao btn-recibo">
                                                    <i class="fas fa-receipt"></i>
                                                    <span>Recibo</span>
                                                </button>
                                                <button class="btn-acao btn-detalhe" data-fatura="jan2025">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Detalhamento de Mensalidade -->
                <div class="card detalhamento-card">
                    <div class="card-header">
                        <h2>Detalhamento da Mensalidade</h2>
                        <div class="card-header-badge">Abr/2025</div>
                    </div>
                    <div class="card-body">
                        <div class="detalhamento-info">
                            <div class="info-grupo">
                                <h3>Informações Gerais</h3>
                                <div class="info-linha">
                                    <span class="info-label">Aluno:</span>
                                    <span class="info-valor">Rafael Silva</span>
                                </div>
                                <div class="info-linha">
                                    <span class="info-label">Plano:</span>
                                    <span class="info-valor">Trimestral</span>
                                </div>
                                <div class="info-linha">
                                    <span class="info-label">Referência:</span>
                                    <span class="info-valor">Abril/2025</span>
                                </div>
                                <div class="info-linha">
                                    <span class="info-label">Vencimento:</span>
                                    <span class="info-valor">15/04/2025</span>
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
                                        <span class="item-descricao">Mensalidade Plano Trimestral</span>
                                        <span class="item-valor">R$ 89,90</span>
                                    </div>
                                    <div class="item-cobranca destaque">
                                        <span class="item-descricao">Total</span>
                                        <span class="item-valor">R$ 89,90</span>
                                    </div>
                                </div>
                            </div>

                            <div class="info-grupo">
                                <h3>Formas de Pagamento</h3>
                                <div class="pagamento-opcoes">
                                    <div class="opcao-pagamento">
                                        <button class="btn-pagamento">
                                            <i class="fas fa-barcode"></i>
                                            <span>Boleto Bancário</span>
                                        </button>
                                    </div>
                                    <div class="opcao-pagamento">
                                        <button class="btn-pagamento">
                                            <i class="fas fa-credit-card"></i>
                                            <span>Cartão de Crédito</span>
                                        </button>
                                    </div>
                                    <div class="opcao-pagamento">
                                        <button class="btn-pagamento">
                                            <i class="fas fa-qrcode"></i>
                                            <span>PIX</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detalhamento-acoes">
                            <button class="btn btn-primary btn-gerar-pdf">
                                <i class="fas fa-file-pdf"></i> Gerar Boleto PDF
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Histórico de Pagamentos -->
                <div class="card historico-card">
                    <div class="card-header">
                        <h2>Histórico de Pagamentos</h2>
                    </div>
                    <div class="card-body">
                        <div class="tabela-responsive">
                            <table class="tabela-historico">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Referência</th>
                                        <th>Valor</th>
                                        <th>Forma de Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>15/03/2025</td>
                                        <td>Mar/2025</td>
                                        <td>R$ 89,90</td>
                                        <td>Cartão de Crédito</td>
                                    </tr>
                                    <tr>
                                        <td>15/02/2025</td>
                                        <td>Fev/2025</td>
                                        <td>R$ 89,90</td>
                                        <td>Boleto Bancário</td>
                                    </tr>
                                    <tr>
                                        <td>15/01/2025</td>
                                        <td>Jan/2025</td>
                                        <td>R$ 89,90</td>
                                        <td>PIX</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>