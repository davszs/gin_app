<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'aulas';

    protected $fillable = [
        'nome',
        'descricao',
        'dia_semana',
        'horario_inicio',
        'horario_fim',
        'instrutor',
        'capacidade',
    ];

    /**
     * Uma aula pode ter vários alunos inscritos.
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'inscricao_aula', 'aula_id', 'aluno_id')
                    ->withPivot('status', 'data_inscricao')
                    ->withTimestamps();
    }

    /**
     * Inscrições completas na aula (inclusive canceladas).
     */
    public function inscricoes()
    {
         return $this->belongsToMany(Aluno::class, 'inscricao_aula', 'aula_id', 'aluno_id')
                ->withPivot('status', 'data_inscricao')
                ->withTimestamps();
    }
}