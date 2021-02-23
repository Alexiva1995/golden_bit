<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CicloPublicidad extends Model
{
    //
    
    protected $table = 'ciclo_publicidad';

    protected $fillable = [
        'iduser', 'ciclo', 'completado', 'semana', 'year'
    ];
}
