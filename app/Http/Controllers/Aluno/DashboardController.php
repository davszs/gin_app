<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Plano;
use Illuminate\Http\Request;
use App\Models\Comunicado;
use App\Models\Aula;

class DashboardController extends Controller
{
    public function index()
    {
        // Busca os últimos 3 comunicados
        $comunicados = Comunicado::latest()->take(3)->get();

        //Plano
        $alunoId = auth()->id();
        $plano = Plano::where('aluno_id', $alunoId)->first();

        //Aulas
        $aulas = Aula::latest()->take(3)->get();

        return view('alunoviews.dashboardaluno', compact('comunicados', 'plano', 'aulas'));

    }
}
