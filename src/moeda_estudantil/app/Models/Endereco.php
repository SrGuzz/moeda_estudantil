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
        'aluno_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
