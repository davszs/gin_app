<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login.submit', [AuthController::class, 'loginAttempt'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home_aluno', fn() => view('dashboard'))->name('aluno.dashboard');
Route::get('/home_admin', fn() => view('financeiro'))->name('admin.dashboard');


<<<<<<< HEAD
Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword']);

// Route::get('/alunos', fn() => view('alunos'))->name('alunos.index');
// Route::get('/alunos/create', fn() => view('create_aluno'))->name('alunos.create');
// Route::post('/alunos', [AlunosController::class,'createAluno'])->name('alunos.store');

Route::resource('alunos', AlunosController::class);
=======
Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha.form');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword'])->name('recuperar-senha');
>>>>>>> 2207afab0b720dfee75c656f9b89344f279a6649
