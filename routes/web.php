<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login.submit', [AuthController::class, 'loginAttempt'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home_aluno', fn() => view('alunoviews.dashboardaluno'))->name('aluno.dashboard');
Route::get('/home_admin', fn() => view('dashboard'))->name('admin.dashboard');


Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword']);

Route::resource('alunos', AlunosController::class);

Route::get('/aulas', fn() => view('alunoviews.aulas'));
Route::get('/financeiro', fn() => view('alunoviews.financeiroaluno'));
Route::get('/comunicados', fn() => view('alunoviews.comunicados'));

