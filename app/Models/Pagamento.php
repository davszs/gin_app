<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'user_id',
        'plano_id',
        'data_referencia',
        'vencimento',
        'valor',
        'status',
        'data_pagamento',
    ];
     protected $dates = [
        'data_pagamento', 'data_referencia', 'vencimento',
    ];

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
    public function aluno()
{
    return $this->belongsTo(Aluno::class);
}
public function marcarComoPago(Carbon $dataPagamento)
    {
        $this->data_pagamento = $dataPagamento;

        // Garantir que 'vencimento' seja tratado como instância Carbon
        $vencimento = $this->vencimento instanceof Carbon
            ? $this->vencimento
            : Carbon::parse($this->vencimento);

        if ($dataPagamento->gt($vencimento)) {
            $this->status = 'pago com atraso';
            $this->valor = number_format($this->valor * 1.10, 2, '.', ''); // 10% de multa
        } else {
            $this->status = 'pago';
        }

        $this->save();
    }
}
