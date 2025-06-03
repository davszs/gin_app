<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'plano_id',
        'data_referencia',
        'vencimento',
        'valor',
        'status',
        'data_pagamento',
    ];

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
