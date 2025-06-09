<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Aluno extends Model
{
     use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'user_id',
        'telefone',
        'endereco',
        'avatar' //foto de perfil
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function aulas()
    {
        return $this->belongsToMany(Aula::class, 'inscricao_aula', 'aluno_id', 'aula_id')
                ->withPivot('status', 'data_inscricao')
                ->withTimestamps();
    }


    public function inscricoes()
    {
         return $this->hasMany(InscricaoAula::class);
    }
    public function plano()
{
    return $this->hasOne(Plano::class);
}
public function pagamentos()
{
    return $this->hasMany(Pagamento::class);
}
    

}
