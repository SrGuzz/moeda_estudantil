<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'cnpj',
        'endereco_id',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function professor()
    {
        return $this->hasMany(Empresa::class);
    }
}
