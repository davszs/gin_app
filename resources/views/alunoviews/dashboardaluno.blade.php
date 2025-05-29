<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Aluno - Dashboard</title>
    <link rel="stylesheet" href={{asset('css/estilo_basico.css')}}>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
     <nav class="sidebar">

             <div class="logo">
                <a href="#"><i class="fas fa-dumbbell"></i></a>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('aluno.dashboard') }}" title="Início"><i class="fas fa-home"></i><span>Início</span></a></li>
                <li class="active"><a href="{{ route('aulas.aluno') }}" title="Aulas"><i
                            class="fas fa-calendar-alt"></i><span>Aulas</span></a></li>
                <li><a href="{{ route('comunicados.aluno') }}" title="Comunicados"><i
                            class="fas fa-bullhorn"></i><span>Comunicados</span></a></li>
                <li><a href="{{ route('pagamento.aluno') }}" title="Financeiro"><i
                            class="fas fa-wallet"></i><span>Financeiro</span></a></li>
                <li><a href="#" title="Suporte"><i class="fas fa-headset"></i><span>Suporte</span></a></li>
                <li class="sidebar-bottom">
                    <a href="#" title="Configurações"><i
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
    <!-- Estrutura principal -->
    <div class="container">
        
        <!-- Conteúdo Principal -->
        <main class="content"><!-- Cabeçalho -->
            <header class="top-bar">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
                <div class="user-info"><span>Logado como <strong>Aluno</strong></span>
                    <div class="user-avatar"><img src="https://via.placeholder.com/40" alt="Avatar do usuário"></div>
                </div>
            </header><!-- Dashboard Content -->
            <div class="dashboard-container"><!-- Card Plano -->
                <div class="card plano-card">
                    <div class="card-header">
                        <h2>Meu Plano</h2>
                    </div>
                    <div class="card-body">
                        <div class="plano-info">
                            <div class="plano-tipo">
                                <h3>Plano Trimestral</h3><span class="status ativo">Ativo</span>
                            </div>
                            <div class="plano-detalhes">
                                <div class="info-item"><span class="label">Valor Mensal:</span><span class="value">R$
                                        89,90</span></div>
                                <div class="info-item"><span class="label">Próximo Vencimento:</span><span
                                        class="value">15/04/2025</span></div>
                                <div class="info-item"><span class="label">Término do Plano:</span><span
                                        class="value">30/06/2025</span></div>
                            </div>
                        </div>
                    </div>
                </div><!-- Card Agenda -->
                <div class="card agenda-card">
                    <div class="card-header">
                        <h2>Agenda da Semana</h2>
                    </div>
                    <div class="card-body">
                        <div class="agenda-dias">
                            <div class="agenda-item">
                                <div class="agenda-dia">Segunda-feira</div>
                                <div class="agenda-aulas">
                                    <div class="aula"><span class="aula-horario">07:00</span><span
                                            class="aula-nome">Musculação</span><span class="aula-prof">Prof.
                                            Carlos</span></div>
                                    <div class="aula"><span class="aula-horario">18:30</span><span
                                            class="aula-nome">Spinning</span><span class="aula-prof">Prof. Ana</span>
                                    </div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-dia">Quarta-feira</div>
                                <div class="agenda-aulas">
                                    <div class="aula"><span class="aula-horario">07:00</span><span
                                            class="aula-nome">Musculação</span><span class="aula-prof">Prof.
                                            Carlos</span></div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-dia">Sexta-feira</div>
                                <div class="agenda-aulas">
                                    <div class="aula"><span class="aula-horario">07:00</span><span
                                            class="aula-nome">Musculação</span><span class="aula-prof">Prof.
                                            Carlos</span></div>
                                    <div class="aula"><span class="aula-horario">18:30</span><span
                                            class="aula-nome">Spinning</span><span class="aula-prof">Prof. Ana</span>
                                    </div>
                                </div>
                            </div>
                        </div><button class="btn btn-primary">Ver agenda completa</button>
                    </div>
                </div><!-- Card Frequência -->
                <div class="card frequencia-card">
                    <div class="card-header">
                        <h2>Frequência Semanal</h2>
                    </div>
                    <div class="card-body">
                        <div class="grafico-frequencia">
                            <div class="dias-semana">
                                <div class="dia-semana">
                                    <div class="dia-nome">SEG</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 80%"></div>
                                    </div>
                                    <div class="dia-valor">80%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">TER</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 0%"></div>
                                    </div>
                                    <div class="dia-valor">0%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">QUA</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 100%"></div>
                                    </div>
                                    <div class="dia-valor">100%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">QUI</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 0%"></div>
                                    </div>
                                    <div class="dia-valor">0%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">SEX</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 90%"></div>
                                    </div>
                                    <div class="dia-valor">90%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">SÁB</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 50%"></div>
                                    </div>
                                    <div class="dia-valor">50%</div>
                                </div>
                                <div class="dia-semana">
                                    <div class="dia-nome">DOM</div>
                                    <div class="barra-container">
                                        <div class="barra" style="height: 0%"></div>
                                    </div>
                                    <div class="dia-valor">0%</div>
                                </div>
                            </div>
                        </div>
                        <div class="frequencia-resumo">
                            <div class="resumo-item"><span class="label">Total da semana:</span><span class="value">4
                                    dias</span></div>
                            <div class="resumo-item"><span class="label">Média do mês:</span><span class="value">3.5
                                    dias/semana</span></div>
                        </div>
                    </div>
                </div><!-- Card Comunicados -->
                <div class="card comunicados-card">
                    <div class="card-header">
                        <h2>Comunicados</h2>
                    </div>
                    <div class="card-body">
                        <div class="comunicados-lista">
                            <div class="comunicado">
                                <div class="comunicado-data">12/04/2025</div>
                                <div class="comunicado-conteudo">
                                    <h4>Manutenção das Esteiras</h4>
                                    <p>Informamos que as esteiras estarão em manutenção no dia 16/04 das 10h às 14h.</p>
                                </div>
                            </div>
                            <div class="comunicado">
                                <div class="comunicado-data">10/04/2025</div>
                                <div class="comunicado-conteudo">
                                    <h4>Nova Aula de Yoga</h4>
                                    <p>A partir de segunda-feira, teremos aulas de Yoga às terças e quintas às 19h.</p>
                                </div>
                            </div>
                            <div class="comunicado">
                                <div class="comunicado-data">08/04/2025</div>
                                <div class="comunicado-conteudo">
                                    <h4>Promoção para Amigos</h4>
                                    <p>Traga um amigo e ganhe 15% de desconto na mensalidade do próximo mês!</p>
                                </div>
                            </div>
                        </div><button class="btn btn-primary">Ver todos os comunicados</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>