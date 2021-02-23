<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'idcompra', 'iduser', 'arbol'
    ];
}
