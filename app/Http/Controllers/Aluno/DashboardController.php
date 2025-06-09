<?php
namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comunicado;
use App\Models\Aula;
use App\Models\Pagamento;
use App\Models\SolicitacaoAula;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $aluno = Auth::user()->aluno;

        // Últimos 3 comunicados
        $comunicados = Comunicado::latest()->take(3)->get();

        // Pagamentos (mês atual e anterior)
        $agora = Carbon::now();
        $mesAtual = $agora->month;
        $anoAtual = $agora->year;

        $mesAnterior = $agora->copy()->subMonth()->month;
        $anoAnterior = $agora->copy()->subMonth()->year;

    $pagamentoAtual = Pagamento::where('user_id', $aluno->user->id)
    ->whereMonth('data_referencia', $mesAtual)
    ->whereYear('data_referencia', $anoAtual)
    ->first();

    $pagamentoAnterior = Pagamento::where('user_id', $aluno->user->id)
    ->whereMonth('data_referencia', $mesAnterior)
    ->whereYear('data_referencia', $anoAnterior)
    ->first();

        // Aulas inscritas na semana
        $aulas = Aula::whereHas('alunos', function ($query) use ($aluno) {
                $query->where('user_id', $aluno->user->id);
            })
            ->whereIn('dia_semana', ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado']) // exemplo
            ->orderBy('dia_semana')
            ->take(7)
            ->get();

        // Solicitações de matrícula
        $solicitacoes = [
            'pendentes' => SolicitacaoAula::where('aluno_id', $aluno->id)->where('status', 'pendente')->count(),
            'aceitas' => SolicitacaoAula::where('aluno_id', $aluno->id)->where('status', 'aceita')->count(),
            'recusadas' => SolicitacaoAula::where('aluno_id', $aluno->id)->where('status', 'rejeitada')->count(),
        ];

        return view('alunoviews.dashboardaluno', compact(
            'comunicados',
            'aulas',
            'pagamentoAtual',
            'pagamentoAnterior',
            'solicitacoes'
        ));
    }
}
