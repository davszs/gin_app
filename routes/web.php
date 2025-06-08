<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\InscricaoAulaController;
use App\Http\Controllers\SolicitacaoAulaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\SuportController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\PlanoController;

Route::get('/', function () {
    return redirect()->route('login');
});


//ROTAS login e logout
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login.submit', [AuthController::class, 'loginAttempt'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ROTAS principal aluno e adm
Route::get('/home_aluno', fn() => view('alunoviews.dashboardaluno'))->name('aluno.dashboard');
Route::get('/home_admin', fn() => view('admviews.dashboard'))->name('admin.dashboard');

//ROTAS rec - senha
Route::get('/recuperar-senha', [ResetPasswordController::class, 'showResetForm'])->name('recuperar-senha');
Route::post('/recuperar-senha', [ResetPasswordController::class, 'resetPassword']);

// ROTAS CRUD alunos e admins
Route::resource('alunos', AlunosController::class);
Route::resource('admins', AdministradorController::class);

// ROTAS alunos 
//Aulas-Aluno
Route::middleware(['auth'])->group(function () {
    Route::get('/minhas-aulas', [InscricaoAulaController::class, 'minhasAulas'])->name('aulas.aluno');
    Route::post('/aulas/{aula}/inscrever', [InscricaoAulaController::class, 'inscrever'])->name('inscricao.inscrever');
    Route::put('/aulas/{aula}/cancelar', [InscricaoAulaController::class, 'cancelarInscricao'])->name('inscricao.cancelar');
    Route::get('/aulas/filtro', [InscricaoAulaController::class, 'filtro'])->name('aulas.filtro');
});
//Pagamentos-Aluno
Route::get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamento.aluno');
Route::get('/pagar-boleto/{id}', [PagamentoController::class, 'gerarBoleto'])->name('pagamento.gerarBoleto');
//Comunicados-Alunos
Route::get('/comunicados-aluno', [ComunicadoController::class, 'index_aluno'])->name('comunicados.aluno');
//Suporte-Alunos
Route::get('/suporte-', [SuportController::class, 'index'])->name('suport.aluno');
Route::post('/suporte/chamado', [SuportController::class, 'enviar'])->name('suporte.enviar');

//Configurações-Alunos
    Route::get('/configuracoes-alunos', [ConfigController::class, 'configuracoes'])->name('config.aluno');
    Route::put('/configuracoes-alunos', [ConfigController::class, 'atualizarConfiguracoes'])->name('atualizar.dados');




//ROTAS adm
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/solicitacoes', [SolicitacaoAulaController::class, 'index'])->name('solicitacoes.index');
    Route::put('/solicitacoes/{id}/aprovar', [SolicitacaoAulaController::class, 'aprovar'])->name('solicitacoes.aprovar');
    Route::put('/solicitacoes/{id}/rejeitar', [SolicitacaoAulaController::class, 'rejeitar'])->name('solicitacoes.rejeitar');
});

Route::resource('aulas', AulaController::class);

Route::get('/financeiro', fn() => view('admviews.financeiro'))->name('financeiro');


//Rotas Gerenciamento de Planos
Route::get('/planos', [PlanoController::class, 'index'])->name('planos.index');
Route::post('/planos/{plano}/inscricao/adicionar', [PlanoController::class, 'adicionarInscricao'])->name('plano.adicionarInscricao');
Route::delete('/planos/{plano}/inscricao/{inscricao}', [PlanoController::class, 'removerInscricao'])->name('plano.removerInscricao');
Route::post('/planos/{id}/cancelar', [PlanoController::class, 'cancelarPlano'])->name('planos.cancelar');
Route::post('/planos/{id}/ativar', [PlanoController::class, 'ativarPlano'])->name('planos.ativar');




//Rotas de configurações portal ADM
Route::get('/configuracoes', fn() => view('admviews.config'))->name('adm.config');
Route::put('/admin/senha', [AdministradorController::class, 'updatePassword'])->name('admin.updatePassword');

//Rotas Crud comunicados
Route::resource('comunicados', ComunicadoController::class);



