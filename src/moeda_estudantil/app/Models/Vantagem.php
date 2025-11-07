<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vantagem extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'empresa_id',
        'foto',
        'valor',
    ];
    
    protected $table = 'vantagens';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function resgates()
    {
        return $this->hasMany(Resgate::class);
    }
}
