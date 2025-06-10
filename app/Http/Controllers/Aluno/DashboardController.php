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

// Aulas inscritas na semana via inscrições

$inscricoes = $aluno->inscricoes()->with('aula')->get();

$aulas = $inscricoes
    ->filter(function ($aula) {
        $diasValidos = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

        $dia = strtolower($aula->dia_semana);
        $dia = str_replace(['á','à','â','ã','ä'], 'a', $dia);
        $dia = str_replace(['é','è','ê','ë'], 'e', $dia);

        return in_array($dia, $diasValidos);
    })
    ->sortBy(function ($aula) {
        $ordem = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

        $dia = strtolower($aula->dia_semana);
        $dia = str_replace(['á','à','â','ã','ä'], 'a', $dia);
        $dia = str_replace(['é','è','ê','ë'], 'e', $dia);

        return array_search($dia, $ordem);
    })
    ->values(); // reindexa os resultados




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
