<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\GerarPagamentosMensais::class,
        \App\Console\Commands\AtualizarStatusPagamentos::class,
        \App\Console\Commands\VerificarPagamentosVencidos::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        
     $schedule->command('app:gerar-pagamentos-mensais')->everyMinute()->withoutOverlapping();
$schedule->command('app:atualizar-status-pagamentos')->everyMinute()->withoutOverlapping();
$schedule->command('pagamentos:verificar-vencidos')->everyMinute()->withoutOverlapping();

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
