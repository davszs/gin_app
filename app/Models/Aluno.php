<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
     use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'user_id',
        'nome',
        'email',
        'cpf',
        'telefone',
        'endereco',
        'avatar' //foto de perfil
    ];

    /**
     * Um aluno pertence a um usuário (tabela users).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Um aluno pode estar inscrito em várias aulas.
     */
    public function aulas()
    {
        return $this->belongsToMany(Aula::class, 'inscricao_aula', 'aluno_id', 'aula_id')
                ->withPivot('status', 'data_inscricao')
                ->withTimestamps();
    }

    /**
     * Um aluno tem muitas inscrições (registro completo, mesmo que canceladas).
     */
    public function inscricoes()
    {
          return $this->belongsToMany(Aluno::class, 'inscricao_aula', 'aula_id', 'aluno_id')
                ->withPivot('status', 'data_inscricao')
                ->withTimestamps();
    }
    public function plano()
{
    return $this->hasOne(Plano::class);
}
    
}
