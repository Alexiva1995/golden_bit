<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    //

    protected $table = 'publicidad';

    protected $fillable = [
        'titulo', 'descripcion', 'img',
    ];
}
