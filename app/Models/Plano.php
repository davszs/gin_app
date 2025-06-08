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
        'status', // enum ativo ou cancelado
    ];

    /**
     * Um plano pertence a um aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
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
    return $this->inscricoes->map(fn($inscricao) => $inscricao->aula);
}

    public function calcularValorTotal()
{
    $valorTotalInscricoes = $this->inscricoes->sum(fn($inscricao) => $inscricao->aula->valor ?? 0);
    $valorTotalAjustes = $this->ajustes->sum('valor');

    $this->valor_total = $valorTotalInscricoes + $valorTotalAjustes;
    $this->save();

    // Atualiza os próximos pagamentos
    $this->pagamentos()
        ->where('data_referencia', '>=', now()->startOfMonth())
        ->update(['valor' => $this->valor_total]);

    return $this->valor_total;
}
public function pagamentos()
{
    return $this->hasMany(Pagamento::class);
}
public function ajustes()
{
    return $this->hasMany(AjustePlano::class);
}



}
