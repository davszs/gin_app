<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscricaoAula extends Model
{
       protected $table = 'inscricao_aula';

    protected $fillable = ['aluno_id', 'aula_id', 'status', 'data_inscricao'];

    public $timestamps = false;
}
