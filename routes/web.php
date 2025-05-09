<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/financeiro', function () {
    return view('financeiro');
})->name('financeiro');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/cadastro', [RegisterController::class, 'showRegisterForm'])->name('cadastro');
Route::post('/cadastro', [RegisterController::class, 'cadastro'])->name('cadastro.submit');

Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword']);
