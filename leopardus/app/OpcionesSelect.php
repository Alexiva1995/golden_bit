<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionesSelect extends Model
{
    protected $table = 'opciones_select';

    protected $fillable = [
        'idselect', 'valor'
    ];
}
