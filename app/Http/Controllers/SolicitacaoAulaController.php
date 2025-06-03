<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoAula;
use App\Models\InscricaoAula;
use Illuminate\Support\Facades\DB;

class SolicitacaoAulaController extends Controller
{
    public function index()
    {
         // Solicitações pendentes
    $solicitacoesPendentes = SolicitacaoAula::where('status', 'pendente')
        ->with(['aluno.user', 'aula'])
        ->get();

    // Solicitações aceitas ou rejeitadas
    $solicitacoesProcessadas = SolicitacaoAula::whereIn('status', ['aceita', 'rejeitada'])
        ->with(['aluno.user', 'aula'])
        ->get();

    return view('solicitacoes', compact('solicitacoesPendentes', 'solicitacoesProcessadas'));
    }

    public function aprovar($id)
    {
        $solicitacao = SolicitacaoAula::findOrFail($id);

        DB::transaction(function () use ($solicitacao) {
            $solicitacao->status = 'aprovada';
            $solicitacao->save();

            if ($solicitacao->tipo === 'inscricao') {
                InscricaoAula::create([
                    'aluno_id' => $solicitacao->aluno_id,
                    'aula_id' => $solicitacao->aula_id,
                    'status' => 'ativo',
                    'data_inscricao' => now(),
                ]);
            } elseif ($solicitacao->tipo === 'cancelamento') {
                DB::table('inscricao_aula')
                    ->where('aluno_id', $solicitacao->aluno_id)
                    ->where('aula_id', $solicitacao->aula_id)
                    ->delete();
            }
        });

        return redirect()->back()->with('sucesso', 'Solicitação aprovada com sucesso.');
    }

    public function rejeitar($id)
    {
        $solicitacao = SolicitacaoAula::findOrFail($id);
        $solicitacao->status = 'rejeitada';
        $solicitacao->save();

        return redirect()->back()->with('info', 'Solicitação rejeitada com sucesso.');
    }
}
