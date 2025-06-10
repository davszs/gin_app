<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscricaoAula extends Model
{
    protected $table = 'inscricao_aula';

    protected $fillable = [
        'aluno_id',
        'aula_id',
        'status',
        'data_inscricao',
        'valor',
    ];

    // Ajuste conforme sua tabela
    public $timestamps = false;

    public function planos()
    {
          return $this->belongsToMany(Plano::class, 'plano_inscricao_aula', 'inscricao_aula_id', 'plano_id');
    }

    
    public function aula()
{
    return $this->belongsTo(Aula::class );
}

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
