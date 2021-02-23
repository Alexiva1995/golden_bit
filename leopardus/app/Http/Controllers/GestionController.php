<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ActualizarController;


class GestionController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Profile view');
	}
	
	//perfil de usuario
		public function verusuario($id)
    {
        $yo =  Crypt::decrypt($id);
        
        $actualizar = new ActualizarController;
        $data = $actualizar->infoUsuario($yo);
 
        return view('gestion.encontrado')->with(compact('data'));
    }
	
	public function gestionperfiles()
    {
        return view('gestion.gestionperfiles');
    }
    
    	public function gestion(Request $request)
    {
        $settings = Settings::first();
          $buscar = DB::table($settings->prefijo_wp.'users')
                        ->where('user_nicename', '=', $request->user_nicename)
                        ->first();
                           
                            
            if($buscar == null){
        return redirect('mioficina/admin/gestion/gestionperfiles')->with('msj2', 'El usuario no se encuentra registrado');
            }
                
             if($buscar != null){   
                 $settings = Settings::first();
                  $buscar = DB::table($settings->prefijo_wp.'users')
                    ->where('user_nicename', '=', $request->user_nicename)
                    ->get();  
       
            }
             return view('gestion.encontrado')->with(compact('buscar'));
    }
    
    	public function encontrado()
    {
        return view('gestion.encontrado');
    }
    
    //ingresos de dicho usuario
    public function ingresos($id)
    {
        
        view()->share('title', 'Revenue View');
        $yo =  Crypt::decrypt($id);
 
 
  $comision = DB::table('commissions')
                            ->where('user_id', '=', $yo)
                            ->get();
 
        return view('gestion.ingresos-valor')->with(compact('comision'));
    }
    
    public function ingresos_valor()
    {
       
         return view('gestion.ingresos-valor');
    }
    
    //referidos de dicho usuario
    public function referidos($id)
    {
        
        view()->share('title', 'Live View');
        $yo =  Crypt::decrypt($id);
 
        $settings = Settings::first();
  $referidos = DB::table($settings->prefijo_wp.'users')
                            ->where('referred_id', '=', $yo)
                            ->get();
                            
 
        return view('gestion.directos')->with(compact('referidos'));
    }
    
    public function directos()
    {
       
         return view('gestion.directos');
    }
    
    //billetera de dicho usuario
    public function wallet($id)
    {
        
        view()->share('title', 'Wallet View');
        $yo =  Crypt::decrypt($id);
 
 
  $billetera = DB::table('walletlog')
                            ->where('iduser', '=', $yo)
                            ->get();
                            
 
        return view('gestion.billetera')->with(compact('billetera'));
    }
    
    public function billetera()
    {
       
         return view('gestion.billetera');
    }
    
    //pagos de dicho usuario
    public function pago($id)
    {
        
        view()->share('title', 'Liberated View');
        $yo =  Crypt::decrypt($id);
 
 
  $pago = DB::table('pagos')
                            ->where('iduser', '=', $yo)
                            ->where('estado', '=', 1)
                            ->get();
                            
 
        return view('gestion.liberado')->with(compact('pago'));
    }
    
    public function liberado()
    {
       
         return view('gestion.liberado');
    }
    
    //ingresos detallados
     public function ingresos_detallado()
    {
        	view()->share('title', 'Detailed Income');
       $comision = DB::table('commissions')
                            ->where('user_id', '=', Auth::user()->ID)
                            ->where('total', '!=', 0)
                            ->get();
 
        return view('gestion.ingresos-detallados')->with(compact('comision'));
         
    }
}