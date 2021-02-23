<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsComision extends Model
{
    protected $table = 'settingcomision';

    protected $fillable = [
        'niveles', 'tipocomision', 'valorgeneral', 'valordetallado', 'tipopago', 
        'comisiontransf', 'comisionretiro', 'bonoactivacion', 'primera_compra',
        'directos'
    ];
}
