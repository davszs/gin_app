<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aluno;
use App\Models\Pagamento;
use Carbon\Carbon;

class GerarPagamentosMensais extends Command
{
   protected $signature = 'app:gerar-pagamentos-mensais';
    protected $description = 'Gera mensalmente os pagamentos dos alunos com planos ativos';

    public function handle()
    {
        $hoje = Carbon::now();
        $referencia = $hoje->copy()->startOfMonth();

        // Busca alunos ativos com planos ativos
        $alunos = Aluno::where('ativo', true)
            ->whereHas('plano', function($query) {
                $query->where('ativo', true);
            })->with('plano')->get();

        $totalGerado = 0;

        foreach ($alunos as $aluno) {
            $plano = $aluno->plano;

            // Verifica se já existe pagamento para esse aluno/plano no mês/ano da referência
            $jaExiste = Pagamento::where('user_id', $aluno->user->id)
                ->where('plano_id', $plano->id)
                ->whereMonth('data_referencia', $referencia->month)
                ->whereYear('data_referencia', $referencia->year)
                ->exists();

            if (!$jaExiste) {
                Pagamento::create([
                    'user_id' => $aluno->user->id,
                    'plano_id' => $plano->id,
                    'valor' => $plano->valor,
                    'status' => 'pendente',
                    'vencimento' => $referencia->copy()->addDays(10),
                    'data_referencia' => $referencia->toDateString(),
                ]);
                $totalGerado++;
            }
        }

        $this->info("Pagamentos gerados: $totalGerado");
    }
}
