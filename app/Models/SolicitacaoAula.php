<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAula extends Model
{
    use HasFactory;

     protected $table = 'solicitacao_aulas';

    protected $fillable = [
        'aluno_id',
        'aula_id',
        'tipo',
        'status',
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}