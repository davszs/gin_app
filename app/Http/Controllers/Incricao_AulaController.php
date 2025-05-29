<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoAula;
use App\Models\Aluno;
use App\Models\Aula;
use Illuminate\Support\Facades\Auth;

class Incricao_AulaController extends Controller
{
    // Inscrever o aluno logado em uma aula
    public function inscrever($aula_id)
    {
        $aluno_id = Auth::id();

        $inscricao = InscricaoAula::where('aluno_id', $aluno_id)
                                 ->where('aula_id', $aula_id)
                                 ->first();

        if ($inscricao && $inscricao->status === 'ativo') {
            return response()->json(['message' => 'Você já está inscrito nesta aula.'], 400);
        }

        if ($inscricao && $inscricao->status === 'cancelado') {
            $inscricao->status = 'ativo';
            $inscricao->data_inscricao = now();
            $inscricao->save();

            return response()->json(['message' => 'Inscrição reativada com sucesso!']);
        }

        InscricaoAula::create([
            'aluno_id' => $aluno_id,
            'aula_id' => $aula_id,
            'status' => 'ativo'
        ]);

        return response()->json(['message' => 'Inscrição realizada com sucesso!']);
    }

    // Cancelar inscrição do aluno em uma aula
    public function cancelarInscricao($aula_id)
    {
        $aluno_id = Auth::id();

        $inscricao = InscricaoAula::where('aluno_id', $aluno_id)
                                 ->where('aula_id', $aula_id)
                                 ->where('status', 'ativo')
                                 ->first();

        if (!$inscricao) {
            return response()->json(['message' => 'Inscrição ativa não encontrada para cancelar.'], 404);
        }

        $inscricao->status = 'cancelado';
        $inscricao->save();

        return response()->json(['message' => 'Inscrição cancelada com sucesso!']);
    }
}

