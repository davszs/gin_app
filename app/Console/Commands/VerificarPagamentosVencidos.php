<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pagamento;
use Carbon\Carbon;

class VerificarPagamentosVencidos extends Command
{
    protected $signature = 'pagamentos:verificar-vencidos';
    protected $description = 'Marca como vencidos os pagamentos não pagos após o vencimento.';

    public function handle(): int
    {
        $pagamentos = Pagamento::where('status', 'pendente')
            ->whereDate('vencimento', '<', Carbon::now())
            ->get();

        foreach ($pagamentos as $pagamento) {
            $pagamento->status = 'vencido';
            $pagamento->save();
        }

        $this->info($pagamentos->count() . ' pagamento(s) vencido(s) atualizado(s).');
        return Command::SUCCESS;
    }
}
