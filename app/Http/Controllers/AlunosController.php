<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\from;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = Aluno::with('user')->get();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:50',
            'email' => 'required|email|max:90|unique:users',
            'cpf' => 'required|string|max:14|unique:users',
            'telefone' => 'required|string|max:13',
            'endereco' => 'required|string|max:100',
        ]);

        //Senha automática
        $senhagerada = Str::random(8);

        $user = User::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'password' => Hash::make($senhagerada),
            'tipo' => 'aluno',
            'cpf' => $dados['cpf'],
        ]);

        Aluno::create([
            'user_id' => $user->id,
            'telefone' => $dados['telefone'],
            'endereco' => $dados['endereco'],
        ]);

        return redirect()
            ->route('alunos.index')
            ->with('status', 'Aluno cadastrado com sucesso! Senha: ' . $senhagerada);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        $aluno->load('user');
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno)
    {
        $aluno->load('user');
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:50',
            'email' => 'required|email|max:90|unique:users,email,' . $aluno->user_id,
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $aluno->user_id, 
            'telefone' => 'required|string|max:13',
            'endereco' => 'required|string|max:100',
        ]);

        $aluno->user->update([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'cpf' => $dados['cpf'],
        ]);

        $aluno->update([
            'telefone' => $dados['telefone'],
            'endereco' => $dados['endereco']
        ]);

        return redirect()->route('alunos.index')->with('status', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->user->delete();
        return redirect()->route('alunos.index')->with('status', 'Aluno removido!');
    }
}
