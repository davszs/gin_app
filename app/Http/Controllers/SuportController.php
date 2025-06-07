<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuportController extends Controller
{
    //Funcionalidades da Pagina de suporte
    public function index()
    {
        return view('alunoviews.suporte');
    }

      public function enviar(Request $request)
    {
        return redirect()->back()->with('success', 'Chamado enviado com sucesso!');
    }
}
