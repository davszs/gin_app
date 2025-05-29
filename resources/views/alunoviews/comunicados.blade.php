<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Aluno - Comunicados</title>
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

        <!-- Conteúdo Principal -->
        <main class="content">
            <!-- Cabeçalho -->
            <header class="top-bar">
                <div class="page-title">
                    <h1>Comunicados</h1>
                </div>
                <div class="user-info">
                    <span>Logado como <strong>Aluno</strong></span>
                    <div class="user-avatar">
                        <img src="https://via.placeholder.com/40" alt="Avatar do usuário">
                    </div>
                </div>
            </header>

            <!-- Conteúdo dos Comunicados -->
            <div class="comunicados-container">
                <!-- Filtros -->
                <div class="comunicados-filtros">
                    <button class="filtro-btn ativo" data-filter="todos">Todos</button>
                    <button class="filtro-btn" data-filter="geral">Geral</button>
                    <button class="filtro-btn" data-filter="aulas">Aulas</button>
                </div>

                <!-- Lista de Comunicados -->
                <div class="comunicados-lista-completa">
                    <!-- Comunicado Importante -->
                    <div class="comunicado-card importante" data-tipo="geral">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">15/04/2025</span>
                                <span class="comunicado-tag">Geral</span>
                            </div>
                            <div class="comunicado-importante-badge">
                                <i class="fas fa-exclamation-circle"></i> Importante
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Alteração no Horário de Funcionamento</h3>
                            <p class="comunicado-texto">Informamos que a partir do dia 20/04/2025, nossa academia
                                passará a funcionar em horário estendido de segunda a sexta, das 05h às 23h. Aos
                                sábados, o funcionamento será das 08h às 18h e aos domingos das 09h às 15h.</p>
                            <p class="comunicado-texto">Esta alteração tem como objetivo atender melhor nossos alunos e
                                proporcionar mais flexibilidade para suas atividades físicas.</p>
                        </div>
                    </div>

                    <!-- Comunicado Normal -->
                    <div class="comunicado-card" data-tipo="aulas">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">12/04/2025</span>
                                <span class="comunicado-tag">Aulas</span>
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Manutenção das Esteiras</h3>
                            <p class="comunicado-texto">Informamos que as esteiras estarão em manutenção no dia 16/04
                                das 10h às 14h. Durante este período, sugerimos o uso das bicicletas ergométricas ou a
                                participação em nossas aulas coletivas.</p>
                        </div>
                    </div>

                    <!-- Comunicado Normal -->
                    <div class="comunicado-card" data-tipo="aulas">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">10/04/2025</span>
                                <span class="comunicado-tag">Aulas</span>
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Nova Aula de Yoga</h3>
                            <p class="comunicado-texto">A partir de segunda-feira, teremos aulas de Yoga às terças e
                                quintas às 19h. As inscrições podem ser feitas na recepção ou pelo aplicativo. Vagas
                                limitadas!</p>
                        </div>
                    </div>

                    <!-- Comunicado Importante -->
                    <div class="comunicado-card importante" data-tipo="geral">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">08/04/2025</span>
                                <span class="comunicado-tag">Geral</span>
                            </div>
                            <div class="comunicado-importante-badge">
                                <i class="fas fa-exclamation-circle"></i> Importante
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Promoção para Amigos</h3>
                            <p class="comunicado-texto">Traga um amigo e ganhe 15% de desconto na mensalidade do próximo
                                mês! Promoção válida até 30/04/2025. Consulte as regras na recepção.</p>
                        </div>
                    </div>

                    <!-- Comunicado Normal -->
                    <div class="comunicado-card" data-tipo="geral">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">05/04/2025</span>
                                <span class="comunicado-tag">Geral</span>
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Limpeza da Piscina</h3>
                            <p class="comunicado-texto">A piscina estará fechada para limpeza no dia 18/04/2025, durante
                                todo o dia. As aulas de natação deste dia serão repostas conforme agenda a ser
                                divulgada.</p>
                        </div>
                    </div>

                    <!-- Comunicado Normal -->
                    <div class="comunicado-card" data-tipo="aulas">
                        <div class="comunicado-header">
                            <div class="comunicado-info">
                                <span class="comunicado-data">01/04/2025</span>
                                <span class="comunicado-tag">Aulas</span>
                            </div>
                        </div>
                        <div class="comunicado-body">
                            <h3 class="comunicado-titulo">Cancelamento de Aula de Spinning</h3>
                            <p class="comunicado-texto">A aula de Spinning do dia 02/04 às 18h30 foi cancelada devido a
                                problemas técnicos. Pedimos desculpas pelo transtorno.</p>
                        </div>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="paginacao">
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </main>
    </div>
</body>

</html>