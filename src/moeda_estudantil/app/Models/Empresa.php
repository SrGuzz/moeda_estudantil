<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'cnpj',
        'endereco_id',
        'user_id',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function professor()
    {
        return $this->hasMany(Professor::class);
    }

    public function vantagens()
    {
        return $this->hasMany(Vantagem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
