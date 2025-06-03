<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\InscricaoAulaController;
use App\Http\Controllers\SolicitacaoAulaController;
use App\Http\Controllers\PagamentoController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/minhas-aulas', [InscricaoAulaController::class, 'minhasAulas'])->name('aulas.aluno');
    Route::post('/aulas/{aula}/inscrever', [InscricaoAulaController::class, 'inscrever'])->name('inscricao.inscrever');
    Route::put('/aulas/{aula}/cancelar', [InscricaoAulaController::class, 'cancelarInscricao'])->name('inscricao.cancelar');
    Route::get('/aulas/filtro', [InscricaoAulaController::class, 'filtro'])->name('aulas.filtro');


});
Route::get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamento.aluno');
Route::get('pagar-boleto/{id}', [PagamentoController::class, 'gerarBoleto'])->name('pagamento.gerarBoleto');
Route::get('/comunicados-aluno', fn() => view('alunoviews.comunicados'))->name(("comunicados.aluno"));

//ROTAS adm
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/solicitacoes', [SolicitacaoAulaController::class, 'index'])->name('solicitacoes.index');
    Route::put('/solicitacoes/{id}/aprovar', [SolicitacaoAulaController::class, 'aprovar'])->name('solicitacoes.aprovar');
    Route::put('/solicitacoes/{id}/rejeitar', [SolicitacaoAulaController::class, 'rejeitar'])->name('solicitacoes.rejeitar');
});

Route::get('/cadastro-aulas', fn() => view('cadastro.aulas'))->name('cadastro.aulas');

Route::get('/financeiro', fn() => view('financeiro'))->name('financeiro');

Route::get('/planos', fn() => view('planos'))->name('planos');

Route::get('/configuracoes', fn() => view('config'))->name('adm.config');


