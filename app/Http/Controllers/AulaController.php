<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::all();
        return view('', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required|string|max:50',
            'descricao'=>'nullable|string|max:255',
            'dia_semana'=>'required|integer|between:1,7',
            'horario_inicio'=>'required|date_format:H:i',
            'horario_fim'=>'required|date_format:H:i|after:horario_inicio',
            'instrutor'=>'required|string|max:50',
            'capacidade'=>'required|integer|min:1',
            'valor'=>'required|numeric|min:0|max:999999.99',
        ]);

        Aula::create($request->all());
        return redirect()->route('')->with('status', 'Aula cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        return view('', compact('aula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        return view('', compact('aula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'nome'=>'sometimes|required|string|max:50',
            'descricao'=>'sometimes|nullable|string|max:255',
            'dia_semana'=>'sometimes|required|integer|between:1,7',
            'horario_inicio'=>'sometimes|required|date_format:H:i',
            'horario_fim'=>'sometimes|required|date_format:H:i|after:horario_inicio',
            'instrutor'=>'sometimes|required|string|max:50',
            'capacidade'=>'sometimes|required|integer|min:1',
            'valor'=>'sometimes|required|numeric|min:0|max:999999.99',
        ]);

        $aula->update($request->only([
            'nome', 'descricao', 'dia_semana', 'horario_inicio',
            'horario_fim', 'instrutor', 'capacidade', 'valor'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('')->with('status', 'Aula removida!');
    }
}
