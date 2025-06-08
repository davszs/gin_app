<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoAula;
use App\Models\InscricaoAula;
use App\Models\Aula;
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

    return view('admviews.solicitacoes', compact('solicitacoesPendentes', 'solicitacoesProcessadas'));
    }

    public function aprovar($id)
{
    $solicitacao = SolicitacaoAula::findOrFail($id);

    DB::transaction(function () use ($solicitacao) {
        $solicitacao->status = 'aceita';
        $solicitacao->save();

        $aula = Aula::findOrFail($solicitacao->aula_id);
        $valorAula = $aula->valor;

        if ($solicitacao->tipo === 'inscricao') {
            // 1. Criar a inscrição
            $inscricao = InscricaoAula::create([
                'aluno_id' => $solicitacao->aluno_id,
                'aula_id' => $solicitacao->aula_id,
                'status' => 'ativo',
                'data_inscricao' => now(),
                'valor' => $valorAula,
            ]);

            // 2. Buscar o plano do aluno
            $plano = \App\Models\Plano::where('aluno_id', $solicitacao->aluno_id)->first();

            if ($plano) {
                // 3. Vincular a inscrição ao plano
                $plano->inscricoes()->attach($inscricao->id);

                // 4. Atualizar o valor total do plano
                $plano->valor_total += $valorAula;
                $plano->save();
            }
        } elseif ($solicitacao->tipo === 'cancelamento') {
            // Remover a inscrição da tabela pivot e da inscrição
            $inscricao = InscricaoAula::where('aluno_id', $solicitacao->aluno_id)
                ->where('aula_id', $solicitacao->aula_id)
                ->first();

            if ($inscricao) {
                // Remover da relação com plano, se houver
                DB::table('plano_inscricao_aula')
                    ->where('inscricao_aula_id', $inscricao->id)
                    ->delete();

                // Opcional: também subtrair valor do plano
                $plano = \App\Models\Plano::where('aluno_id', $solicitacao->aluno_id)->first();
                if ($plano) {
                    $plano->valor_total -= $inscricao->valor;
                    $plano->save();
                }

                // Excluir a inscrição
                $inscricao->delete();
            }
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
