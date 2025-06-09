<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Aluno;
use App\Models\Pagamento;
use App\Models\Plano;

class PagamentoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $aluno = Aluno::where('user_id', $user->id)->first();

        if (!$aluno) {
            return redirect()->back()->with('status', 'Aluno não encontrado.');
        }

        $pagamentos = Pagamento::whereHas('plano', function($query) use ($aluno) {
            $query->where('aluno_id', $aluno->id);
        })
        ->orderBy('data_referencia', 'desc')
        ->get();

        $pagas = $pagamentos->where('status', 'pago')->count();
        $pendentes = $pagamentos->where('status', 'pendente')->count();
        $vencidas = $pagamentos->where('status', 'vencido')->count();

        return view('alunoviews.financeiroaluno', [
            'pagamentos' => $pagamentos,
            'resumo' => [
                'pagas' => $pagas,
                'pendentes' => $pendentes,
                'vencidas' => $vencidas,
            ],
            'aluno' => $aluno,
        ]);
    }

    public function gerarBoleto($pagamentoId)
    {
       $user = Auth::user();

    // Busca o aluno vinculado ao usuário autenticado
    $aluno = Aluno::where('user_id', $user->id)->first();

    if (!$aluno) {
        return redirect()->back()->with('status', 'Aluno não encontrado.');
    }

    // Busca o pagamento pelo ID e verifica se pertence ao aluno
    $pagamento = Pagamento::where('id', $pagamentoId)
        ->whereHas('plano', function($query) use ($aluno) {
            $query->where('aluno_id', $aluno->id);
        })
        ->first();

    if (!$pagamento) {
        return redirect()->back()->with('status', 'Pagamento não encontrado ou não autorizado.');
    }

    // Retorna a view do boleto com os dados do pagamento
    return view('pagamento.boleto', [
        'pagamento' => $pagamento,
        'aluno' => $aluno,
    ]);

    }
    public function gerarPagamentosAutomaticos()
{
    $hoje = Carbon::now();

    // Alunos com planos ativos
    $planos = Plano::where('ativo', true)->get();

    foreach ($planos as $plano) {
        $alunoId = $plano->aluno_id;
        $referencia = $hoje->copy()->startOfMonth();

        // Verifica se já existe um pagamento para este mês
        $jaExiste = Pagamento::where('plano_id', $plano->id)
            ->whereMonth('data_referencia', $referencia->month)
            ->whereYear('data_referencia', $referencia->year)
            ->exists();

        if (!$jaExiste) {
            Pagamento::create([
    'plano_id' => $plano->id,
    'aluno_id' => $plano->aluno_id, // aqui!
    'data_referencia' => now(),
    'vencimento' => now()->addDays(7),
    'valor' => $plano->valor_total,
    'status' => 'pendente',
]);
        }
    }
  }
}
