<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botbrainbow extends Model
{
    protected $table = 'botbrainbow';

    protected $fillable = [
        'fondo_inversion', 'redes_neuronales', 
        'acciones', 'mes', 'year'
    ];
}
