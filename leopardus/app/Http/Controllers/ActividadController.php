<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Sesion;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;
use App\Http\Controllers\RangoController;

class ActividadController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Historial de Actividades');
	    Carbon::setLocale('es');
	}
	
		public function actividad()
	{
	     
	      $sesion = Sesion::orderBy('id','ASC')->paginate(10);
	      $settings = Settings::first();
	      $sql="SELECT c.*, wu.display_name FROM sesions c, ".$settings->prefijo_wp."users wu WHERE c.user_id=wu.ID order By  c.fecha ASC ";
        $sesion =DB::select($sql);
                return view('actividad.actividad', compact('sesion')); 
	    

	}
	

}