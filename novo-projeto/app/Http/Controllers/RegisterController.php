<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm () {
        return view('welcome');
    }
    public function cadastro () {
        // Lógica para o cadastro
    }
}
