<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = "comunicados";

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'tipo',
        'importante',
    ];
    protected $dates = [
    'data',
];
protected $casts = [
        'data' => 'date', // transforma automaticamente em Carbon
    ];
}
