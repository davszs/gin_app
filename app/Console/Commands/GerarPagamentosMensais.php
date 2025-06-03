<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Plano;
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

        $planos = Plano::where('ativo', true)->get();
        $totalGerado = 0;

        foreach ($planos as $plano) {
            $jaExiste = Pagamento::where('plano_id', $plano->id)
                ->whereMonth('data_referencia', $referencia->month)
                ->whereYear('data_referencia', $referencia->year)
                ->exists();

            if (!$jaExiste) {
                Pagamento::create([
                    'plano_id' => $plano->id,
                    'valor' => $plano->valor,
                    'status' => 'pendente',
                    'vencimento' => $referencia->copy()->addDays(10),
                    'data_referencia' => $referencia,
                ]);
                $totalGerado++;
            }
        }

        $this->info("Pagamentos gerados: $totalGerado");
    }
}
