<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'iduser', 'titulo', 'descripcion', 'ruta',
        'icono', 'vista', 'status', 'id_producto'
    ];
}
