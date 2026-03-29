<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'preco_compra',
        'preco_venda',
        'quantidade',
        'imagem'
    ];
}
