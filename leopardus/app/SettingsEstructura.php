<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsEstructura extends Model
{
    protected $table = 'settingsestructura';

    protected $fillable = [
        'tipoestructura', 'cantnivel', 'cantfilas', 'estructuraprincipal', 'usuarioprincipal'
    ];
}