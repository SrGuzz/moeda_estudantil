<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'rg',
        'curso',
        'instituicao',
        'saldo_moedas',
        'user_id',
        'endereco_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
