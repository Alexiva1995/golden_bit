<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;
use App\Settings;
use Auth;

class NotificationController extends Controller
{
    
    /**
     * Permite crear nuevas notificaciones
     *
     * @param array $datos - datos a guardar
     * @return void
     */
    public function newNotification(array $datos)
    {
        Notificacion::create($datos);
    }

    /**
     * Permite Poner la notificacion como vista
     *
     * @param integer $idproducto
     * @param integer $iduser
     * @return void
     */
    public function viewTicket($idproducto, $iduser)
    {
        Notificacion::where([
            ['id_producto', '=', $idproducto],
            ['iduser', $iduser]
        ])->update([
            'vista' => 1, 
            'status' => 1
        ]);
    }
}
