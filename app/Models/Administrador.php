<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id', 'telefone', 'endereco' 
    ];

    //Relacionamento (1,1): Um administrador pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
