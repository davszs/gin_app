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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/cadastro', [RegisterController::class, 'cadastro']);
Route::post('/recuperar-senha', [ResetPasswordController::class, 'recuperar-senha']);
