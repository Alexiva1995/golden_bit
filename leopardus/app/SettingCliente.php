<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingCliente extends Model
{
    protected $table = 'settingcliente';

    protected $fillable = [
        'cliente', 'permiso'
    ];
}