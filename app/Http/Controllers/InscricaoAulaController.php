<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoAula;
use App\Models\Aluno;
use App\Models\Aula;
use App\Models\SolicitacaoAula;
use Illuminate\Support\Facades\Auth;

class InscricaoAulaController extends Controller
{
    public function minhasAulas()
    {
    $userId = Auth::id();
    $aluno = Aluno::where('user_id', $userId)->first();

    if (!$aluno) {
        return response()->json(['erro' => 'Aluno não encontrado.'], 404);
    }

    // Aulas em que está inscrito
    $aulas = $aluno->aulas;

    // Aulas que ele ainda NÃO está inscrito
   $aulasDisponiveis = Aula::whereDoesntHave('inscricoes', function ($query) use ($aluno) {
    $query->where('aluno_id', $aluno->id);
})->get();

$solicitacoesPendentes = SolicitacaoAula::where('aluno_id', $aluno->id)
    ->where('status', 'pendente')
    ->with('aula') // para acessar dados da aula
    ->get();

return view('alunoviews.aulas', [
    'aulas' => $aulas,
    'aulasDisponiveis' => $aulasDisponiveis,
    'solicitacoesPendentes' => $solicitacoesPendentes,
]);
    
    }

    public function inscrever(Request $request, Aula $aula)
    {
       $userId = Auth::id();
    $aluno = Aluno::where('user_id', $userId)->first();

    if (!$aluno) {
        return redirect()->back()->with('erro', 'Aluno não encontrado.');
    }

    $existe = SolicitacaoAula::where('aluno_id', $aluno->id)
        ->where('aula_id', $aula->id)
        ->where('tipo', 'inscricao')
        ->where('status', 'pendente')
        ->exists();

    if ($existe) {
        return redirect()->back()->with('info', 'Você já fez uma solicitação de inscrição pendente.');
    }

    SolicitacaoAula::create([
        'aluno_id' => $aluno->id,
        'aula_id' => $aula->id,
        'tipo' => 'inscricao',
    ]);

    return redirect()->back()->with('sucesso', 'Solicitação de inscrição enviada para aprovação.');
    }

    public function cancelarInscricao(Aula $aula)
    { $userId = Auth::id();
    $aluno = Aluno::where('user_id', $userId)->first();

    if (!$aluno) {
        return redirect()->back()->with('erro', 'Aluno não encontrado.');
    }

    // Verifica se o aluno está realmente inscrito nessa aula
    $inscrito = $aluno->aulas()->where('aula_id', $aula->id)->exists();

    if (!$inscrito) {
        return redirect()->back()->with('erro', 'Você não está inscrito nessa aula.');
    }

    // Evita duplicação de solicitação pendente
    $existe = SolicitacaoAula::where('aluno_id', $aluno->id)
        ->where('aula_id', $aula->id)
        ->where('tipo', 'cancelamento')
        ->where('status', 'pendente')
        ->exists();

    if ($existe) {
        return redirect()->back()->with('info', 'Você já fez uma solicitação de cancelamento pendente.');
    }

    // Cria a solicitação
    SolicitacaoAula::create([
        'aluno_id' => $aluno->id,
        'aula_id' => $aula->id,
        'tipo' => 'cancelamento',
    ]);

    return redirect()->back()->with('sucesso', 'Solicitação de cancelamento enviada para aprovação.');

    }

    public function filtro(Request $request)
    {
        $modalidade = $request->get('modalidade');
        $dia = $request->get('dia');

        $query = Aula::query();

        if ($modalidade) {
            $query->where('modalidade', $modalidade);
        }

        if ($dia) {
            $query->where('dias_semana', 'like', "%{$dia}%");
        }

        $aulas = $query->get();

        return view('aulas.index', compact('aulas', 'modalidade', 'dia'));
    }

    
   
    
}
