<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsBono extends Model
{
    //
    protected $table = 'settingsbono';

    protected $fillable = [
        'type_bono', 'settings_bono', 'info_extra'
    ];
}
