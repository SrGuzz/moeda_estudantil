<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'rua',
        'numero',
        'cidade',
        'estado',
        'cep',
        'complemento',
        'bairro'
    ];

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }
}
