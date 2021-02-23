<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichas extends Model
{
    protected $table = 'fichas';

    protected $fillable = [
        'idoriginal', 'user_email', 'user_status', 'user_login', 'user_nicename', 'display_name',
        'gender', 'birthdate', 'user_pass', 'password', 'clave', 
        'referred_id', 'tipouser', 'status', 'position_id', 'arbol'
    ];
}
