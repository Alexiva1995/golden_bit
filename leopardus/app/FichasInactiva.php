<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichasInactiva extends Model
{
    protected $table = 'fichasinactivas';

    protected $fillable = [
        'iduser', 'arbol'
    ];
}