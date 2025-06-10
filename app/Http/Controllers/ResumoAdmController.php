<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Aula;
use App\Models\User;
use App\Models\Pagamento;
use App\Models\InscricaoAula;
use App\Models\SolicitacaoAula;
use Illuminate\Support\Facades\DB;

class ResumoAdmController extends Controller
{
    public function index()
    {
        // Cards
       $alunosAtivos = User::where('tipo', 'aluno')
                    ->where('status', 'ativo')
                    ->count();

$alunosInativos = User::where('tipo', 'aluno')
                      ->where('status', 'bloqueado')
                      ->count();
        $totalProfessores = User::where('tipo', 'administrador')->count();
        $totalAulas = Aula::count();

        // Alertas
        $pagamentosAtrasados = Pagamento::where('status', 'atrasado')->count();
        $pagamentosPendentes = Pagamento::where('status', 'pendente')->count();
        $novasMatriculas = SolicitacaoAula::where('status', 'pendente')->count();

       $totalAlvo = 100; // Número de pessoas de referência

$matriculasPorMes = InscricaoAula::select(
    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes_ano"),
    DB::raw("DATE_FORMAT(created_at, '%b %Y') as mes_label"),
    DB::raw('COUNT(*) as total')
)
->groupBy('mes_ano', 'mes_label')
->orderBy('mes_ano')
->get();

// Acumulado e porcentagem
$acumulado = 0;
$matriculasPorMes->transform(function ($item) use (&$acumulado, $totalAlvo) {
    $acumulado += $item->total;
    $item->porcentagem = min(round(($acumulado / $totalAlvo) * 100, 2), 100);
    return $item;
});
        // Gráfico: Distribuição por Aula
       $distribuicaoAula = Aula::withCount('inscricoes') // <- nome do método no model
    ->orderBy('inscricoes_count', 'desc')        // <- sufixo "_count" é automático
    ->limit(5)
    ->get()
    ->map(fn($aula) => ['label' => $aula->nome, 'value' => $aula->inscricoes_count]);

        // Gráfico: Receita Mensal (últimos 6 meses)
        $receitaMensal = Pagamento::select(
                DB::raw("DATE_FORMAT(data_pagamento, '%b %Y') as mes"),
                DB::raw('SUM(valor) as total')
            )
            ->where('status', 'pago')
            ->where('data_pagamento', '>=', now()->subMonths(6))
            ->groupBy('mes')
            ->orderByRaw("MIN(data_pagamento)")
            ->get();

        // Gráfico: Horários Mais Procurados
      $horariosPopulares = Aula::select('horario_inicio', DB::raw('COUNT(inscricao_aula.aula_id) as total'))
    ->join('inscricao_aula', 'aulas.id', '=', 'inscricao_aula.aula_id')
    ->groupBy('horario_inicio')
    ->orderByDesc('total')
    ->limit(5)
    ->get();
        return view('admviews.dashboard', [
            'alunosAtivos' => $alunosAtivos,
            'alunosInativos' => $alunosInativos,
            'totalProfessores' => $totalProfessores,
            'totalAulas' => $totalAulas,
            'pagamentosAtrasados' => $pagamentosAtrasados,
            'pagamentosPendentes' => $pagamentosPendentes,
            'novasMatriculas' => $novasMatriculas,
            'matriculasPorMes' => $matriculasPorMes,
            'distribuicaoAula' => $distribuicaoAula,
            'receitaMensal' => $receitaMensal,
            'horariosPopulares' => $horariosPopulares

            
        ]);
    }
}
