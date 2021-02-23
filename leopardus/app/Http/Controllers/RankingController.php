<?php

namespace App\Http\Controllers;

use App\Settings; use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\SettingsEstructura;
use App\Wallet;


class RankingController extends Controller
{
    /**
     * Función que devuelve los patrocinados de un determinado usuario
     * 
     * @access private
     * @param int $id - id del usuario 
     * @return array
     */
    private function getSponsor($user_id){
        $tmp = User::select('ID', 'user_email', 'status', 'display_name', 'created_at','wallet_amount')->where('position_id', $user_id)->get()->toArray();
		return $tmp;
    }
    /**
     * Función que devuelve los referidos de un determinado usuario
     * 
     * @access public
     * @param int $user_id - id del usuario
     * @return array - listado de los referidos del usuario
     */
    public function getReferreds($user_id){
        $referidos = User::select('ID', 'user_email', 'status', 'display_name', 'created_at','wallet_amount')->where('position_id', $user_id)->get()->toArray();
		return $referidos;
	}
    
    /**
     * Obtienen a todo los usuarios referidos de un usuario determinado
     * 
     * @access public
     * @param array $arregloUser - listado de usuario, int $niveles - niveles a recorrer,
     * int $para - nivel a detenerse, array $allUser - todos los usuario referidos
     * @return array - listado de todos los usuario
     */
	public function getReferredsAll($arregloUser, $niveles, $para, $allUser, $tipoestructura)
    {
        if ($niveles <= $para) {
            $llaves =  array_keys($arregloUser);
            $finFor = end($llaves);
            $cont = 0;
            $tmparry = [];
            foreach ($arregloUser as $user) {
                $allUser [] = [
                    'ID' => $user['ID'],
                    'email' => $user['user_email'],
                    'nombre' => $user['display_name'],
                    'status' => $user['status'],
                    'nivel' => $niveles,
                    'fecha' => $user['created_at'],
                    'wallet' => $user['wallet_amount'],
                ];
                if ($tipoestructura == 'arbol') {
                    if (!empty($this->getReferreds($user['ID']))) {
                        $tmparry [] = $this->getReferreds($user['ID']);
                    }
                }else{
                    if (!empty($this->getSponsor($user['ID']))) {
                        $tmparry [] = $this->getSponsor($user['ID']);
                    }
                }
                if ($finFor == $cont) {
                    if (!empty($tmparry)) {
                        $tmp2 = $tmparry[0];
                        for($i = 1; $i < count($tmparry); $i++){
                            $tmp2 = array_merge($tmp2,$tmparry[$i]);
                        }
                        $this->getReferredsAll($tmp2, ($niveles+1), $para, $allUser, $tipoestructura);
                    }else{
                        $GLOBALS['allUsers'] = $allUser;
                    }
                }else{
                    $cont++;
                }
          }
        }else{
            $GLOBALS['allUsers'] = $allUser;
        }
    }

    /**
     * Devuelve el tipo de estructura con que se esta trabajando en el sistema
     * 
     * @access public
     * @return string
     */
    public function obtenerEstructura()
    {
        $settingEstructura = SettingsEstructura::find(1);
        $estructura = "";
        if ($settingEstructura->tipoestructura == 'arbol') {
            $estructura = "arbol";
        } elseif ($settingEstructura->tipoestructura == 'matriz') {
            $estructura = "matriz";
        }else{
            if ($settingEstructura->estructuraprincipal == 1) {
                if ($settingEstructura->usuarioprincipal == 1) {
                    $estructura = "arbol";
                } else {
                    $estructura = "matriz";
                }
            } else {
                if ($settingEstructura->usuarioprincipal == 1) {
                    $estructura = "arbol";
                } else {
                    $estructura = "matriz";
                }
            }
        }
        return  $estructura;
    }


    /**
     * Genera el Arreglo de los usuarios referidos
     * 
     * @access public
     * @param $iduser - id del usuario 
     * @return array
     */
    public function generarArregloUsuario($iduser)
    {
        $settingEstructura = SettingsEstructura::find(1);
        $GLOBALS['allUsers'] = [];
        if ($this->obtenerEstructura() == 'arbol') {
            $referidosDirectos = $this->getReferreds($iduser);
            $this->getReferredsAll($referidosDirectos, 1, $settingEstructura->cantnivel, [], 'arbol');
        } else {
            $referidosDirectos = $this->getSponsor($iduser);
            $this->getReferredsAll($referidosDirectos, 1, $settingEstructura->cantnivel, [], 'matriz');
        }

        return $GLOBALS['allUsers'];
    }

    /**
     * Obtiene lo nuevos miembros de un usuario
     */
    public function newMembers($iduser)
    {
        $TodosUsuarios = $this->generarArregloUsuario($iduser);
        $TodosUsuarios = $this->ordenarArreglosMultiDimensiones($TodosUsuarios, 'ID', 'numero');
        return array_slice($TodosUsuarios, 0, 5);
    }

    /**
     * Obtiene la información de las ventas
     * 
     * calcula la cantidad de ventas mensuales
     * 
     * @access public
     * @return array
     */
    public function chartVentas()
    {
        $settings = Settings::first();
        // $sql = "SELECT month(wp.post_date) as mes, SUM(wpm.meta_value) as total FROM $settings->prefijo_wp.postmeta as wpm INNER JOIN $settings->prefijo_wp.posts as wp on (wp.ID = wpm.post_id) WHERE wp.post_status = 'wc-completed' AND wpm.meta_key = '_order_total' AND YEAR(wp.post_date) = year(now()) GROUP BY month(wp.post_date)";
        $ventas = DB::table($settings->prefijo_wp.'postmeta')
                        ->join($settings->prefijo_wp.'posts', $settings->prefijo_wp.'postmeta.post_id', '=', $settings->prefijo_wp.'posts.id')
                        ->select(DB::raw('month('.$settings->prefijo_wp.'posts.post_date) as mes'), DB::raw('SUM('.$settings->prefijo_wp.'postmeta.meta_value) as total'))
                        ->where([
                            [$settings->prefijo_wp.'posts.post_status', '=', 'wc-completed'],
                            [$settings->prefijo_wp.'postmeta.meta_key', '=', '_order_total'],
                            [DB::raw('YEAR('.$settings->prefijo_wp.'posts.post_date)'), '=', 'year(now())'],
                        ])->groupBy(DB::raw('month('.$settings->prefijo_wp.'posts.post_date)'))->get();
        
        return json_encode($ventas);
    }

    /**
     * Obtiene la información de los rangos
     * 
     * calcula la cantidad de rangos que estan en el sistema
     * 
     * @access public
     * @return array
     */
    public function chartRangos()
    {
        $settings = Settings::first();
        // $sql = "SELECT r.name, COUNT(wu.rol_id) FROM roles as r LEFT JOIN $settings->prefijo_wp.users as wu on (r.id = wu.rol_id) GROUP BY r.name";
        if (Auth::user()->ID != 1) {
            if ($this->obtenerEstructura() == 'arbol') {
                $roles = DB::table('roles')
                    ->leftjoin($settings->prefijo_wp.'users', 'roles.id', '=', $settings->prefijo_wp.'users.rol_id')
                    ->select('roles.name', DB::raw('COUNT('.$settings->prefijo_wp.'users.rol_id) as cantidad'))
                    ->where($settings->prefijo_wp.'users.referred_id', Auth::user()->ID)
                    ->orderBy('roles.id', 'asc')
                    ->groupBy('roles.name')->get();
            } else {
                $roles = DB::table('roles')
                    ->leftjoin($settings->prefijo_wp.'users', 'roles.id', '=', $settings->prefijo_wp.'users.rol_id')
                    ->select('roles.name', DB::raw('COUNT('.$settings->prefijo_wp.'users.rol_id) as cantidad'))
                    ->where($settings->prefijo_wp.'users.sponsor_id', Auth::user()->ID)
                    ->orderBy('roles.id', 'asc')
                    ->groupBy('roles.name')->get();
            }
        } else {
            $roles = DB::table('roles')
                    ->join($settings->prefijo_wp.'users', 'roles.id', '=', $settings->prefijo_wp.'users.rol_id')
                    ->select('roles.name', DB::raw('COUNT('.$settings->prefijo_wp.'users.rol_id) as cantidad'))
                    ->orderBy('roles.id', 'asc')
                    ->groupBy('roles.name')->get();
        }
        
        
        return json_encode($roles);
    }

    /**
     * Obtiene la información de los usuarios
     * 
     * calcula la cantidad de usuario que tiene el sistema, tambien calcula la cantidad activos e inactivos
     * 
     * @access public
     * @return array
     */
    public function chartUsuarios()
    {
        if (Auth::user()->ID != 1) {

            $data = [];
            if ($this->obtenerEstructura() == 'arbol') {
                $data = ['referred_id', '=', Auth::user()->ID];
            } else{
                $data = ['sponsor_id', '=', Auth::user()->ID];
            }
            $cantReferidosActivos = User::where([['ID', '!=', 1], ['status', '=', 1], $data])->count('ID');
            $cantReferidosInactivos = User::where([['ID', '!=', 1], ['status', '=', 0], $data])->count('ID'); 
        } else {
            $cantReferidosActivos = User::where([['ID', '!=', 1], ['status', '=', 1]])->count('ID');
            $cantReferidosInactivos = User::where([['ID', '!=', 1], ['status', '=', 0]])->count('ID'); 
        }
        
        $datos = [
            'activos' => $cantReferidosActivos,
            'inactivos' => $cantReferidosInactivos
        ];
        return json_encode($datos);
    }

    /**
     * Realiza un rankig de los 5 usuarios com mas comisiones
     * 
     * @access public
     * @return array
     */
    public function rankingComisiones()
    {
        $ranking = [];
        $clave = "";
        if (Auth::user()->rol_id != 0) {
            $users = $this->generarArregloUsuario(Auth::user()->ID);
            
            $clave1 = 'ID';
            $clave4 = 'wallet';

        } else {

            $users = User::all()->toArray();
           
            
            $clave1 = 'ID';
            $clave4 = 'wallet_amount';
            
        }
            
             foreach ($users as $user) {
                 
            $usuario = DB::table('user_campo')
             ->where('ID', '=', $user['ID'] )
             ->get();
             foreach ($usuario as $usua){
        $usuario1=$usua->ID;
        $usuario=$usua->nameuser;
            $usuario2=$usua->firstname;
             $usuario3=$usua->lastname;
             
            $ranking [] = [
                'usuario' => $usuario,
                'usuario1' => $usuario1,
                'usuario2' => $usuario2,
                'usuario3' => $usuario3,
                'usuario4' => $user[$clave4],
               
                'total' => Wallet::where('iduser', $user['ID'])->get()->sum('debito'),
            ];
            
             }
                 
          }
        
        $ranking = $this->ordenarArreglosMultiDimensiones($ranking, 'total', 'numero');
        
        return array_slice($ranking, 0, 50);;
    }

    /**
     * Realiza un rankig de los 5 usuarios com mas Compras
     * 
     * @access public
     * @return array
     */
    public function rankingVentas()
    {
        $ranking = [];
        $clave = "";
        if (Auth::user()->ID != 1) {
            $users = $this->generarArregloUsuario(Auth::user()->ID);
            $clave = "nombre";
        } else {
            $users = User::all()->toArray();
            $clave = "display_name";
        }
        $settings = Settings::first();
        $cantVentasMont = 0;
        foreach ($users as $user) {
            $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user['ID'])
                            ->orderBy('post_id', 'DESC')
                            ->get();

            foreach ($ordenes as $orden){
                $totalOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $orden->id)
                        ->where('meta_key', '=', '_order_total')
                        ->first();
                $cantVentasMont = ($totalOrden + $cantVentasMont);
            }
            $ranking [] = [
                'usuario' => $user[$clave],
                'totalventas' => $cantVentasMont,
            ];
        }

        $ranking = $this->ordenarArreglosMultiDimensiones($ranking, 'totalventas', 'numero');
        
        return array_slice($ranking, 0, 5);;
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
     * Obtiene todas las ventas de la red
     * 
     * @access public
     * @param int $iduser - id del usuario
     * @return int 
     */
    public function countOrderNetwork($iduser)
    {
        $TodosUsuarios = $this->generarArregloUsuario($iduser);
        $compras = array();
        $cantVentas = 0;
        $settings = Settings::first();
        foreach($TodosUsuarios as $user){
            $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user['ID'])
                            ->orderBy('post_id', 'DESC')
                            ->get();

            foreach ($ordenes as $orden){
                $cantVentas++;
            }
        }
        return $cantVentas;
    }

    /**
     * Obtiene el monto de todas las ventas de la red
     * 
     * @access public
     * @param int $iduser - id del usuario
     * @return float
     */
    public function countOrderNetworkMont($iduser)
    {
        $TodosUsuarios = $this->generarArregloUsuario($iduser);
        $compras = array();
        $cantVentasMont = 0;
        $settings = Settings::first();
        foreach($TodosUsuarios as $user){
            $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user['ID'])
                            ->orderBy('post_id', 'DESC')
                            ->get();

            foreach ($ordenes as $orden){
                $totalOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $orden->id)
                        ->where('meta_key', '=', '_order_total')
                        ->first();
                $cantVentasMont = ($totalOrden + $cantVentasMont);
            }
        }
        return $cantVentasMont;
    }

}
