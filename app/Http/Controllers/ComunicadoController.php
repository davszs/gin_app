<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comunicados = Comunicado::get();
        return view('comunicados.index', compact('comunicados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comunicados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required | string | max:255',
            'descricao' => 'required | string',
            'data' => 'required | date',
        ]);

        Comunicado::create($dados);
        return redirect()->route('comunicados.index')->with('success','Comunicado criado!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comunicado $comunicado)
    {
        return view('comunicados.edit', compact('comunicado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comunicado $comunicado)
    {
        $dados = $request->validate([
            'titulo' => 'required | string | max:255',
            'descricao' => 'required | string',
            'data' => 'required | date',
        ]);

        Comunicado::update([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data' => $dados['data'],
        ]);

        return redirect()->route('comunicados.index')->with('success','Comunicado atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comunicado $comunicado)
    {
        $comunicado->delete();
        return redirect()->route('comunicados.index')->with('success','Comunicado removido!');
    }
}
