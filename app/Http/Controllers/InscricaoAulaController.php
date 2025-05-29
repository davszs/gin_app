<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoAula;
use App\Models\Aluno;
use App\Models\Aula;
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

    return view('alunoviews.aulas', [
        'aulas' => $aulas,
        'aulasDisponiveis' => $aulasDisponiveis
    ]);
    }

    public function inscrever(Request $request, Aula $aula)
    {
        $userId = Auth::id();
        $aluno = Aluno::where('user_id', $userId)->first();

        if (!$aluno) {
            return response()->json(['erro' => 'Aluno não encontrado.'], 404);
        }

        $inscricaoExistente = InscricaoAula::where('aluno_id', $aluno->id)
            ->where('aula_id', $aula->id)
            ->where('status', 'ativo')
            ->first();

        if ($inscricaoExistente) {
            return response()->json(['erro' => 'Você já está inscrito nesta aula.'], 400);
        }

        $inscricao = InscricaoAula::updateOrCreate(
            ['aluno_id' => $aluno->id, 'aula_id' => $aula->id],
            ['status' => 'ativo', 'data_inscricao' => now()]
        );

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    public function cancelarInscricao(Aula $aula)
    {  $userId = Auth::id();
    $aluno = Aluno::where('user_id', $userId)->first();

    if (!$aluno) {
        return redirect()->back()->with('erro', 'Aluno não encontrado.');
    }

    // Cancela inscrição
    $aluno->aulas()->detach($aula->id);

    return redirect()->back()->with('sucesso', 'Inscrição cancelada com sucesso.');
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
