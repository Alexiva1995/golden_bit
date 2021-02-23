<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingActivacion extends Model
{
    protected $table = 'settingactivacion';

    protected $fillable = [
        'tipoactivacion', 'tiporecompra', 'requisitoactivacion', 'requisitorecompra'
    ];
}