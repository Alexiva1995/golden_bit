<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenRetiro extends Model
{
    protected $table = 'orden_retiro';

    protected $fillable = [
        'idinversion', 'total_retirar', 'retiro', 'penalizacion', 'iduser',
        'concepto', 'plan', 'ganancia', 'porc_penalizacion', 'fecha_vencimiento',
        'status'
    ];
}
