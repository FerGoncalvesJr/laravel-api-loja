<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'loja_id',
        'ativo',
        'estoque',
    ];

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }
}