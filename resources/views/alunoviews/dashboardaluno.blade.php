@extends('layouts.alunoheader')

@section('title', 'Painel de Controle')
@section('page-title', 'Painel de Controle')
            
   @section('content')        
                <div class="card plano-card">
                    <div class="card-header">
                        <h2>Meu Plano</h2>
                    </div>
                    @if($plano)
                    <div class="card-body">
                        <div class="plano-info">
                            <div class="plano-tipo"> 
                                <h3>{{$plano->nome}}</h3><span class="status ativo">{{$plano->status}}</span>
                            </div>
                            <div class="plano-detalhes">
                                <div class="info-item"><strong class="label">Valor Total:</strong><span class="value">
                                    R$ {{ number_format($plano->valor_total, 2, ',', '.') }}</span></div>
                            </div>
                        </div>
                    </div>
                    @else
                        <h3>Você não possui nenhum plano</h3>
                    @endif

                </div><!-- Card Agenda -->
                <div class="card agenda-card">
                    <div class="card-header">
                        <h2>Aulas</h2>
                    </div>
                    <div class="card-body">
                        <div class="agenda-dias">
                            @forelse($aulas as $aula)
                            <div class="agenda-item">
                                <div class="agenda-dia">{{$aula->dia_semana}}</div>
                                <div class="agenda-aulas">
                                    <div class="aula"><span class="aula-horario">{{$aula->horario_inicio}}</span><span
                                            class="aula-nome">{{$aula->nome}}</span><span class="aula-prof">
                                                {{$aula->instrutor}}</span></div>
                                </div>
                            </div>
                            @empty
                            <p>Nenhuma aula disponível</p>
                            @endforelse    
                        </div>
                        <a href="{{ route('aulas.aluno') }}" class="btn btn-primary">Ver todas as aulas</a>
                    </div>
                </div>
                </div><!-- Card Comunicados -->
                <div class="card comunicados-card">
                    <div class="card-header">
                        <h2>Comunicados</h2>
                    </div>
                    <div class="card-body">
                        <div class="comunicados-lista">
                             @forelse($comunicados as $comunicado)
                                <div class="comunicado">
                                    <strong>{{ $comunicado->titulo }}</strong><br>
                                    <div class="comunicado-data">{{ $comunicado->data->format('d/m/Y')}}</div>
                                    <p class="comunicado-conteudo">{{ Str::limit($comunicado->descricao, 100) }}</p>
                                </div>
                                @empty
                                <p>Nenhum comunicado recente.</p>
                                @endforelse
                        </div><a href="{{ route('comunicados.aluno') }}" class="btn btn-primary">Ver todos os comunicados</a>
                    </div>
                @endsection
            
       
