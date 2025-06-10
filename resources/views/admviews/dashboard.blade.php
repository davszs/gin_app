@extends('layouts.admheader')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')


@section('content')
    



  <div id="dashboard">

  <!-- Resumo de Operações -->
  <section class="summary-section">
    <h4 class="summary-title">
      <i class="fas fa-chart-bar"></i> Resumo de Operações
    </h4>

    <div class="summary-cards">
      <div class="card">
        <div class="card-icon"><i class="fas fa-user-check"></i></div>
        <div class="card-content">
          <div class="card-value">{{ $alunosAtivos }}</div>
          <div class="card-title">Alunos Ativos</div>
        </div>
      </div>
      <div class="card">
        <div class="card-icon"><i class="fas fa-user-times"></i></div>
        <div class="card-content">
          <div class="card-value">{{ $alunosInativos }}</div>
          <div class="card-title">Alunos Bloqueados</div>
        </div>
      </div>
      <div class="card">
        <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="card-content">
          <div class="card-value">{{ $totalProfessores }}</div>
          <div class="card-title">Administradores cadastrados</div>
        </div>
      </div>
      <div class="card">
        <div class="card-icon"><i class="fas fa-book"></i></div>
        <div class="card-content">
          <div class="card-value">{{ $totalAulas }}</div>
          <div class="card-title">Total de Aulas</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gráficos -->
  <h4 class="summary-title">
      <i class="fas fa-chart-bar"></i> Gráficos de Atividades
    </h4>
  <section class="charts-section">
    <div class="chart-container">
      <h5 class="chart-title"><i class="fas fa-chart-line"></i> Evolução de Matrículas</h5>
      <canvas id="matriculasChart"></canvas>
    </div>
    <div class="chart-container">
      <h5 class="chart-title"><i class="fas fa-chart-pie"></i> Distribuição por Aula</h5>
      <canvas id="modalidadeChart"></canvas>
    </div>
    <div class="chart-container">
      <h5 class="chart-title"><i class="fas fa-chart-bar"></i> Receita Mensal</h5>
      <canvas id="receitaChart"></canvas>
    </div>
    <div class="chart-container">
      <h5 class="chart-title"><i class="fas fa-clock"></i> Horários Mais Procurados</h5>
      <canvas id="horariosChart"></canvas>
    </div>
  </section>

  <!-- Avisos -->
  <section class="alerts-section">
    <h4 class="summary-title"><i class="fas fa-exclamation-triangle"></i> Alertas Rápidos</h4>

    <div class="alert-item critical">
      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
      <div class="alert-text">{{ $pagamentosAtrasados }} alunos com pagamentos em atraso</div>
    </div>

    <div class="alert-item">
      <div class="alert-icon"><i class="fas fa-clock"></i></div>
      <div class="alert-text">{{ $pagamentosPendentes }} pagamentos pendentes</div>
    </div>

    <div class="alert-item">
      <div class="alert-icon"><i class="fas fa-user-plus"></i></div>
      <div class="alert-text">{{ $novasMatriculas }} novos alunos aguardando aprovação</div>
    </div>
  </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@push('styles')
<style>
         
        /* Content Area */
        .content {
            
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
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}

.chart-container {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.chart-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    justify-content: flex-start;
}

.chart-title i {
    color: #667eea;
}

/* Ajuste para o canvas dos gráficos para ocupar a largura total */
.chart-container canvas {
    width: 100% !important;
    max-height: 300px;
}

/* Responsividade */
@media (max-width: 768px) {
    .charts-section {
        grid-template-columns: 1fr;
    }
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
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* fixa 4 colunas */
    gap: 20px;
    margin-bottom: 30px;
}

        }
        .summary-title {
    font-size: 20px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    border-left: 5px solid #667eea;
    padding-left: 12px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    letter-spacing: 0.02em;
    display: flex;
    align-items: center;
    gap: 10px; /* espaço entre ícone e texto */
}

.summary-title i {
    color: #667eea;
    font-size: 24px;
}
</style>
@endpush

@push('scripts')
<script>
    // Matrículas por mês
    const matriculasChart = new Chart(document.getElementById('matriculasChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($matriculasPorMes->pluck('mes')) !!},
            datasets: [{
                label: 'Matrículas',
                data: {!! json_encode($matriculasPorMes->pluck('total')) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Distribuição por Aula
    const modalidadeChart = new Chart(document.getElementById('modalidadeChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($distribuicaoAula->pluck('label')) !!},
            datasets: [{
                data: {!! json_encode($distribuicaoAula->pluck('value')) !!},
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

    // Receita Mensal
    const receitaChart = new Chart(document.getElementById('receitaChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($receitaMensal->pluck('mes')) !!},
            datasets: [{
                label: 'Receita (R$)',
                data: {!! json_encode($receitaMensal->pluck('total')) !!},
                backgroundColor: '#4CAF50'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Horários Mais Procurados
    const horariosChart = new Chart(document.getElementById('horariosChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($horariosPopulares->pluck('horario')) !!},
            datasets: [{
                label: 'Inscrições',
                data: {!! json_encode($horariosPopulares->pluck('total')) !!},
                backgroundColor: '#FF9800'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
