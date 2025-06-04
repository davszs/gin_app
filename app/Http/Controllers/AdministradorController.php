<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Administrador::with('user')->get();
        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');
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
            'tipo' => 'administrador',
            'cpf' => $dados['cpf'],
        ]);

        Administrador::create([
            'user_id' => $user->id,
            'telefone' => $dados['telefone'],
            'endereco' => $dados['endereco'],
        ]);

        return redirect()
            ->route('admins.index')
            ->with('status', 'Administrador cadastrado com sucesso! Senha: ' . $senhagerada);
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $admin)
    {
        $admin->load('user');
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrador $admin)
    {
        $admin->load('user');
        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $admin)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:50',
            'email' => 'required|email|max:90|unique:users,email,' . $admin->user_id,
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $admin->user_id, 
            'telefone' => 'required|string|max:13',
            'endereco' => 'required|string|max:100',
        ]);

        $admin->user->update([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'cpf' => $dados['cpf'],
        ]);

        $admin->update([
            'telefone' => $dados['telefone'],
            'endereco' => $dados['endereco']
        ]);

        return redirect()->route('admins.index')->with('status', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $admin)
    {
        $admin->user->delete();
        return redirect()->route('admins.index')->with('status', 'Administrador removido!');
    }
}
