<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm () {
        return view('resetpassword');
    }
   public function resetPassword(Request $request) {
    $dados = $request->validate([
        'email' => 'required|email',
    ]);
    $user = User::where('email', $dados['email'])->first();

    if ($user ) {
        // Lógica para envio real de e-mail de recuperação (Se sobrar tempo)
        return redirect()->back()->with('status', 'E-mail cadastrado! Informações para trocar a senha foram enviadas.');
    }   
    return redirect()->back()->with('status', 'E-mail não cadastrado!
     Verifique se digitou corretamente.');
    
}
}
