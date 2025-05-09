<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm () {
        return view('resetpassword');
    }
    public function resetPassword () {
        // Lógica para recuperar senha   
    }
}
