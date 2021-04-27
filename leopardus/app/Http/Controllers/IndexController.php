<?php

namespace App\Http\Controllers;

use App\OrdenInversion;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RangoController;

use function GuzzleHttp\json_decode;

class IndexController extends Controller
{

    /**
     * Permite saber el estado del binario del usuario
     *
     * @param integer $id - id del usuario a revisar
     * @return boolean
     */
    public function statusBinary($id)
    {
        $result = false;
        $derecha = User::where([
            ['referred_id', '=', $id ],
            ['status', '=', 1],
            ['ladomatrix', '=', 'D']
        ])->get()->count('ID');
        $izquierda = User::where([
            ['referred_id', '=', $id ],
            ['status', '=', 1],
            ['ladomatrix', '=', 'I']
        ])->get()->count('ID');

        if ($derecha >= 1 && $izquierda >= 1) {
            $result = true;
        }
        return $result;
    }

    
    /**
     * Permite obtener la informacion para el arbol o matris
     *
     * @param integer $id - id del usuario a obtener sus hijos
     * @param string $type - tipo de estructura a general
     * @return void
     */
    public function getDataEstructura($id, $type)
    {
        $genealogyType = [
            'tree' => 'referred_id',
            'matriz' => 'position_id',
        ];
        
        $childres = $this->getData($id, 1, $genealogyType[$type]);
        $trees = $this->getChildren($childres, 2, $genealogyType[$type]);
        return $trees;
    }


    /**
     * Permite obtener a todos mis hijos y los hijos de mis hijos
     *
     * @param array $users - arreglo de usuarios
     * @param integer $nivel - el nivel en el que esta parado
     * @param string $typeTree - el tipo de arbol a usar
     * @return void
     */
    public function getChildren($users, $nivel, $typeTree)
    {
        if (!empty($users)) {
            foreach ($users as $user) {
                $user->children = $this->getData($user->ID, $nivel, $typeTree);
                $this->getChildren($user->children, ($nivel+1), $typeTree);
            }
            return $users;
        }else{
            return $users;
        }
    }

    /**
     * Se trare la informacion de los hijos 
     *
     * @param integer $id - id a buscar hijos
     * @param integer $nivel - nivel en que los hijos se encuentra
     * @param string $typeTree - tipo de arbol a usar
     * @return void
     */
    private function getData($id, $nivel, $typeTree) : object
    {
        $rango = new RangoController();
        $resul = User::where($typeTree, '=', $id)->orderBy('ladomatrix', 'desc')->get();
        foreach ($resul as $user) {
            $patrocinado = User::find($user->referred_id);
            $paquete = json_decode($user->paquete);
            $avatarTree = ($paquete->code == 1) ? asset('assets/imgLanding/icono_plan_vip.png') : asset('assets/imgLanding/icono_plan_standar.png');
            
            $userTemp = DB::table('user_campo')->where('ID', '=', $user->ID)->first();
            $user->fullname = $user->display_name;
            if (!empty($userTemp)) {
                $user->fullname = $userTemp->firstname.' '.$user->lastname;
            }

            $user->avatarTree = $avatarTree;
            $user->avatar = asset('avatar/'.$user->avatar);
            $user->nivel = $nivel;
            $user->invertido = $rango->getTotalInvertion($user->ID);
            $user->ladomatriz = $user->ladomatrix;
            $user->patrocinador = $patrocinado->display_name;
        }
        return $resul;
    }

    /**
     * Permite tener la informacion de los hijos como un listado
     *
     * @param integer $parent - id del padre
     * @param array $array_tree_user - arreglo con todos los usuarios
     * @param integer $nivel - nivel
     * @param string $typeTree - tipo de usuario
     * @param boolean $allNetwork - si solo se va a traer la informacion de los directos o todos mis hijos
     * @return 
     */
    public function getChidrens2($parent, $array_tree_user, $nivel, $typeTree, $allNetwork) : array
    {   
        if (!is_array($array_tree_user))
        $array_tree_user = [];
    
        $data = $this->getData($parent, $nivel, $typeTree);
        if (count($data) > 0) {
            if ($allNetwork == 1) {
                foreach($data as $user){
                    if ($user->nivel == 1) {
                        $array_tree_user [] = $user;
                    }
                }
            }else{
                foreach($data as $user){
                    $array_tree_user [] = $user;
                    $array_tree_user = $this->getChidrens2($user->ID, $array_tree_user, ($nivel+1), $typeTree, $allNetwork);
                }
            }
        }
        return $array_tree_user;
    }

    /**
     * Se trare la informacion de los hijos 
     *
     * @param integer $id - id a buscar hijos
     * @param integer $nivel - nivel en que los hijos se encuentra
     * @param string $typeTree - tipo de arbol a usar
     * @return void
     */
    private function getDataSponsor($id, $nivel, $typeTree) : object
    {
        $resul = User::where($typeTree, '=', $id)->get();
        foreach ($resul as $user) {
            $user->avatar = asset('avatar/'.$user->avatar);
            $user->nivel = $nivel;
        }
        return $resul;
    }

    /**
     * Permite obtener a todos mis patrocinadores
     *
     * @param integer $child - id del hijo
     * @param array $array_tree_user - arreglo de patrocinadores
     * @param integer $nivel - nivel a buscar
     * @param string $typeTree - llave a buscar
     * @param string $keySponsor - llave para buscar el sponsor, position o referido
     * @return array
     */
    public function getSponsor($child, $array_tree_user, $nivel, $typeTree, $keySponsor): array
    {
        if (!is_array($array_tree_user))
        $array_tree_user = [];
    
        $data = $this->getDataSponsor($child, $nivel, $typeTree);
        if (count($data) > 0 ) {
            foreach($data as $user){
                $array_tree_user [] = $user;
                $array_tree_user = $this->getSponsor($user->$keySponsor, $array_tree_user, ($nivel+1), $typeTree, $keySponsor);
            }
        }
        return $array_tree_user;
    }


    /**
     * Permite ordenar el arreglo primario con las claves de los arreglos segundarios
     * 
     * @access public
     * @param array $arreglo - el arreglo que se va a ordenar, string $clave - con que se hara la comparecion de ordenamiento,
     * stridn $forma - es si es cadena o numero
     * @return array
     */
    public function ordenarArreglosMultiDimensiones($arreglo, $clave, $forma)
    {
        usort($arreglo, $this->build_sorter($clave, $forma));
        return $arreglo;
    }

    /**
     * compara las clave del arreglo
     * 
     * @access private
     * @param string $clave - llave o clave del arreglo segundario a comparar
     * @return string
     */
    private function build_sorter($clave, $forma) {
        return function ($a, $b) use ($clave, $forma) {
            if ($forma == 'cadena') {
                return strnatcmp($a[$clave], $b[$clave]);
            } else {
                return $b[$clave] - $a[$clave] ;
            }
            
        };
    }    

    /**
     * Permite obtener las inversiones realizadas por el usuario
     *
     * @param integer $iduser
     * @return object
     */
    public function getInversionesUserDashboard($iduser, $vista = false) : object
    {
        $fechaActual = Carbon::now();
        $arrayInversiones = [];
        $user = User::find($iduser);
        $paquete = json_decode($user->paquete);
        if ($vista == false) {
            $inversiones = DB::table('log_rentabilidad')->where([
                ['iduser', '=', $iduser],
                ['progreso', '<', 100]
            ])->get();
        }else{
            $inversiones = DB::table('log_rentabilidad')->where([
                ['iduser', '=', $iduser],
            ])->get();
        }

        if ($inversiones != null) {
            $arrayInversiones = $inversiones;
        }

        // foreach ($inversiones as $inversion) {
        //     // if ($paquete != null) {
        //         $arrayInversiones [] = $inversion;
        //     // }
        // }

        return $arrayInversiones;
    }

    /**
     * Permite Obtener las inversiones activas del año acual
     *
     * @return array
     */
    public function getInversionesActivaAdmin(): array
    {
        $sql = "SELECT COUNT(id) as inversiones, MONTHNAME(created_at) as meses FROM `orden_inversiones` WHERE status = 1 AND paquete_inversion != '' AND YEAR(created_at) = ? GROUP BY MONTH(created_at)";
        $inversiones = DB::select($sql, [date('Y')]);
        $totalInversiones = OrdenInversion::where([
            ['status', '=', 1],
            ['paquete_inversion', '!=', ''],
            [DB::raw('YEAR(created_at)'), '=', date('Y')]
        ])->get()->count('id');
        $arrayInversiones = [];
        foreach ($inversiones as $inversion) {
            $arrayInversiones [] = $inversion->inversiones;
        }
        $data = [
            'totalInversiones' => $totalInversiones,
            'arregloInversiones' => $arrayInversiones
        ];

        return $data;
    }

    /**
     * Permite Obtener el total Invertido en las Inversiones
     *
     * @return array
     */
    public function getTotalInvertidoAdmin(): array
    {
        $sql = "SELECT SUM(invertido) as total, MONTHNAME(created_at) as meses FROM `orden_inversiones` WHERE status = 1 AND paquete_inversion != '' AND YEAR(created_at) = ? GROUP BY MONTH(created_at)";
        $inversiones = DB::select($sql, [date('Y')]);
        $totalInversiones = OrdenInversion::where([
            ['status', '=', 1],
            ['paquete_inversion', '!=', ''],
            [DB::raw('YEAR(created_at)'), '=', date('Y')]
        ])->get()->sum('invertido');
        $arrayInversiones = [];
        foreach ($inversiones as $inversion) {
            $arrayInversiones [] = $inversion->total;
        }
        $data = [
            'totalInvertido' => $totalInversiones,
            'arregloInvertido' => $arrayInversiones
        ];
        return $data;
    }

    /**
     * Permite obtener el dinero que entra en los ultimos 2 meses
     *
     * @return array
     */
    public function getEntradaMesAdmin() : array
    {
        $sql = "SELECT SUM(invertido) as total, MONTH(created_at) as mes, DAY(created_at) as dia FROM `orden_inversiones` WHERE status = 1 AND paquete_inversion != '' AND MONTH(created_at) > (MONTH(now()) - 2) AND YEAR(created_at) = ? GROUP BY MONTH(created_at), DAY(created_at) ";
        $inversiones = DB::select($sql, [date('Y')]);
        $mesAnterior = [];
        $mesActual = [];
        $totalAnterior = 0;
        $totalActual = 0;
        for ($i=1; $i < 33; $i++) { 
            $mesAnterior [] = 0;
            $mesActual [] = 0;
        }
        foreach ($inversiones as $inversion) {
            if ($inversion->mes == (date('m') - 1)) {
                $mesAnterior[$inversion->dia] = $inversion->total;
                $totalAnterior += $inversion->total;
            }
            if ($inversion->mes == (date('m'))) {
                $mesActual[$inversion->dia] = $inversion->total;
                $totalActual += $inversion->total;
            }
        }
        $data = [
            'anterior' => json_encode($mesAnterior),
            'actual' => json_encode($mesActual),
            'totalAnterior' => $totalAnterior,
            'totalActual' => $totalActual
        ];
        return $data;
    }

    /**
     * Permite obtener las divisiones por año
     *
     * @return void
     */
    public function getDivisionPaquete()
    {
        $users = User::where('ID', '!=', 1)->get();
        
        $arraydivision = [];
        $totalS = 0;
        $totalV = 0;
        foreach ($users as $user) {
            $paquete = json_decode($user->paquete);
            if ($paquete != null) {
                if ($paquete->code == 1) {
                    $totalV++;
                } else {
                    $totalS++;
                }
                
            }
        }
        $arraydivision [] = $totalV;
        $arraydivision [] = $totalS;
        $data = [
            'VIP' => $totalV,
            'STANDAR' => $totalS,
            'total' => json_encode($arraydivision)
        ];
        return $data;
    }

    /**
     * Permite obtener las ultimas inversiones realizadas
     *
     * @return array
     */
    public function getInversionesAdminDashboard() : array
    {
        $fechaActual = Carbon::now();
        $arrayInversiones = [];
        $inversiones = OrdenInversion::where([
            ['paquete_inversion', '!=', ''],
        ])->orderBy('id', 'desc')->get()->take(8);
        foreach ($inversiones as $inversion) {
            $user = User::find($inversion->iduser);
            $paquete = json_decode($user->paquete);
            $fechaPaquete = new Carbon($paquete->fecha);
            if ($fechaActual >= $fechaPaquete) {
                $paquete = null;
            }
            if ($paquete != null) {
                $arrayInversiones [] = [
                    'id' => $inversion->id,
                    'correo' => (!empty($user)) ? $user->user_email : 'Usuario No Disponible',
                    // 'img' => asset('products/'.$paquete->post_excerpt),
                    'inversion' => $inversion->invertido,
                    'plan' => $paquete->nombre,
                    'estado' => $inversion->status
                ];
            }
        }

        return $arrayInversiones;
    }

    /**
     * Permite obtener la cantidad de usuario registrado por años
     *
     * @return void
     */
    public function getUserRegistrado()
    {
        $sql = "SELECT COUNT(ID) as users, MONTH(created_at) as mes FROM wp_users WHERE YEAR(created_at) = ? GROUP BY MONTH(created_at)";
        $users = DB::select($sql, [date('Y')]);
        $totalMes = [];
        $totalRegistrado = 0;
        foreach ($users as $mes) {
            $totalMes [] = $mes->users;
            $totalRegistrado = ($totalRegistrado + $mes->users);
        }
        $data = [
            'totalusers' => $totalRegistrado,
            'arrayregistro' => json_encode($totalMes)
        ];
        return $data;
    }

}
