<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plano extends Model
{
    use HasFactory;

    protected $table = 'planos';

    protected $fillable = [
        'aluno_id',
        'nome',
        'valor_total',
        'status',
    ];

    /**
     * Um plano pertence a um aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Um plano tem muitas inscrições (via tabela pivot).
     */
    public function inscricoes()
{
    return $this->belongsToMany(
        InscricaoAula::class,
        'plano_inscricao_aula',
        'plano_id',
        'inscricao_aula_id'
    )->withTimestamps();
}

    public function aulas()
{
    return $this->inscricoes->map(function ($inscricao) {
        return $inscricao->aula;
    });
}

    public function calcularValorTotal()
{
    $valorTotal = $this->inscricoes->sum(function ($inscricao) {
        return $inscricao->aula->valor ?? 0;
    });

    $this->valor_total = $valorTotal;
    $this->save();

    return $valorTotal;
}
}
