<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Aluno;
use App\Models\Plano;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
  

public function configuracoes()
{
    $user = Auth::user();
    $aluno = Aluno::where('user_id', $user->id)->first();
      if (!$aluno) {
        abort(404, 'Aluno não encontrado.');
    }
     $plano = Plano::with('inscricoes.aula')->where('aluno_id', $aluno->id)->first();

    return view('alunoviews.configuracoes', compact('aluno', 'plano'));
}

public function atualizarConfiguracoes(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email',
        'telefone' => 'nullable|string',
        'endereco' => 'nullable|string',
        'avatar' => 'nullable|image|max:2048'
    ]);

    $user = Auth::user();
    $aluno = Aluno::where('user_id', $user->id)->first();

    if ($request->hasFile('avatar')) {
        // Deleta o antigo se existir
        if ($aluno->avatar && Storage::exists($aluno->avatar)) {
            Storage::delete($aluno->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $aluno->avatar = $path;
    }

    $aluno->nome = $request->nome;
    $aluno->email = $request->email;
    $aluno->telefone = $request->telefone;
    $aluno->endereco = $request->endereco;
    $aluno->save();

    return redirect()->route('config.aluno')->with('status', 'Dados atualizados com sucesso!');
}

}
