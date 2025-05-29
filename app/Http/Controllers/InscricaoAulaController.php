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

        $aulas = $aluno->aulas;

        return view('alunoviews.aulas', compact('aulas'));
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
    {
        $userId = Auth::id();
        $aluno = Aluno::where('user_id', $userId)->first();

        if (!$aluno) {
            return response()->json(['erro' => 'Aluno não encontrado.'], 404);
        }

        $inscricao = InscricaoAula::where('aluno_id', $aluno->id)
            ->where('aula_id', $aula->id)
            ->where('status', 'ativo')
            ->first();

        if (!$inscricao) {
            return response()->json(['erro' => 'Inscrição ativa não encontrada.'], 404);
        }

        $inscricao->status = 'cancelado';
        $inscricao->save();

       return redirect()->back()->with('success', 'Inscrição cancelada com sucesso.');
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

    
    public function aulasDisponiveis(Request $request)
    {
        $userId = Auth::id();
        $aluno = Aluno::where('user_id', $userId)->first();

        if (!$aluno) {
            return response()->json(['erro' => 'Aluno não encontrado.'], 404);
        }

        $modalidade = $request->get('modalidade');
        $dia = $request->get('dia');

        
        $idsAulasInscritasAtivas = InscricaoAula::where('aluno_id', $aluno->id)
            ->where('status', 'ativo')
            ->pluck('aula_id')
            ->toArray();

        $query = Aula::query();

        if ($modalidade) {
            $query->where('modalidade', $modalidade);
        }

        if ($dia) {
            $query->where('dias_semana', 'like', "%{$dia}%");
        }

        // Somente aulas que NÃO estão entre as inscrições ativas
        $query->whereNotIn('id', $idsAulasInscritasAtivas);

        $aulasDisponiveis = $query->get();

        return view('aulas.disponiveis', compact('aulasDisponiveis', 'modalidade', 'dia'));
    }
    
}
