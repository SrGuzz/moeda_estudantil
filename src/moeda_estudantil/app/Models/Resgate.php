<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resgate extends Model
{
    protected $fillable = [
        'aluno_id',
        'vantagem_id',
        'valor',
        'codigo_resgate',
        'status'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function vantagem()
    {
        return $this->belongsTo(Vantagem::class);
    }

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
