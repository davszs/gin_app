<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          if ($request->has('q')) {
    $query = $request->input('q');

    $comunicados = Comunicado::where('titulo', 'like', "%$query%")
        ->orWhere('descricao', 'like', "%$query%")
        ->orWhere('tipo', 'like', "%$query%")
        ->get();
} else {
    $comunicados = Comunicado::all();
}
        return view('comunicados.index', compact('comunicados'));
    }

    public function index_aluno()
    {
    $comunicados = Comunicado::orderBy('data', 'desc')->get(); // ou ->paginate(6)
    return view('alunoviews.comunicados', compact('comunicados'));

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
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string',
        'data' => 'required|date',
        'tipo' => 'required|string|in:geral,aulas', // exemplo: somente essas opções
        'importante' => 'nullable|boolean', // checkbox
    ]);

    $dados['importante'] = $request->has('importante'); // checkbox = true/false

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
     $request->validate([
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string|max:500',
        'data' => 'required|date',
        'tipo' => 'required|in:geral,aulas',
    ]);

    $comunicado->titulo = $request->titulo;
    $comunicado->descricao = $request->descricao;
    $comunicado->data = $request->data;
    $comunicado->tipo = $request->tipo;
    $comunicado->importante = $request->has('importante'); // Essa linha é a chave

    $comunicado->save();

    return redirect()->route('comunicados.index')->with('success', 'Comunicado atualizado com sucesso!');
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
