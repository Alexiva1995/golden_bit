<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Monedas extends Model
{
    protected $table = "monedas";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'nombre', 'simbolo', 'mostrar_a_d', 'principal'
    ];
    
}