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
        'nome',
        'cpf',
        'email',
        'password',
        'tipo',
    ];

    protected $hidden = ['password'];

    // Nome do campo de senha personalizado
    public function getAuthPassword()
    {
        return $this->password;
    }
}