@extends('layouts.alunoheader')

@section('title', 'Painel de Controle')
@section('page-title', 'Painel de Controle')
            
   @section('content')        
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
                @endsection
            
       
