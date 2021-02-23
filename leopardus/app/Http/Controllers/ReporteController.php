<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Settings;
use App\User; 
use App\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Commission;
use App\Pagos;use App\Wallet;


class ReporteController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Informes');
	}
	
	//perfil
	 public function perfil()
    {
        return view('info.perfil');
    }
    
    //buscar por nombre para los reportes de perfil
    public function nombre(Request $request)
    {
        view()->share('do', collect(['name' => 'inicio', 'text' => 'Inicio']));
        $settings = Settings::first();        

          $buscar = DB::table($settings->prefijo_wp.'users')
                    ->where('user_nicename', '=', $request->user_nicename)
                    ->first();
                           
                            
            if($buscar == null){
        return redirect('mioficina/admin/info/perfil')->with('msj2', 'El usuario no esta registrado');
            }
                
             if($buscar != null){   
    
                  $buscar = DB::table($settings->prefijo_wp.'users')
                ->where('user_nicename', '=', $request->user_nicename)
                ->get();  
       
            }
             return view('info.nombre')->with(compact('buscar'));
    }
    
    
     public function usuario(Request $request)
    {
        view()->share('do', collect(['name' => 'inicio', 'text' => 'Inicio']));
        
        $settings = Settings::first();

          $buscar = DB::table($settings->prefijo_wp.'users')
                            ->where('ID', '=', $request->id)
                            ->first();
                           
                            
            if($buscar == null){
        return redirect('mioficina/admin/info/perfil')->with('msj3', 'El id no esta registrado');
            }
                
             if($buscar != null){   
              
                  $buscar = DB::table($settings->prefijo_wp.'users')
                            ->where('ID', '=', $request->id)
                            ->get();  
       
            }
             return view('info.mostrar-usuario')->with(compact('buscar'));
    }
    
    public function mostrarusuario()
    {
        return view('info.mostrar-usuario');
    }
    
    public function lista(Request $request)
    {
       $primero = $request->primer_id;
         $segundo = $request->segundo_id;
         
         
         $usuario = User::All();
      
        return view('info.lista-final')->with(compact('usuario','primero','segundo'));
      
    }
    
    public function listafinal()
    {
        return view('info.lista-final');
    }
    
    //termina el perfil
    
    
    //empieza activacion
     public function activacion()
    {
        return view('info.activacion');
    }
    
    
    public function mostraractivo(Request $request)
    {
      
         
      $usuario=User::where('referred_id', '=', Auth::user()->ID)
             ->whereDate("created_at",">=",$request->primer_id)
             ->whereDate("created_at","<=",$request->segundo_id)
             ->get();
        return view('info.mostrar-activo')->with(compact('usuario'));
    }
    
    
    
     public function fecha(Request $request)
    {
      
        $settings = Settings::first();
$usuario = DB::table($settings->prefijo_wp.'users')
                ->where('referred_id', '=', Auth::user()->ID)
                ->whereDate('created_at','=', $request->fecha)
                ->get();
                
        return view('info.mostrar-activo')->with(compact('usuario'));
    }
    
    //termina la activacion
    
    
    //rango
     public function rango()
    {
        $rangos = Rol::all();
        return view('info.rango')->with(compact('rangos'));
    }
    
    public function mostrarrango(Request $request)
    {
        $settings = Settings::first();
      $rango = DB::table($settings->prefijo_wp.'users')
                            ->where('rol_id', '=', $request->rango)
                            ->get();
    
    return view('info.mostrar-rango')->with(compact('rango'));
    }
    //fin rango
    
    
    //comisiones
    public function comisiones()
    {
        return view('info.comisiones');
    }
    
     public function mostrarcomisiones(Request $request)
    {
        
      if (Auth::user()->ID != 1) {
          $lista=Commission::where('user_id', '=', Auth::user()->ID)
             ->whereDate("date",">=",$request->primero)
             ->whereDate("date","<=",$request->segundo)
             ->where('total', '!=', 0)
             ->get(); 
      }else{
        $lista=Commission::whereDate("date",">=",$request->primero)
        ->whereDate("date","<=",$request->segundo)
        ->where('total', '!=', 0)
        ->get(); 
      }
      
        return view('info.mostrar-comisiones')->with(compact('lista'));
    }
    //termina comisiones
    
    //pagos
     public function pagos()
    {
        $pagos = Pagos::where('estado', 1)->get();
        return view('info.pagos')->with(compact('pagos'));
    }
    
    public function pagosusuario(Request $request)
    {
       $pagos=Pagos::search($request->get('iduser'))->orderBy('id','ASC')->paginate(1);
      
     return view('info.pagosusuario')->with('pagos',$pagos);
    }
    
     public function buscar(Request $request)
    {
       
         
      $pagos=Pagos::whereDate("fechapago",">=",$request->primero)
             ->whereDate("fechapago","<=",$request->segundo)
             ->get(); 
        return view('info.pagosusuario')->with('pagos',$pagos);
      
    }
    //fin pagos
    
    //inicio reportes de pagos
    public function reportes()
    {
        return view('info.reportes');
    }
    
    public function todos()
    {
         $pago=Pagos::orderBy('id','ASC')->paginate(10);
       return view('info.todos')->with('pago',$pago);
    }
    
     public function reporfecha(Request $request)
    {
      
         
      $pago=Pagos::whereDate("fechapago",">=",$request->primero)
             ->whereDate("fechapago","<=",$request->segundo)
             ->get(); 
        return view('info.todos')->with('pago',$pago);
    }
    
    public function nombrebus(Request $request)
    {
      
        $pago = DB::table('pagos')
                            ->where('username', '=', $request->nombre)
                            ->first();
                           
                            
            if($pago == null){
        return redirect('mioficina/admin/info/reportes')->with('msj2', 'El usuario no esta registrado');
            }
            
            if($pago != null){   
             
                  $pago = DB::table('pagos')
                            ->where('username', '=', $request->nombre)
                            ->get();  
       
            }
             return view('info.todos')->with('pago',$pago);
    }
    //fin reportes de pagos
    
    
    
    //inicio de reporte comision
    public function reporcomi()
    {
        return view('info.repor-comi');
    }
    
    public function reportodos(Request $request)
    {

        
        $comision=Commission::where('user_id', '=', Auth::user()->ID)
              ->whereDate("date", '>=', $request->primero)
             ->whereDate("date", '<=', $request->segundo)
             ->where('total', '!=', 0)
             ->get(); 
        return view('info.repor-todos')->with('comision',$comision);
    }
    //fin de reporte de comision
    
    //inicia ventas
    public function ventas()
    {
        return view('info.ventas');
    }
    
    public function informe_fecha()
    {
       $primero =date('d-m-Y', strtotime($_POST['fecha']));
      $settings = Settings::first();
     $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                    ->select('post_id')
                    ->where('meta_key', '=', '_customer_user')
                    ->orderBy('post_id', 'DESC')
                    ->get();
                    
        return view('info.informe_fecha')->with(compact('ordenes','primero'));
    }

    /**
     * Permite obtener la informacion de las compras o ordenes 
     *
     * @param integer $order_id - id de la compra a buscar
     * @param array $array_datos - arreglo donde se guardara la informacion
     * @param integer $level - nivel del usuario
     * @param string $nombre - nombre del usuario
     * @param date $desde - fecha filtro desde
     * @param date $hasta - fecha filtro hasta
     * @return array
     */
    public function getDetailsOrder($order_id, $array_datos, $level, $nombre, $desde, $hasta) : array { 
        $settings = Settings::first();
        $numOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_order_key')
                        ->first();
        $fechaOrden = DB::table($settings->prefijo_wp.'posts')
                        ->select('post_date')
                        ->where('ID', '=', $order_id)
                        ->first();
        $totalOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_order_total')
                        ->first();
        $idUsuario = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_customer_user')
                        ->first();
        $nombreOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_billing_first_name')
                        ->first();
        $apellidoOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_billing_last_name')
                        ->first();
		$nombreCompleto = $nombre;
        if (!empty($nombreOrden->meta_value) && !empty($apellidoOrden->meta_value)) {
    	$nombreCompleto = $nombreOrden->meta_value." ".$apellidoOrden->meta_value;
        }else{
            $tmpuser = User::find($idUsuario->meta_value);
            if (!empty($tmpuser)) {
                $nombreCompleto = $tmpuser->display_name;
            }
        }
        $itemsOrden = DB::table($settings->prefijo_wp.'woocommerce_order_items')
                        ->select('order_item_name')
                        ->where('order_id', '=', $order_id)
                        ->where('order_item_type', '=', 'line_item')
                        ->get();
        $estadoOrden = DB::table($settings->prefijo_wp.'posts')
                        ->select('post_status')
                        ->where('ID', '=', $order_id)
                        ->first();
        $estadoEntendible = '';
        switch ($estadoOrden->post_status) {
            case 'wc-completed':
                $estadoEntendible = 'Completado';
                break;
            case 'wc-pending':
                $estadoEntendible = 'Pendiente de Pago';
                break;
            case 'wc-processing':
                $estadoEntendible = 'Procesando';
                break;
            case 'wc-on-hold':
                $estadoEntendible = 'En Espera';
                break;
            case 'wc-cancelled':
                $estadoEntendible = 'Cancelado';
                break;
            case 'wc-refunded':
                $estadoEntendible = 'Reembolsado';
                break;
            case 'wc-failed':
                $estadoEntendible = 'Fallido';
                break;
        }
        $items = "";
        foreach ($itemsOrden as $item){
            $items = $items." ".$item->order_item_name;
        }
        $datos = [
            'idcompra' => $order_id,
            'nombre_user' => $nombreCompleto,
            'fecha_orden' => $fechaOrden->post_date,
            'item' => $items,
            'total_orden' => $totalOrden->meta_value,
            'nivel' => $level,
            'estado_orden' => $estadoEntendible
        ];
        $fechaOrden = new Carbon($fechaOrden->post_date);
        if ($desde->format('ymd') <= $fechaOrden->format('ymd') && $fechaOrden->format('ymd') <= $hasta->format('ymd') && $estadoOrden->post_status == 'wc-completed') {
            array_push($array_datos, $datos);
        }
        return($array_datos);
    }
    
    public function informe_ventas(Request $datos)
    {
        $primero = new Carbon($datos->fecha1);
        $segundo = new Carbon($datos->fecha2);;
        $settings = Settings::first();
        $compras = [];
        $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                    ->select('post_id')
                    ->where('meta_key', '=', '_customer_user')
                    ->orderBy('post_id', 'DESC')
                    ->get();

        foreach ($ordenes as $orden) {
            $compras = $this->getDetailsOrder($orden->post_id, $compras, 0, '', $primero, $segundo);
        }
        // dd($compras);
        return view('info.informe_ventas')->with(compact('compras'));
    }
    //fin informe de ventas
    
    //informe de liquidacion 
    public function liquidacion()
    {
            $liquidacion = Wallet::where([
                    ['iduser', '=', Auth::user()->ID],
                    ['tipotransacion', '=', 0],
                ])->orWhere([
                    ['iduser', '=', Auth::user()->ID],
                    ['tipotransacion', '=', 1]
                ])
                ->get();
                
        return view('info.liquidacion')->with(compact('liquidacion'));
    }

    /**
     * Permite visualizar los feed que se gana el admin
     *
     * @return view
     */
    public function descuentos()
    {
        $pagos = Wallet::where([
            ['tipotransacion', '=', 0],
        ])->orWhere([
            ['tipotransacion', '=', 1]
        ])
        ->get();
        
        return view('info.descuento')->with(compact('pagos'));
    }

    /**
     * Muestra el total de todas las billeteras en el sistema
     *
     * @return void
     */
    public function billeteras()
    {
        $totalBilleteras = User::where('ID', '>', '4')->get()->sum('wallet_amount');
        return view('info.total_billeteras')->with(compact('totalBilleteras'));
    }
    
}	