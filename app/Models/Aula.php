<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
     protected $table = 'aula';

    protected $fillable = [
        'nome', 'descricao', 'dia_semana', 'horario_inicio', 'horario_fim', 'instrutor', 'capacidade'
    ];

    public function alunosInscritos()
    {
        return $this->belongsToMany(Aluno::class, 'inscricao_aula', 'aula_id', 'aluno_id')
                    ->withPivot('status', 'data_inscricao')
                    ->wherePivot('status', 'ativo');
    }
}
