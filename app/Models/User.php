<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $table = 'users';



    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'password',
        'tipo',
        'status' //ativo ou bloqueado
    ];

    protected $hidden = ['password', 'remember_token'];

    // Nome do campo de senha personalizado
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    
    public function administrador()
    {
        return $this->hasOne(Administrador::class);
    }

}