<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
           if (Auth::check()) {
        $tipo = Auth::user()->tipo;
        return redirect()->route($tipo === 'administrador' ? 'admin.dashboard' : 'aluno.dashboard');
    }
        return view('login');
    }

    public function loginAttempt(Request $request)
{
    $dados = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $dados['email'])->first();

    if ($user && Hash::check($dados['password'], $user->password)) {
        Auth::login($user);
        $request->session()->regenerate();

        $tipo = $user->tipo;
        return redirect()->route($tipo === 'administrador' ? 'admin.dashboard' : 'aluno.dashboard')->with('status', $tipo === 'administrador' ? 'Bem-vindo ao Portal de Controle!' : 'Bem-vindo ao Portal do Aluno!');
    }

    return back()->withInput()->with('status', 'Login inválido!');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}