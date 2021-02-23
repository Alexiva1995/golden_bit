<?php

namespace App\Http\Controllers;
use App\User;

use Carbon\Carbon;
use App\Http\Controllers\IndexController;

use function GuzzleHttp\json_encode;

class ActivacionController extends Controller
{

    /**
     * Verifica que es estado de los usuarios 
     * 
     * @access public 
     * @param int $userid - id del usuarios a verificar
     * @return string
     */
    public function activarUsuarios($userid)
    {
        $user = User::find($userid);
        $index = new IndexController();
        $inversiones = $index->getInversionesUserDashboard($userid);
        if (count($inversiones) > 0) {
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        $user->save();
    }

    /**
     * Permite verificar el estado del paquete al usuario
     *
     * @param integer $userid
     * @return integer
     */
    public function verificarPaquete($userid): int
    {
        $user = User::find($userid);
        $valor = 2;
        if (!empty($user->paquete)) {
            $paquete = json_decode($user->paquete);
            $fechaPaquete = new Carbon($paquete->fecha);
            if (Carbon::now() > $fechaPaquete) {
                $paqueteNew = [
                    'nombre' => 'Standar',
                    'fecha' => Carbon::now()->addMonth()->format('Y-m-d'),
                    'code' => 0
                ];
                $user->paquete = json_encode($paqueteNew);
                $user->save();
            }
            $valor = $paquete->code;
        }
        return $valor;
    }

    /**
     * Permite activar el paquete gold por un mes mas al usuario
     *
     * @param integer $iduser
     * @return void
     */
    public function activarPaqueteGold(int $iduser)
    {
        $user = User::find($iduser);
        $paquete = [
            'nombre' => 'Gold',
            'fecha' => Carbon::now()->addMonth()->format('Y-m-d'),
            'code' => 1
        ];
        $user->paquete = json_encode($paquete);
        $user->save();
    }
}
