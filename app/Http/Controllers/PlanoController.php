<?php

namespace App\Http\Controllers;
use App\Models\Plano;
use App\Models\Aula;
use Illuminate\Http\Request;
use App\Models\InscricaoAula;

class PlanoController extends Controller
{
    // Listar todos os planos com suas aulas e valores
    public function index()
    {
        $planos = Plano::with(['aluno.user', 'inscricoes.aula'])->get();
           $aulas = Aula::all();

        foreach ($planos as $plano) {
            $valorAulas = $plano->inscricoes->sum(fn($insc) => $insc->aula->valor ?? 0);
            $valorFixo = $plano->valor_fixo ?? 0;
            $plano->valor_total = $valorFixo + $valorAulas;
        }

        return view('admviews.planos', compact('planos', 'aulas'));
    }

    // Remover uma inscrição de aula do plano
    public function removerInscricao($planoId, $inscricaoId)
    {
        $plano = Plano::findOrFail($planoId);
        $plano->inscricoes()->detach($inscricaoId);

        // Recalcular valor_total
        $valorAulas = $plano->inscricoes()->with('aula')->get()->sum(fn($i) => $i->aula->valor ?? 0);
        $plano->valor_total = ($plano->valor_fixo ?? 0) + $valorAulas;
        $plano->save();

        return redirect()->back()->with('sucesso', 'Inscrição removida com sucesso.');
    }

    // Exibir formulário para adicionar inscrição a uma aula
    public function mostrarFormularioAdicionarInscricao($planoId)
    {
        $plano = Plano::with(['inscricoes'])->findOrFail($planoId);

    // Obter IDs das aulas que já estão associadas a este plano
    $aulasInscritasIds = $plano->inscricoes->pluck('aula_id')->toArray();

    // Buscar aulas que ainda NÃO estão nesse plano
    $aulas = Aula::whereNotIn('id', $aulasInscritasIds)->get();

    return view('admviews.adicionar-inscricao', compact('plano', 'aulas'));
    }

    // Adicionar uma nova inscrição de aula ao plano
    public function adicionarInscricao(Request $request, $planoId)
    {
        $request->validate([
            'aula_id' => 'required|exists:aulas,id',
        ]);
         
        $plano = Plano::findOrFail($planoId);
        $aulaId = $request->aula_id;
        $plano = Plano::with('inscricoes')->findOrFail($planoId);

    // Verifica duplicidade
    if ($plano->inscricoes->contains('aula_id', $request->aula_id)) {
        return redirect()->back()->with('erro', 'Esta aula já está inscrita neste plano.');
    }
        
        // Criar inscrição do aluno na aula (modelo genérico)
        $inscricao = InscricaoAula::create([
            'aluno_id' => $plano->aluno_id,
            'aula_id' => $aulaId,
            'valor' => Aula::find($aulaId)->valor,
            'status' => 'ativo'
        ]);

        // Associar ao plano
        $plano->inscricoes()->attach($inscricao->id);

        // Atualizar valor total
        $valorAulas = $plano->inscricoes()->with('aula')->get()->sum(fn($i) => $i->aula->valor ?? 0);
        $plano->valor_total = ($plano->valor_fixo ?? 0) + $valorAulas;
        $plano->save();

        return redirect()->route('planos.index')->with('sucesso', 'Inscrição adicionada com sucesso.');
    }
    public function cancelarPlano($id)
{
    // Buscar o plano com o relacionamento aluno → user
    $plano = Plano::with('aluno.user')->findOrFail($id);

    // Atualizar o status do plano para 'cancelado'
    $plano->status = 'cancelado';
    $plano->save();

    // Verifica se o plano tem um aluno vinculado e se o aluno tem um usuário
    if ($plano->aluno && $plano->aluno->user) {
        $plano->aluno->user->status = 'bloqueado';
        $plano->aluno->user->save();
    }

    return redirect()->back()->with('sucesso', 'Plano cancelado e usuário bloqueado com sucesso.');
}
    public function ativarPlano($id)
{
    // Buscar o plano com o relacionamento aluno → user
    $plano = Plano::with('aluno.user')->findOrFail($id);

    // Atualizar o status do plano para 'cancelado'
    $plano->status = 'ativo';
    $plano->save();

    // Verifica se o plano tem um aluno vinculado e se o aluno tem um usuário
    if ($plano->aluno && $plano->aluno->user) {
        $plano->aluno->user->status = 'ativo';
        $plano->aluno->user->save();
    }

    return redirect()->back()->with('sucesso', 'Plano ativado e usuário desbloqueado com sucesso.');
}
}