<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $table = 'usuario'; 
    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'email', 'nome_user', 'senha_user', 'tipo_user'
    ];

    protected $hidden = ['senha_user'];

    // Nome do campo de senha personalizado
    public function getAuthPassword()
    {
        return $this->senha_user;
    }
}