@extends('layouts.admheader')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')


@section('content')
    
    <!-- Modal de logout -->
    <div id="logoutModal" class="logout-overlay" style="display: none;">
        <div class="logout-box">
            <p>Tem certeza que deseja desconectar a conta e sair?</p>
            <div class="logout-buttons">
                <form id="logoutForm" action="#" method="POST">
                    <button type="submit" class="confirm">Sim, sair</button>
                </form>
                <button class="cancel" id="cancelLogout">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Content -->

        <!-- Date Filter -->
        <div class="date-filter">
            <label for="date-inicio">Data Início:</label>
            <input type="date" id="date-inicio" name="date-inicio">
            <label for="date-fim">Data Fim:</label>
            <input type="date" id="date-fim" name="date-fim">
            <button type="button" onclick="updateCharts()">Filtrar</button>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-content">
                    <div class="card-value" id="alunosAtivos">157</div>
                    <div class="card-title">Alunos Ativos</div>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="card-content">
                    <div class="card-value" id="alunosInativos">28</div>
                    <div class="card-title">Alunos Inativos</div>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="card-content">
                    <div class="card-value" id="totalProfessores">5</div>S
                    <div class="card-title">Total de Professores</div>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-content">
                    <div class="card-value" id="totalAulas">42</div>
                    <div class="card-title">Total de Aulas</div>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <div class="card-value" id="totalTurmas">12</div>
                    <div class="card-title">Total de Turmas</div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-chart-line"></i>
                    Evolução de Matrículas
                </div>
                <canvas id="matriculasChart"></canvas>
            </div>
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-chart-pie"></i>
                    Distribuição por Modalidade
                </div>
                <canvas id="modalidadeChart"></canvas>
            </div>
        </div>

        <div class="charts-section">
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-chart-bar"></i>
                    Receita Mensal
                </div>
                <canvas id="receitaChart"></canvas>
            </div>
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-clock"></i>
                    Horários Mais Procurados
                </div>
                <canvas id="horariosChart"></canvas>
            </div>
        </div>

        <!-- Notice Board -->
        <div class="notice-board">
            <div class="section-title">
                <i class="fas fa-bullhorn"></i>
                Quadro de Avisos
            </div>
            <div class="notice-item">
                <div class="notice-date">08/04/2025</div>
                <div class="notice-text">Manutenção programada no sistema para o dia 12/04/2025 das 23h às 6h. O sistema ficará indisponível durante este período.</div>
            </div>
            <div class="notice-item">
                <div class="notice-date">05/04/2025</div>
                <div class="notice-text">Nova turma de Yoga será aberta a partir do dia 15/04. Interessados devem procurar a recepção.</div>
            </div>
            <div class="notice-item">
                <div class="notice-date">01/04/2025</div>
                <div class="notice-text">Lembramos que o horário de funcionamento aos domingos será alterado para 8h às 14h a partir deste mês.</div>
            </div>
        </div>

        <!-- Quick Alerts -->
        <div class="alerts-container">
            <div class="section-title">
                <i class="fas fa-exclamation-triangle"></i>
                Alertas Rápidos
            </div>
            <div class="alert-item critical">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-text">12 alunos com pagamentos em atraso há mais de 10 dias</div>
            </div>
            <div class="alert-item">
                <div class="alert-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="alert-text">8 planos vencendo nos próximos 7 dias</div>
            </div>
            <div class="alert-item">
                <div class="alert-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="alert-text">3 novos alunos aguardando aprovação de matrícula</div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
         
        /* Content Area */
        .content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Date Filter */
        .date-filter {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .date-filter label {
            font-weight: 600;
            color: #555;
        }

        .date-filter input {
            padding: 8px 12px;
            border: 2px solid #e1e5e9;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .date-filter input:focus {
            border-color: #667eea;
        }

        .date-filter button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .date-filter button:hover {
            transform: translateY(-2px);
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .card:nth-child(1) .card-icon { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .card:nth-child(2) .card-icon { background: linear-gradient(135deg, #fa709a, #fee140); }
        .card:nth-child(3) .card-icon { background: linear-gradient(135deg, #a8edea, #fed6e3); }
        .card:nth-child(4) .card-icon { background: linear-gradient(135deg, #ffecd2, #fcb69f); }
        .card:nth-child(5) .card-icon { background: linear-gradient(135deg, #667eea, #764ba2); }

        .card-content {
            flex: 1;
        }

        .card-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .card-title {
            color: #666;
            font-size: 14px;
            font-weight: 600;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .chart-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title i {
            color: #667eea;
        }

        /* Notice Board */
        .notice-board {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #667eea;
        }

        .notice-item {
            padding: 15px;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
        }

        .notice-date {
            font-weight: 600;
            color: #667eea;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .notice-text {
            color: #555;
            line-height: 1.5;
        }

        /* Alerts */
        .alerts-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-left: 4px solid #ffc107;
        }

        .alert-item.critical {
            border-left-color: #dc3545;
            background: #fff5f5;
        }

        .alert-icon {
            color: #ffc107;
            font-size: 20px;
        }

        .alert-item.critical .alert-icon {
            color: #dc3545;
        }

        .alert-text {
            color: #555;
            font-weight: 500;
        }

        /* Modal Styles */
        .logout-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .logout-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .logout-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }

        .logout-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .confirm {
            background: #dc3545;
            color: white;
        }

        .cancel {
            background: #6c757d;
            color: white;
        }

        .overlay-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .alert-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        #okBtn {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .content {
                margin-left: 0;
            }
            
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .summary-cards {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
</style>
@endpush

@push('styles')
<script>
     // Dados dos gráficos
        let chartData = {
            matriculas: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                data: [25, 35, 28, 45, 38, 52]
            },
            modalidades: {
                labels: ['Musculação', 'Natação', 'Yoga', 'Pilates', 'Crossfit'],
                data: [45, 25, 15, 10, 15]
            },
            receita: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                data: [15000, 18000, 16500, 22000, 19500, 25000]
            },
            horarios: {
                labels: ['6h-8h', '8h-10h', '10h-12h', '14h-16h', '16h-18h', '18h-20h'],
                data: [20, 35, 25, 30, 45, 60]
            }
        };

        // Inicializar gráficos
        let charts = {};

        function initCharts() {
            // Gráfico de Matrículas
            const matriculasCtx = document.getElementById('matriculasChart').getContext('2d');
            charts.matriculas = new Chart(matriculasCtx, {
                type: 'line',
                data: {
                    labels: chartData.matriculas.labels,
                    datasets: [{
                        label: 'Novas Matrículas',
                        data: chartData.matriculas.data,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Gráfico de Modalidades
            const modalidadeCtx = document.getElementById('modalidadeChart').getContext('2d');
            charts.modalidades = new Chart(modalidadeCtx, {
                type: 'doughnut',
                data: {
                    labels: chartData.modalidades.labels,
                    datasets: [{
                        data: chartData.modalidades.data,
                        backgroundColor: [
                            '#667eea',
                            '#764ba2',
                            '#4facfe',
                            '#fa709a',
                            '#ffecd2'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // Gráfico de Receita
            const receitaCtx = document.getElementById('receitaChart').getContext('2d');
            charts.receita = new Chart(receitaCtx, {
                type: 'bar',
                data: {
                    labels: chartData.receita.labels,
                    datasets: [{
                        label: 'Receita (R$)',
                        data: chartData.receita.data,
                        backgroundColor: 'rgba(102, 126, 234, 0.8)',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'R$ ' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Gráfico de Horários
            const horariosCtx = document.getElementById('horariosChart').getContext('2d');
            charts.horarios = new Chart(horariosCtx, {
                type: 'radar',
                data: {
                    labels: chartData.horarios.labels,
                    datasets: [{
                        label: 'Alunos por Horário',
                        data: chartData.horarios.data,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: '#667eea'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        }
                    }
                }
            });
        }

        function updateCharts() {
            // Simular atualização dos dados baseado no filtro de data
            const startDate = document.getElementById('date-inicio').value;
            const endDate = document.getElementById('date-fim').value;
            
            if (startDate && endDate) {
                // Gerar dados aleatórios para demonstrar a funcionalidade
                chartData.matriculas.data = chartData.matriculas.data.map(() => 
                    Math.floor(Math.random() * 50) + 20
                );
                chartData.receita.data = chartData.receita.data.map(() => 
                    Math.floor(Math.random() * 20000) + 10000
                );
                chartData.horarios.data = chartData.horarios.data.map(() => 
                    Math.floor(Math.random() * 50) + 10
                );
                
                // Atualizar os gráficos
                charts.matriculas.data.datasets[0].data = chartData.matriculas.data;
                charts.receita.data.datasets[0].data = chartData.receita.data;
                charts.horarios.data.datasets[0].data = chartData.horarios.data;
                
                charts.matriculas.update();
                charts.receita.update();
                charts.horarios.update();
                
                // Atualizar cards
                document.getElementById('alunosAtivos').textContent = Math.floor(Math.random() * 100) + 100;
                document.getElementById('alunosInativos').textContent = Math.floor(Math.random() * 50) + 10;
                document.getElementById('totalAulas').textContent = Math.floor(Math.random() * 20) + 30;
                
                // Mostrar mensagem de sucesso
                alert('Dados atualizados com sucesso!');
            } else {
                alert('Por favor, selecione as datas de início e fim.');
            }
        }

        // Scripts relacionados à sidebar e modais
        document.addEventListener("DOMContentLoaded", function () {
            // Inicializar gráficos
            initCharts();
            
            // Configurar datas padrão (último mês)
            const today = new Date();
            const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
            
            document.getElementById('date-inicio').value = lastMonth.toISOString().split('T')[0];
            document.getElementById('date-fim').value = today.toISOString().split('T')[0];
            
            // Modal de logout
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

            // Animação dos cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
</script>
@endpush
