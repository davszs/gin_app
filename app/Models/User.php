<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'cpf', 'email', 'nome', 'password', 'tipo'
    ];

    protected $hidden = ['password'];

    // Nome do campo de senha personalizado
    public function getAuthPassword()
    {
        return $this->password;
    }
    
    //Relacionamento(1,1): Um usuário pode ser um aluno
    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    //Relacionamento(1,1): Um usuário pode ser um administrador
    public function administrador()
    {
        return $this->hasOne(Administrador::class);
    }
}