<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Aluno;
use App\Models\User;
use App\Models\Plano;

class ConfigController extends Controller
{
    public function configuracoes()
    {
        $usuarioLogado = Auth::user();
        $aluno = Aluno::where('user_id', $usuarioLogado->id)->first();

        if (!$aluno) {
            abort(404, 'Aluno não encontrado.');
        }

        $plano = Plano::with('inscricoes.aula')->where('aluno_id', $aluno->id)->first();

        return view('alunoviews.configuracoes', compact('aluno', 'plano','usuarioLogado'));
    }

   public function atualizarConfiguracoes(Request $request)
{
   $usuarioLogado = Auth::user();  

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuarioLogado->id,
            'telefone' => 'nullable|string',
            'endereco' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $aluno = Aluno::where('user_id', $usuarioLogado->id)->first();

        if (!$aluno) {
            abort(404, 'Aluno não encontrado.');
        }

        // Atualiza avatar
        if ($request->hasFile('avatar')) {
            if ($aluno->avatar && Storage::disk('public')->exists($aluno->avatar)) {
                Storage::disk('public')->delete($aluno->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $aluno->avatar = $path;
        }

        $usuarioLogado = User::where('id', $usuarioLogado->id)->first();
        // Atualiza dados do usuário (users)
        $usuarioLogado->nome = $request->nome;
        $usuarioLogado->email = $request->email;
        $usuarioLogado->save();

        // Atualiza dados do aluno
        $aluno->telefone = $request->telefone;
        $aluno->endereco = $request->endereco;
        $aluno->save();

        return redirect()->route('config.aluno')->with('status', 'Dados atualizados com sucesso!');
    }
}