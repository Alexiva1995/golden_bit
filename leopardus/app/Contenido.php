<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{

protected $table = "contenidos";

 protected $fillable=[
    	'titulo','contenido','imagen'
    ];

}
