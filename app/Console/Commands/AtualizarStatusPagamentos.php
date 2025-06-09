<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pagamento;
use Carbon\Carbon;

class AtualizarStatusPagamentos extends Command
{
    protected $signature = 'app:atualizar-status-pagamentos';

    protected $description = 'Verifica e atualiza o status dos pagamentos conforme o status atual do plano';

    public function handle()
    {
        $hoje = Carbon::now();
        $referencia = $hoje->copy()->startOfMonth();

        // Busca pagamentos pendentes do mês atual
        $pagamentos = Pagamento::where('status', 'pendente')
            ->whereMonth('data_referencia', $referencia->month)
            ->whereYear('data_referencia', $referencia->year)
            ->with('plano') // carrega plano relacionado
            ->get();

        $atualizados = 0;

        foreach ($pagamentos as $pagamento) {
            $plano = $pagamento->plano;

            // Verifica se o plano está ativo
            if (!$plano || !$plano->ativo) {
                // Atualiza status do pagamento para cancelado, por exemplo
                $pagamento->status = 'cancelado';
                $pagamento->save();
                $atualizados++;
            }
        }

        $this->info("Pagamentos atualizados: $atualizados");
    }
}
