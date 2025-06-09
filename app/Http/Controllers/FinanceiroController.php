<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Aluno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
 public function index(Request $request)
    {
        $query = Pagamento::with(['plano.aluno.user']);

        // Filtra por aluno, se fornecido
        if ($request->filled('aluno')) {
            $query->whereHas('plano', function ($q) use ($request) {
                $q->where('user_id', $request->aluno);
            });
        }

        // Filtra por mês de referência
        if ($request->filled('mes')) {
            try {
                $mesSelecionado = Carbon::parse($request->mes);
                $query->whereMonth('data_referencia', $mesSelecionado->month)
                      ->whereYear('data_referencia', $mesSelecionado->year);
            } catch (\Exception $e) {
                // opcional: log de erro
            }
        }

        $pagamentos = $query->orderBy('vencimento', 'desc')->get();

        $alunos = Aluno::with('user')->get()->sortBy(fn($a) => $a->user->nome);

        return view('admviews.financeiro', compact('pagamentos', 'alunos'));
    }

    public function atualizar(Request $request)
    {
        $request->validate([
            'pagamento_id' => 'required|exists:pagamentos,id',
            'data_pagamento' => 'required|date',
        ]);

        $pagamento = Pagamento::findOrFail($request->pagamento_id);
        $pagamento->marcarComoPago(Carbon::parse($request->data_pagamento));

        return redirect()->route('financeiro')->with('success', 'Pagamento atualizado com sucesso!');
    }

 
}
