<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckPublicidad extends Model
{
    //

    protected $table = 'check_publicidad';

    protected $fillable = [
        'iduser', 'idpublicidad', 'fecha', 'red_social'
    ];
}
