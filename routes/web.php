<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});


//ROTAS login e logout
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login.submit', [AuthController::class, 'loginAttempt'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ROTAS principal aluno e adm
Route::get('/home_aluno', fn() => view('alunoviews.dashboardaluno'))->name('aluno.dashboard');
Route::get('/home_admin', fn() => view('dashboard'))->name('admin.dashboard');

//ROTAS rec - senha
Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword']);

Route::resource('alunos', AlunosController::class);

// ROTAS alunos 
Route::get('/minhas-aulas', fn() => view('alunoviews.aulas'))->name(("aulas.aluno"));
Route::get('/pagamento', fn() => view('alunoviews.financeiroaluno'))->name(("pagamento.aluno"));
Route::get('/comunicados-aluno', fn() => view('alunoviews.comunicados'))->name(("comunicados.aluno"));

//ROTAS adm



