<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Aluno - Aulas</title>
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
            </ul>
        </nav>

        <!-- Conteúdo Principal -->
        <main class="content">
            <!-- Cabeçalho -->
            <header class="top-bar">
                <div class="page-title">
                    <h1>Aulas</h1>
                </div>
                <div class="user-info">
                    <span>Logado como <strong>Aluno</strong></span>
                    <div class="user-avatar">
                        <img src="https://via.placeholder.com/40" alt="Avatar do usuário">
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-container">
                <!-- Card Aulas Disponíveis -->
                <div class="card plano-card">
                    <div class="card-header">
                        <h2>Aulas Disponíveis</h2>
                    </div>
                    <div class="card-body">
                        <!-- Filtros -->
                        <div class="filtros" style="display: flex; gap: 10px; margin-bottom: 15px;">
                            <select
                                style="padding: 8px; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                                <option value="">Todas as modalidades</option>
                                <option value="musculacao">Musculação</option>
                                <option value="pilates">Pilates</option>
                                <option value="yoga">Yoga</option>
                                <option value="spinning">Spinning</option>
                                <option value="funcional">Funcional</option>
                            </select>
                            <select
                                style="padding: 8px; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                                <option value="">Todos os dias</option>
                                <option value="segunda">Segunda-feira</option>
                                <option value="terca">Terça-feira</option>
                                <option value="quarta">Quarta-feira</option>
                                <option value="quinta">Quinta-feira</option>
                                <option value="sexta">Sexta-feira</option>
                                <option value="sabado">Sábado</option>
                            </select>
                        </div>

                        <!-- Lista de Aulas -->
                        <div class="aulas-lista">
                            <div class="agenda-item">
                                <div class="plano-tipo">
                                    <h3>Circuito Funcional</h3>
                                    <span class="status ativo">Vagas: 5/20</span>
                                </div>
                                <div class="plano-detalhes">
                                    <div class="info-item">
                                        <span class="label">Professor:</span>
                                        <span class="value">Ricardo Silva</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Dias:</span>
                                        <span class="value">Terça e Quinta</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Horário:</span>
                                        <span class="value">19:00 - 20:00</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Local:</span>
                                        <span class="value">Sala 2</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary"
                                    style="width: 100%; margin-top: 15px;">Inscrever-se</button>
                            </div>

                            <div class="agenda-item" style="margin-top: 20px;">
                                <div class="plano-tipo">
                                    <h3>Pilates Solo</h3>
                                    <span class="status ativo">Vagas: 8/12</span>
                                </div>
                                <div class="plano-detalhes">
                                    <div class="info-item">
                                        <span class="label">Professor:</span>
                                        <span class="value">Mariana Costa</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Dias:</span>
                                        <span class="value">Segunda, Quarta e Sexta</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Horário:</span>
                                        <span class="value">08:00 - 09:00</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Local:</span>
                                        <span class="value">Sala 3</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary"
                                    style="width: 100%; margin-top: 15px;">Inscrever-se</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Minhas Aulas -->
                <div class="card agenda-card">
                    <div class="card-header">
                        <h2>Minhas Aulas</h2>
                    </div>
                    <div class="card-body">
                        <div class="aulas-inscritas">
                            <div class="agenda-item">
                                <div class="plano-tipo">
                                    <h3>Treino em Grupo</h3>
                                    <span class="status ativo">Confirmada</span>
                                </div>
                                <div class="plano-detalhes">
                                    <div class="info-item">
                                        <span class="label">Professor:</span>
                                        <span class="value">André Oliveira</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Dias:</span>
                                        <span class="value">Segunda e Quarta</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Horário:</span>
                                        <span class="value">17:00 - 18:00</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Local:</span>
                                        <span class="value">Sala de Musculação</span>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 15px;">
                                    <button class="btn btn-primary" style="flex: 1;">Detalhes</button>
                                    <button class="btn"
                                        style="flex: 1; background-color: var(--danger-color);">Cancelar</button>
                                </div>
                            </div>

                            <div class="agenda-item" style="margin-top: 20px;">
                                <div class="plano-tipo">
                                    <h3>Zumba Dance</h3>
                                    <span class="status ativo">Confirmada</span>
                                </div>
                                <div class="plano-detalhes">
                                    <div class="info-item">
                                        <span class="label">Professor:</span>
                                        <span class="value">Fernanda Lima</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Dias:</span>
                                        <span class="value">Terça e Quinta</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Horário:</span>
                                        <span class="value">20:00 - 21:00</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Local:</span>
                                        <span class="value">Sala 1</span>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 15px;">
                                    <button class="btn btn-primary" style="flex: 1;">Detalhes</button>
                                    <button class="btn"
                                        style="flex: 1; background-color: var(--danger-color);">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Próximas Aulas -->
                <div class="card frequencia-card">
                    <div class="card-header">
                        <h2>Próximas Aulas</h2>
                    </div>
                    <div class="card-body">
                        <div class="agenda-dias">
                            <div class="agenda-item">
                                <div class="agenda-dia">Hoje</div>
                                <div class="agenda-aulas">
                                    <div class="aula">
                                        <span class="aula-horario">17:00</span>
                                        <span class="aula-nome">Treino em Grupo</span>
                                        <span class="aula-prof">Prof. André</span>
                                    </div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-dia">Amanhã</div>
                                <div class="agenda-aulas">
                                    <div class="aula">
                                        <span class="aula-horario">20:00</span>
                                        <span class="aula-nome">Zumba Dance</span>
                                        <span class="aula-prof">Prof. Fernanda</span>
                                    </div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-dia">Quarta-feira</div>
                                <div class="agenda-aulas">
                                    <div class="aula">
                                        <span class="aula-horario">17:00</span>
                                        <span class="aula-nome">Treino em Grupo</span>
                                        <span class="aula-prof">Prof. André</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Aulas Populares -->
                <div class="card comunicados-card">
                    <div class="card-header">
                        <h2>Aulas Populares</h2>
                    </div>
                    <div class="card-body">
                        <div class="comunicados-lista">
                            <div class="comunicado">
                                <div class="comunicado-data">10 vagas</div>
                                <div class="comunicado-conteudo">
                                    <h4>Yoga para Iniciantes</h4>
                                    <p>Terça e Quinta às 07:00 - Prof. Juliana</p>
                                </div>
                            </div>
                            <div class="comunicado">
                                <div class="comunicado-data">3 vagas</div>
                                <div class="comunicado-conteudo">
                                    <h4>Spinning Intenso</h4>
                                    <p>Segunda a Sexta às 18:00 - Prof. Carlos</p>
                                </div>
                            </div>
                            <div class="comunicado">
                                <div class="comunicado-data">7 vagas</div>
                                <div class="comunicado-conteudo">
                                    <h4>Crossfit</h4>
                                    <p>Segunda, Quarta e Sexta às 19:30 - Prof. Rodrigo</p>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Ver todas as aulas</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Script para garantir a funcionalidade do menu lateral -->
    <script>
        // Verificar se estamos em tela móvel e adicionar toggle para o menu
        document.addEventListener('DOMContentLoaded', function () {
            // Adicionar botão do menu em telas móveis se não existir
            if (window.innerWidth <= 768) {
                const topBar = document.querySelector('.top-bar');
                const sidebar = document.querySelector('.sidebar');

                // Criar botão de toggle se ainda não existir
                if (!document.querySelector('.menu-toggle')) {
                    const menuToggle = document.createElement('button');
                    menuToggle.className = 'menu-toggle';
                    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    topBar.insertBefore(menuToggle, topBar.firstChild);

                    // Adicionar evento de clique
                    menuToggle.addEventListener('click', function () {
                        sidebar.classList.toggle('active');
                    });
                }
            }
        });
    </script>
</body>

</html>