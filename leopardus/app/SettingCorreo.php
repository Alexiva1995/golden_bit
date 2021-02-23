<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingCorreo extends Model
{
    protected $table = 'settingplantilla';

    protected $fillable = [
        'titulo', 'contenido'
    ];
}