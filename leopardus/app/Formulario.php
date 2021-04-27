<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = 'formulario';

    protected $fillable = [
        'nameinput', 'estado', 'requerido', 'label', 'tipo', 'min', 'max', 'input_edad', 'desactivable', 'unico'
    ];
}
