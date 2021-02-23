<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Rol;
use App\User;
use App\Monedas;
use App\Permiso;
use App\Settings;
use App\Formulario;
use App\MetodoPago;
use App\SettingsRol;
use App\SettingCorreo;
use App\SettingCliente;
use App\OpcionesSelect;
use App\SettingsComision;
use App\SettingActivacion;
use App\SettingsEstructura;
use Carbon\Carbon;


class SettingController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Setting'); 
	}
	
	// Confi Sistema
	/**
	 * Dirige a la vista del Configuraciones del Sistema
	 * 
	 * @access public
	 * @return view
	 */
	public function indexLogo(){
		
		
	    return view ('setting.logo');
	}
	
	/**
	 * Actualiza el Logo del sistema
	 * 
	 * @access public
	 * @param request $datos - El nuevo logo
	 * @return view
	 */
	public function saveLogo(Request $datos){
	    if(!empty($datos->file('logo'))){
	        $archivo = $_FILES['logo'];
            $rutadirectorio = public_path()."/assets/img";
            $rutaarchivo = public_path()."/assets/img/logo-light.png";
            if (!is_dir($rutadirectorio)) {
                mkdir($rutadirectorio, 0700, true);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            } else {
                unlink($rutaarchivo);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            }
            
            if($movido){
                return redirect('mioficina/admin/settings/sistema')->with('msj', 'Logo Updated Successfully');
            }
	    }else{
	        return redirect('mioficina/admin/settings/sistema');
	    }
	}

	/**
	 * Actualiza el Favicon del sistema
	 * 
	 * @access public
	 * @param request $datos - El nuevo Favicon
	 * @return view
	 */
	public function savefavicon(Request $datos){
	    if(!empty($datos->file('favicon'))){
	        $archivo = $_FILES['favicon'];
            $rutadirectorio = public_path();
            $rutaarchivo = public_path()."/favicon.ico";
            if (!is_dir($rutadirectorio)) {
                mkdir($rutadirectorio, 0700, true);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            } else {
                unlink($rutaarchivo);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            }
            
            if($movido){
                return redirect('mioficina/admin/settings/sistema')->with('msj', 'Favicon Updated Successfully');
            }
	    }else{
	        return redirect('mioficina/admin/settings/sistema');
	    }
	}

	/**
	 * Actualiza el Nombre del sistema
	 * 
	 * @access public
	 * @param request $datos - El nuevo nombre
	 * @return view
	 */
	public function updateName(Request $datos){
	    if(!empty($datos)){
	        DB::table('settings')
	            ->where('id', 1)
				->update(['name' => $datos->namesystem, 'name_styled' => $datos->namesystem, 'edad_minino' => $datos->edad_minima]);
	        return redirect('mioficina/admin/settings/sistema')->with('msj', 'System Name and Minimum Age Successfully Updated');
	    }else{
	        return redirect('mioficina/admin/settings/sistema');
	    }
	}

	/**
	 * Actualiza el valor de la rentabilidad
	 * 
	 * @access public
	 * @param request $datos - El nuevo nombre
	 * @return view
	 */
	public function updateRentabilidad(Request $datos){
	    if(!empty($datos)){
	        DB::table('settings')
	            ->where('id', 1)
				->update(['valorrentabilidad' => $datos->newvalor]);
	        return redirect()->back()->with('msj', 'Updated return value');
	    }else{
	        return redirect()->back();
	    }
	}

	/**
	 * Actualiza el valor de tantech 
	 * 
	 * @access public
	 * @param request $datos - El nuevo nombre
	 * @return view
	 */
	public function updateTantech(Request $datos){
	    if(!empty($datos)){
	        DB::table('settings')
	            ->where('id', 1)
				->update(['valortantech' => $datos->newvalor]);
	        return redirect()->back()->with('msj', 'Updated Value');
	    }else{
	        return redirect()->back();
	    }
	}

	/**
	 * Permite guardar el valor de los niveles 
	 *
	 * @param Request $datos
	 * @return void
	 */
	public function updateValorNiveles(Request $datos)
	{
		if (!empty($datos)) {
			DB::table('settings')
				->where('id', 1)
				->update(['valor_niveles' => json_encode($datos->all())]);
			
			return redirect()->back()->with('msj', 'Updated Value');
		}else{
			return redirect()->back();
		}
	}

	// Fin Confi Sistema
	
	// Confi Formulario
	/**
	 * Dirige a la vista de configuración de formularios
	 * 
	 * @access public
	 * @return view
	 */
	public function indexFormulario(){
	   $formulario = Formulario::all();
	   return view('setting.formulario')->with(compact('formulario'));
	}
	
	/**
	 * Guarda el nuevo campo para el formulario
	 * 
	 * @access public
	 * @param request $datos - los datos del campo nuevo
	 * @return view
	 */
	public function saveForm(Request $datos){
	   if(!empty($datos)){
	       $valide = $datos->validate([
	        'label' => 'required|string',
            'nameinput' => 'required|string|unique:formulario',
	        ]);
    	   if($valide){
    	       $formulario = Formulario::create([
    	        'label' => $datos->label,
    	        'nameinput' => $datos->nameinput,
    	        'estado' => 1,
    	        'requerido' => (!empty($datos->requerido)) ? $datos->requerido : 0,
    	        'unico' => (!empty($datos->unico)) ? $datos->unico : 0,
    	        'input_edad' => (!empty($datos->edad)) ? $datos->edad : 0,
    	        'tipo' => $datos->tipo_campo, 
    	        'min'=> (!empty($datos->min)) ? $datos->min : 0,
    	        'max'=> (!empty($datos->max)) ? $datos->max : 0,
    	        'desactivable'=> $datos->desactivable,
    	       ]);
    	       if($formulario && $datos->tipo_campo == 'select'){
    	           $data = [
    	               'idselect' => $formulario->id,
    	               'opciones' => $datos->valores
    	               ];
    	           $this->addOptionSelect($data);
    	       }
    	       $this->addColumnTable($datos);
			   return redirect('mioficina/admin/settings/formulario')->with('msj', 'The field '.$formulario->nameinput.' was successfully added');
    	   }
	   }else{
	       return redirect('mioficina/admin/settings/formulario');
	   }
	}
	/**
	 * Guarda los valores del campo select del formulario
	 * 
	 * @access private 
	 * @param array $opciones - los valores del campo mas el id al que pertenece
	 */
	private function addOptionSelect($opciones){
	    
	   $valores = explode(',', $opciones['opciones']);
	   for($i = 0; $i < count($valores); $i++){
	       OpcionesSelect::create([
    	    'idselect' => $opciones['idselect'],
    	    'valor' => $valores[$i],
    	   ]);
	   }
	}
	
	/**
	 * Crea el nuevo campo en la tabla correspondiente
	 * 
	 * permite crear el campo nuevo en la tabla user_campo con los atributos correspondiente para ese campo
	 * 
	 * @access private
	 * @param array $datos - los valores para crear el campo
	 */
	private function addColumnTable($datos){
	 $sql = 'ALTER TABLE user_campo ADD '.$datos->nameinput;
	 switch($datos->tipo_campo){
	     case 'number':
	            $sql = $sql.' float';
	            break;
    	 case 'date':
	            $sql = $sql.' date';
	            break;
	     case 'datetime':
	            $sql = $sql.' timestamp';
	            break;
	     default:
	            $sql = $sql.' varchar (250)';
	            break;
	 }
	 if ($datos->desactivable == 0){
	     $sql = $sql.' not null';
	 }
	 DB::statement($sql);
	}
	
	/**
	 * Actualiza el estado de un campo especifico
	 * 
	 * @access public
	 * @param int $id - id del campo, int $estado - estado al que se va a actualizar
	 * @return view
	 */
	public function statusField($id, $estado){
	    if (!empty($id)){
	        Formulario::where('id', $id)->update(['estado' => $estado]);
	        $formulario = Formulario::find($id);
			return redirect('mioficina/admin/settings/formulario')->with('msj', 'The Field '.$formulario->nameinput.' Was Updated Successfully');
	    }else{
	       return redirect('mioficina/admin/settings/formulario');
	   }
	}
	/**
	 * Busca la informacion un campo para ser modificada
	 * 
	 * @access public
	 * @param int $id - id del campo a buscar
	 * @return json
	 */
	public function getForm($id)
	{
		$formulario = Formulario::find($id);
		return json_encode($formulario->toArray());
	}

	/**
	 * Actualiza la informacion de los campos del formulario
	 * 
	 * @access public
	 * @param request $datos - datos nuevos
	 * @return view
	 */
	public function updateForm(Request $datos)
	{
		if(!empty($datos)){
			$valide = $datos->validate([
			 'label' => 'required|string',
			 ]);
			if($valide){
				$formulario = Formulario::where('id', $datos->id)->update([
					'label' => $datos->label,
					'requerido' => (!empty($datos->requerido)) ? $datos->requerido : 0,
					'unico' => (!empty($datos->unico)) ? $datos->unico : 0,
					'input_edad' => (!empty($datos->edad)) ? $datos->edad : 0,
					'min'=> (!empty($datos->min)) ? $datos->min : 0,
					'max'=> (!empty($datos->max)) ? $datos->max : 0,
				]);
				if($formulario && $datos->tipo_campo == 'select'){ 
					$data = [
						'idselect' => $datos->id,
						'opciones' => $datos->valores
						];
					//$this->addOptionSelect($data);
				}
				return redirect('mioficina/admin/settings/formulario')->with('msj', 'The Field '.$datos->label.' Was Updated Successfully');
			}
		}
	}

	public function deleteForm($id)
	{
		$formulario = Formulario::find($id);
		$sql = "ALTER TABLE user_campo DROP ".$formulario->nameinput;
		DB::statement($sql);
		$formulario->delete();
	}

	/**
	 * Actualiza los terminos y condiciones del sistema
	 * 
	 * @access public
	 * @param request $datos - El nuevo terminos y condiciones
	 * @return view
	 */
	public function terminos(Request $datos){
	    if(!empty($datos->file('terminos'))){
	        $archivo = $_FILES['terminos'];
            $rutadirectorio = public_path()."/assets";
            $rutaarchivo = public_path()."/assets/terminosycondiciones.pdf";
            if (!is_dir($rutadirectorio)) {
                mkdir($rutadirectorio, 0700, true);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            } else {
                unlink($rutaarchivo);
                $movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
            }
            if($movido){
                return redirect('mioficina/admin/settings/formulario')->with('msj', 'New Terms and Conditions');
            }
	    }else{
	        return redirect('mioficina/admin/settings/formulario');
	    }
	}
	//Fin Confi Formulario
	
	// Confi comisiones
	/**
	 * Dirige a la vista de configuracion de comisiones
	 * 
	 * @access public
	 * @return view
	 */
	public function indexComisiones(){
	   $settingComision = SettingsComision::find(1);
	   if (!empty($settingComision)) {
		$settingComision->valordetallado = json_decode($settingComision->valordetallado);
	   }
	   return view('setting.comisiones')->with(compact('settingComision'));
	}

	/**
	 * Obtiene todos los rangos del sistema registrado
	 * 
	 * @access public
	 * @return json
	 */
	public function allRangos(){
		
		$roles = Rol::select('id', 'name')->where('name', '!=', '')->get();
		return json_encode($roles);
	 }

	/**
	 * Obtiene todos los productos del sistema registrado
	 *
	 * @return json
	 */
	public function allProductos(){
		$settings = Settings::first();
		$productos = DB::table($settings->prefijo_wp.'posts')->select('ID')->where('post_type', 'product')->orderBy('ID')->get();
		return json_encode($productos);
	 }
	
	/**
	 * Guarda las configuraciones de las comisiones
	 * 
	 * @access public
	 * @param request $datos - los datos de la configuracion de la comision
	 */
	public function saveSettingComision(Request $datos){
	    if(!empty($datos)){
			$detallado = '';
			$general = 0;
	        if ($datos->tipocomision == 'general') {
				$general = $datos->valorgeneral;
			} else {
				$detallado = $this->toJson($datos, $datos->tipocomision);
			}
	        if($datos->tipopago == 'porcentaje'){
	            $general = $datos->valorgeneral / 100;
	        }
	        if($datos->id){
	            SettingsComision::where('id', $datos->id)->update([
	            'niveles' => $datos->niveles,
	            'tipocomision' => $datos->tipocomision,
	            'valorgeneral' => (!empty($general)) ? $general : 0,
	            'valordetallado' => (!empty($detallado)) ? $detallado : '',
	            'tipopago' => $datos->tipopago,
	            ]);
	        }else{
	            SettingsComision::create([
	            'niveles' => $datos->niveles,
	            'tipocomision' => $datos->tipocomision,
	            'valorgeneral' => (!empty($datos->valorgeneral)) ? $datos->valorgeneral : 0,
	            'valordetallado' => (!empty($detallado)) ? $detallado : '',
	            'tipopago' => $datos->tipopago,
	            ]);
	        }
	        return redirect('mioficina/admin/settings/comisiones')->with('msj', 'New Commission Process');
	    }else{
	        return redirect('mioficina/admin/settings/comisiones');
	    }
	}
	
	/**
	 * Convierte los valores a arreglo
	 * 
	 * Pasa de un arreglo cuando las comisiones son detalladas a un json para que se puedan guardar
	 * 
	 * @access private 
	 * @param array $datos - valores a pasar a cadena
	 * @param string $tipo - el tipo de comision
	 * @return json
	 */
	private function toJson($datos, $tipo){
	    $stringJson = [];
	    if ($tipo == 'detallado') {
			for ($i = 1; $i < ($datos->niveles + 1); $i++){
				if($datos->tipopago == 'porcentaje'){
					array_push($stringJson, [
					'nivel'.$i => ($datos['nivel'.$i] / 100)
					]);
				}else{
					array_push($stringJson, [
					'nivel'.$i => (int) $datos['nivel'.$i]
					]);
				}
			}
		} elseif($tipo == 'categoria') {
			for ($i=1; $i < ($datos->niveles + 1); $i++) {
				$cantRol = Rol::all()->count('id');
				$tmparray = [];
				for ($j=0; $j < $cantRol; $j++) {
					$rol = Rol::find($j);
					if($datos->tipopago == 'porcentaje'){
						array_push($tmparray, [
						'idrango' => $j,
						'nombre' => $rol->name,
						'comision' => ($datos['idrango'.$j.'_'.$i] / 100)
						]);
					}else{
						array_push($tmparray, [
						'idrango' => $j,
						'nombre' => $rol->name,
						'comision' => (int) $datos['idrango'.$j.'_'.$i]
						]);
					}	
				}
				array_push($stringJson, [
					'id' => $i,
					'nombre' => $datos['categoria'.$i],
					'comisiones' => $tmparray
				]);
			}
		}else{
			$settings = Settings::first();
			$productos = DB::table($settings->prefijo_wp.'posts')->select('ID')->where('post_type', 'product')->orderBy('ID')->get();

			foreach ($productos as $item ) {
				$tmparray = [];
				for ($i=1; $i < ($datos->niveles + 1); $i++) {
					if($datos->tipopago == 'porcentaje'){
						array_push($tmparray, [
						'nivel' => $i,
						'comision' => ($datos['idproducto'.$item->ID.'_'.$i] / 100),
						]);
					}else{
						array_push($tmparray, [
						'nivel' => $i,
						'comision' => (int) $datos['idproducto'.$item->ID.'_'.$i],
						]);
					}
				}
				array_push($stringJson, [
					'idproductos' => $item->ID,
					'comisiones' => $tmparray
				]);
			}
		}
		
	   return json_encode($stringJson);
	}

	/**
	 * permite actualizar el bono de activacion
	 * 
	 * @return view
	 */
	public function saveBono(Request $datos)
	{
		SettingsComision::where('id', 1)->update([
			'bonoactivacion' => $datos->bono,
			'directos' => $datos->recibir
		]);
		return redirect('mioficina/admin/settings/comisiones')->with('msj', 'Activation Bonus Updated');
	}

	/**
	 * permite actualizar el bono de activacion
	 * 
	 * @return view
	 */
	public function savePrimera_compra(Request $datos)
	{
		SettingsComision::where('id', 1)->update(['primera_compra' => $datos->primera_compra]);
		return redirect('mioficina/admin/settings/comisiones')->with('msj', 'Commission on First Purchase Updated');
	}

	/**
	 * Agrega los productos que no quieren que generen comision
	 */
	public function saveProducto(Request $datos)
	{
		$validate = $datos->validate([
			'idproducto' => 'required'
		]);
		if ($validate) {
			$settings = Settings::first();
			$tmp;
			if ($settings->id_no_comision == '') {
				$tmp = $datos->idproducto;
			}else{
				$tmp = $settings->id_no_comision.", ".$datos->idproducto;
			}
			$settings->id_no_comision = $tmp;
			$settings->save();
			return redirect('mioficina/admin/settings/comisiones')->with('msj', 'Product Id '.$datos->idproducto.' successfully added');
		}
	}

	public function deleteProducto(Request $datos)
	{
		$settings = Settings::first();
		$tmp;
		if (strpos($settings->id_no_comision, ',') !== false) {
			$array = explode(', ', $settings->id_no_comision);
			
			$cont = 0;
			foreach ($array as $item) {
				if ($item != $datos->idproducto_elimanar) {
					if ($cont == 0) {
						$tmp = $item;
					}else{
						$tmp = $tmp.", ".$item;
					}
				}
				$cont++;
			}
		} else {
			$tmp = "";
		}
		
		$settings->id_no_comision = $tmp;
		$settings->save();
		return redirect('mioficina/admin/settings/comisiones')->with('msj', 'Product Id '.$datos->idproducto_elimanar.' successfully removed');
	}
	// Fin Confi Comisiones
	
	// Confi Estructura

	/**
	 * Dirige a la vista de configuraciones de la estructura
	 * 
	 * @access public
	 * @return view
	 */
	public function indexEstructura(){
	    
		$settingEstructura = SettingsEstructura::find(1);
		$settingCliente = SettingCliente::find(1);
	    return view('setting.estructura')->with(compact('settingEstructura', 'settingCliente'));
	}
	
	/**
	 * guarda los datos de los estructura del sistema
	 * 
	 * @access public 
	 * @param request $datos - los datos de la estructura
	 * @return view
	 */
	public function saveEstructura(Request $datos){
	    if(!empty($datos)){
	        if($datos->id){
	            SettingsEstructura::where('id', $datos->id)->update([
	                'tipoestructura' => $datos->tipoestrutura,
	                'cantnivel'  => $datos->cantnivel,
	                'cantfilas'  => (!empty($datos->cantfila)) ? $datos->cantfila : 0, 
	                'estructuraprincipal'  => (!empty($datos->estruprincipal)) ? $datos->estruprincipal : 0,
	                'usuarioprincipal'  => (!empty($datos->userprincipal)) ? $datos->userprincipal : 0,
	            ]);
	        }else{
	            SettingsEstructura::create([
	                'tipoestructura' => $datos->tipoestrutura,
	                'cantnivel'  => $datos->cantnivel,
	                'cantfilas'  => (!empty($datos->cantfila)) ? $datos->cantfila : 0, 
	                'estructuraprincipal'  => (!empty($datos->estruprincipal)) ? $datos->estruprincipal : 0,
	                'usuarioprincipal'  => (!empty($datos->userprincipal)) ? $datos->userprincipal : 0,
	            ]);
			}
			DB::table('settingcliente')
			->where('id', 1)
			->update([
				'cliente' => (!empty($datos->cliente)) ? $datos->cliente : 0, 
				'permiso' => (!empty($datos->permiso)) ? $datos->permiso : 0
				]);
	        $this->resetSystem();
	        return redirect('mioficina/admin/settings/estructura')->with('msj', 'New Structure Defined');
	    }
	}

	/**
	 * Reinicia el sistema cuando se cambia la estructura
	 * 
	 * Borra toda la informacion de guardada en el sistema para la nueva estructura creada
	 * 
	 */
	 public function resetSystem(){
		$settings = Settings::first();
		DB::table($settings->prefijo_wp.'users')->where('ID', '!=', 1)->delete();
		DB::table($settings->prefijo_wp.'users')->where('ID', '=', 1)->update([
			'wallet_amount' => 0, 
			'puntos' => 0, 
		]);
		$sql = 'ALTER TABLE '.$settings->prefijo_wp.'users AUTO_INCREMENT = 2';
		DB::statement($sql);
		DB::table('user_campo')->where('ID', '!=', 1)->delete();
		DB::table('walletlog')->delete();
		DB::table('fichas')->delete();
		DB::table('fichasinactivas')->delete();
		DB::table('archivos')->delete();
		DB::table('comentarios')->delete();
		DB::table('contenidos')->delete();
		DB::table('notes')->delete();
		DB::table('pagos')->delete();
		DB::table('sesions')->delete();
		DB::table('tickets')->delete();
	    DB::table('liquidaciones')->delete();
		DB::table('commissions')->delete();
		return redirect('mioficina/admin')->with('msj', 'System Restarted');
	}
	//Fin Confi Estructura

	// Confi Rangos
	/**
	 * Dirige a la vista de Configuracion de Rangos
	 * 
	 * @access public
	 * @return view
	 */
	public function indexRango()
	{
		$settingRol = SettingsRol::find(1);
		$rangos = Rol::all();
		$settingsEstructura = SettingsEstructura::find(1);
		$cantnivel = $settingsEstructura->cantnivel;
		return view("setting.rango")->with(compact('settingRol', 'rangos', 'cantnivel'));
	}
	
	/**
	 * Recibe la informacion a guardar 
	 * 
	 * Recibe de las configuracion de los rangos y la envia a sus funciones respectiva
	 * @access public
	 * @return view
	 */
	public function saveRangos(Request $datos)
	{
		if (!empty($datos)) {
			$this->saveConfiguracionRango($datos);
			$this->recorridoRol($datos);
			return redirect('mioficina/admin/settings/rangos')->with('msj', 'New Defined Range System');
		} else {
			return redirect('mioficina/admin/settings/rangos');
		}
	}

	/**
	 * Recibe la informacion de los rangos
	 * 
	 * Recibe la configuracion de los rangos y la guarda o actualizada dado el caso
	 * @access private
	 * @param array $datos - los datos de la configuracion
	 */
	private function saveConfiguracionRango($datos)
	{
		if(!empty($datos['idsetrol'])){
			SettingsRol::where('id', $datos['idsetrol'])->update([
				'rangos' => $datos->cantrango,
				'compras' => (!empty($datos->s_personal)) ? $datos->s_personal : 0,
				'comisiones' => (!empty($datos->s_comisiones)) ? $datos->s_comisiones : 0,
				'niveles' => (!empty($datos->s_nivel)) ? $datos->s_nivel : 0,
				'referidos' => (!empty($datos->s_referido)) ? $datos->s_referido : 0,
				'referidosact' => (!empty($datos->s_referidoact)) ? $datos->s_referidoact : 0,
				'bonos' => (!empty($datos->s_bono)) ? $datos->s_bono : 0,
				'referidosd' => (!empty($datos->s_referidoD)) ? $datos->s_referidoD : 0,
				'grupal' => (!empty($datos->s_grupal)) ? $datos->s_grupal : 0,
				'valorpuntos' => (!empty($datos->valorpuntos)) ? $datos->valorpuntos : 0
			]);
		}else{
			SettingsRol::create([
				'rangos' => $datos->cantrango,
				'compras' => (!empty($datos->s_personal)) ? $datos->s_personal : 0,
				'comisiones' => (!empty($datos->s_comisiones)) ? $datos->s_comisiones : 0,
				'niveles' => (!empty($datos->s_nivel)) ? $datos->s_nivel : 0,
				'referidos' => (!empty($datos->s_referido)) ? $datos->s_referido : 0,
				'referidosact' => (!empty($datos->s_referidoact)) ? $datos->s_referidoact : 0,
				'bonos' => (!empty($datos->s_bono)) ? $datos->s_bono : 0,
				'referidosd' => (!empty($datos->s_referidoD)) ? $datos->s_referidoD : 0,
				'grupal' => (!empty($datos->s_grupal)) ? $datos->s_grupal : 0,
				'valorpuntos' => (!empty($datos->valorpuntos)) ? $datos->valorpuntos : 0
			]);
		}
	}

	/**
	 * Recorre los roles a guardar 
	 * 
	 * Recorre los roles y obtiene la informacion necesaria de lo que se va a guardar
	 * 
	 * @access private
	 * @param array
	 */
	private function recorridoRol($datos)
	{
		DB::table('roles')->delete();
		DB::table('roles')->insert([
			'id' => 0, 
			'name' => 'Administrador',
		]);
		for ($i=1; $i < ($datos->cantrango + 1) ; $i++) { 
			$arretmp = [
				'id' => $i,
				'name' => $datos['nombrerango'.$i],
				'referidos' => (!empty($datos['cantrefe'.$i])) ? $datos['cantrefe'.$i] : 0,
				'refeact' => (!empty($datos['cantrefeact'.$i])) ? $datos['cantrefeact'.$i] : 0,
				'referidosd' => (!empty($datos['cantrefed'.$i])) ? $datos['cantrefed'.$i] : 0,
				'compras' => (!empty($datos['totalpunto'.$i])) ? $datos['totalpunto'.$i] : 0,
				'grupal' => (!empty($datos['totalpuntoG'.$i])) ? $datos['totalpuntoG'.$i] : 0,
				'comisiones' => (!empty($datos['totalcomi'.$i])) ? $datos['totalcomi'.$i] : 0,
				'bonos' => (!empty($datos['totalbono'.$i])) ? $datos['totalbono'.$i] : 0,
				'niveles' => (!empty($datos['nivelafec'.$i])) ? $datos['nivelafec'.$i] : 0,
				'rolprevio' => (!empty($datos['rangoprevio'.$i])) ? $datos['rangoprevio'.$i] : 0,
				'acepta_comision' => (!empty($datos['p_cobrar_comision'.$i])) ? $datos['p_cobrar_comision'.$i] : 0
			];
			$this->saveRol($arretmp);
		}
	}

	/**
	 * Guarda los roles una vez limpio 
	 * 
	 * Guarda los roles una vez que ya esten limpio y sin informacion basura
	 * @access private
	 * @param array $datos - informacion de rol a guardar
	 */
	private function saveRol($datos)
	{
		Rol::create([
			'id' => $datos['id'],
			'name' => $datos['name'],
			'referidos' => $datos['referidos'],
			'refeact' => $datos['refeact'],
			'referidosd' => $datos['referidosd'],
			'compras' => $datos['compras'],
			'grupal' => $datos['grupal'],
			'comisiones' => $datos['comisiones'],
			'bonos' => $datos['bonos'],
			'niveles' => $datos['niveles'],
			'rolprevio' => $datos['rolprevio'],
			'acepta_comision' => $datos['acepta_comision']
		]);
	}
	//Fin Confi Rangos

	// Confi Metodos Pagos
	/**
	 * Dirige a la vista de configuraciones de metodos de pago
	 * 
	 * @access public
	 * @return view
	 */
	public function indexPago()
	{
		$metodospagos = MetodoPago::all();
		$comisiones = SettingsComision::select('comisiontransf')->where('id', 1)->get();
		return view('setting.metodopago')->with(compact('metodospagos', 'comisiones'));
	}

	/**
	 * Guarda la configuracion de los pagos en el sistema
	 * 
	 * @access public
	 * @param request $datos - datos de la configuracion
	 * @return view
	 */
	public function savePagos(Request $datos)
	{
		$logoruta = '';
		$fecha = new Carbon;
		if(!empty($datos)){
			if (!empty($datos->file('logo'))) {
				$archivo = $_FILES['logo'];
				$rutadirectorio = public_path()."/assets/img/metodopago";
				$rutaarchivo = public_path()."/assets/img/metodopago/".$fecha->now().$archivo['name'];
				if (!is_dir($rutadirectorio)) {
					mkdir($rutadirectorio, 0700, true);
					$movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
				} else {
					if (is_dir($rutaarchivo)) {
						unlink($rutaarchivo);
					}
					$movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
				}
				
				if($movido){
					$logoruta = "/assets/img/metodopago/".$fecha->now().$archivo['name'];
				}
			}
			$feed = $datos->feed;
			if ($datos->tipofeed == 1) {
				$feed = ($datos->feed / 100);
			}
			MetodoPago::create([
				'nombre' => $datos->nombre,
				'logo' => (!empty($logoruta)) ? $logoruta : '',
				'feed' => $feed,
				'monto_min' => (!empty($datos->monto_min)) ? $datos->monto_min : 0,
				'tipofeed' => $datos->tipofeed,
				'estado' => 1,
				'wallet' => (!empty($datos->wallet)) ? $datos->wallet : 0,
				'correo' => (!empty($datos->correo)) ? $datos->correo : 0,
				'datosbancarios' => (!empty($datos->bancario)) ? $datos->bancario : 0,
			]);
			return redirect('mioficina/admin/settings/pagos')->with('msj', 'New Aggregate Payment Method');
		}else{
			return redirect('mioficina/admin/settings/pagos');
		}
	}
	
	/**
	 * Guarda las Comisiones de los metodos de pago 
	 * 
	 * @access public
	 * @param request
	 * @return view
	 */
	public function comisionMetodoPago(Request $datos)
	{
	    if(!empty($datos)){
	        $comisionMP = SettingsComision::find(1);
	        $comisionMP->comisionretiro = (!empty($datos->retiro)) ? $datos->retiro : 0;
	        $comisionMP->comisiontransf = (!empty($datos->transferencia)) ? $datos->transferencia : 0;
	        $comisionMP->save();
	        return redirect('mioficina/admin/settings/pagos')->with('msj', 'Updated Commissions');
	    }else{
	        return redirect('mioficina/admin/settings/pagos');
	    }
	}

	/**
	 * Actualiza el estado de un metodo de pago especifico
	 * 
	 * @access public
	 * @param int $id - id del campo, int $estado - estado al que se va a actualizar
	 * @return view
	 */
	public function statusPago($id, $estado){
	    if (!empty($id)){
	        MetodoPago::where('id', $id)->update(['estado' => $estado]);
	        $metodopago = MetodoPago::find($id);
			return redirect('mioficina/admin/settings/pagos')->with('msj', 'The '.$metodopago->nameinput.' Payment Method was Updated Successfully');
	    }else{
	       return redirect('mioficina/admin/settings/pagos');
	   }
	}

	/**
	 * Obtiene la informacion de un metodo de pago en especifico
	 * 
	 * @access public
	 * @param int $id - id del metodo de pago
	 * @return json
	 */
	public function getMetodo($id)
	{
		$metodo = MetodoPago::find($id);
		return json_encode($metodo);
	}

	/**
	 * Permite Actualizar la informacion de un metodo de pago ya registrado
	 * 
	 * @param request
	 * @return view
	 */
	public function updateMetodo(Request $datos)
	{
		$logoruta = '';
		$fecha = new Carbon;
		if (!empty($datos)) {
			if (!empty($datos->file('logo'))) {
				$archivo = $_FILES['logo'];
				$rutadirectorio = public_path()."/assets/img/metodopago";
				$rutaarchivo = public_path()."/assets/img/metodopago/".$fecha->now().$archivo['name'];
				if (!is_dir($rutadirectorio)) {
					mkdir($rutadirectorio, 0700, true);
					$movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
				} else {
					if (is_dir($rutaarchivo)) {
						unlink($rutaarchivo);
					}
					$movido = move_uploaded_file($archivo['tmp_name'], $rutaarchivo);
				}
				
				if($movido){
					$logoruta = "/assets/img/metodopago/".$fecha->now().$archivo['name'];
				}
			}
			$feed = $datos->feed;
			if ($datos->tipofeed == 1) {
				$feed = ($datos->feed / 100);
			}
			$metodo = MetodoPago::find($datos->id);
			MetodoPago::where('id', $datos->id)->update([
				'nombre' => $datos->nombre,
				'logo' => (!empty($logoruta)) ? $logoruta : $metodo->logo,
				'feed' => $feed,
				'monto_min' => (!empty($datos->monto_min)) ? $datos->monto_min : 0,
				'tipofeed' => $datos->tipofeed,
				'estado' => 1,
				'wallet' => (!empty($datos->wallet)) ? $datos->wallet : 0,
				'correo' => (!empty($datos->correo)) ? $datos->correo : 0,
				'datosbancarios' => (!empty($datos->bancario)) ? $datos->bancario : 0,
			]);
			return redirect('mioficina/admin/settings/pagos')->with('msj', 'Updated Payment Method');
		}else{
			return redirect('mioficina/admin/settings/pagos');
		}
	}

	/**
	 * permite borrar un metodo de pago en especifico
	 * 
	 * @access public
	 * @param int $id - id del metodo de pago
	 */
	public function deleteMetodo($id)
	{
		$formulario = MetodoPago::find($id);
		$formulario->delete();
	}
	// Fin Confi Metodos Pago

	// Confi Plantilla de Correo
	/**
	 * Vista de para la configuracion de la plantilla
	 * 
	 * @access public
	 * @return view
	 */
	public function indexPlantilla()
	{
		$plantillaB = SettingCorreo::find(1);
		$plantillaP = SettingCorreo::find(2);
		return view('setting.plantilla')->with(compact('plantillaB', 'plantillaP'));
	}

	/**
	 * Guarda la informacion de las plantillas
	 * 
	 * @access public
	 * @param request $datos - Datos de la plantilla
	 * @return view
	 */
	public function savePlantilla(Request $datos)
	{
		if (!empty($datos)) {
			if ($datos->plantilla == 'bienvenida') {
				$this->plantillaBienvenida($datos);
			} else {
				$this->plantillaPago($datos);
			}
			return redirect('mioficina/admin/settings/plantilla')->with('msj', $datos->plantilla.' Mail Template has been updated');
		} else {
			return redirect('mioficina/admin/settings/plantilla');
		}
	}

	/**
	 * Guarda la informacion de la plantilla de bienvenida
	 * 
	 * @access private
	 * @param array $datos - plantilla de bienvenida
	 */
	private function plantillaBienvenida($datos){
		if (!empty($datos->idplantilla)) {
			SettingCorreo::where('id', $datos->idplantilla)->update([
				'titulo' => $datos->titulo,
				'contenido' => $datos->correo
			]);
		}else{
			SettingCorreo::create([
				'titulo' => $datos->titulo,
				'contenido' => $datos->correo
			]);
		}
	}

	/**
	 * Guarda la informacion de la plantilla de pago
	 * 
	 * @access private
	 * @param array $datos - plantilla de pago
	 */
	private function plantillaPago($datos)
	{
		if (!empty($datos->idplantilla)) {
			SettingCorreo::where('id', $datos->idplantilla)->update([
				'titulo' => $datos->titulo,
				'contenido' => $datos->correo
			]);
		}else{
			SettingCorreo::create([
				'titulo' => $datos->titulo,
				'contenido' => $datos->correo
			]);
		}
	}

	/**
	 * Permite Probar las Plantillas Creadas
	 * 
	 * @access public
	 * @param request $datos para la prueba del correo
	 * @return view
	 */
	public function probarPlantilla(Request $datos)
	{
		$plantilla = SettingCorreo::find($datos->idplantilla);
		if (!empty($plantilla->contenido)) {
			$mensaje = str_replace('@nombre', ' '.$datos->nombre.' ', $plantilla->contenido);
			$mensaje = str_replace('@clave', ' '.$datos->clave.' ', $mensaje);
			$mensaje = str_replace('@usuario', ' '.$datos->clave.' ', $mensaje);
			$mensaje = str_replace('@idpatrocinio', ' '.$datos->clave.' ', $mensaje);
			$mensaje = str_replace('@correo', ' '.$datos->correo.' ', $mensaje);
			Mail::send('emails.plantilla',  ['data' => $mensaje], function($msj) use ($plantilla, $datos){
				$msj->subject($plantilla->titulo);
				$msj->to($datos->correod); 
			});
			return redirect('mioficina/admin/settings/plantilla')->with('msj', 'Test performed');
		} else {
			return redirect('mioficina/admin/settings/plantilla');
		}
	}
	// Fin Confi Plantilla de Correo
	
	// Confi Permiso
	/**
	 * Lleva a la vista de configuración de permisos
	 * 
	 * @access public
	 * @return view
	 */
	public function indexPermisos()
	{
		$admins = User::where('rol_id', 0)->get();
		return view('setting.permisos')->with(compact('admins'));
	}

	/**
	 * permite agregar los nuevos usuarios admin
	 */
	public function saveAdmin(Request $datos)
	{
		$settings = Settings::first();
		$validatedData = $datos->validate([
            'user_email' => 'required|string|email|max:100|unique:'.$settings->prefijo_wp.'users',
        ]);
		if ($validatedData) {
			$user = User::create([
				'user_email' => $datos->user_email,
				'user_status' => 1,
				'user_login' => $datos->username,
				'user_nicename' => $datos->username,
				'display_name' => $datos->nombre,
				'user_pass' => md5($datos->clave),
				'password' => bcrypt($datos->clave),
				'clave' => encrypt($datos->clave),
				'referred_id' => 0,
				'status' => 1,
				'rol_id' => 0
			]);

			User::where('ID', $user->ID)->update(['rol_id' => 0]);
			Permiso::create([
				'iduser' => $user->ID,
				'nameuser' => $user->display_name,
				'nuevo_registro' => 0,
				'red_usuario' => 0,
				'vision_usuario' => 0,
				'billetera' => 0,
				'pago' => 0,
				'informes' => 0,
				'tickets' => 0,
				'buzon' => 0,
				'ranking' => 0,
				'historial_actividades' => 0,
				'email_marketing' => 0,
				'administrar_redes' => 0,
				'soporte' => 0,
				'ajuste' => 0,
				'herramienta' => 0,
			]);
			return redirect('mioficina/admin/settings/permisos')->with('msj', 'New Administrator');
		} else {
			# code...
		}	
	}

	/**
	 * Obtiene los permiso de un usuario admin en especifico
	 * 
	 * @access public
	 * @param int $id - id del usuario a buscar
	 * @return view
	 */
	public function getPermisos($id)
	{
		$user = User::find($id);
		$permiso = Permiso::where('iduser', $id)->get()->toArray();
		return view('setting.componentes.modalPermiso')->with(compact('permiso', 'user'));
	}

	/**
	 * Guarda los permisos de los usuarios
	 * 
	 * @access public
	 * @param request $datos - los permiso del usuario
	 * @return view
	 */
	public function savePermisos(Request $datos)
	{
		if (!empty($datos)) {
			if (!(empty($datos->id))) {
				Permiso::where('id', $datos->id)->update([
					'nuevo_registro' => $datos->nuevo_registro,
					'red_usuario' => $datos->red_usuario,
					'vision_usuario' => $datos->vision_usuario,
					'billetera' => $datos->billetera,
					'pago' => $datos->pago,
					'informes' => $datos->informes,
					'tickets' => $datos->tickets,
					'buzon' => $datos->buzon,
					'ranking' => $datos->ranking,
					'historial_actividades' => $datos->historial_actividades,
					'email_marketing' => $datos->email_marketing,
					'administrar_redes' => $datos->administrar_redes,
					'soporte' => $datos->soporte,
					'ajuste' => $datos->ajuste,
					'herramienta' => $datos->herramienta,
				]);
			} else {
				Permiso::create([
					'iduser' => $datos->iduser,
					'nameuser' => $datos->nameuser,
					'nuevo_registro' => $datos->nuevo_registro,
					'red_usuario' => $datos->red_usuario,
					'vision_usuario' => $datos->vision_usuario,
					'billetera' => $datos->billetera,
					'pago' => $datos->pago,
					'informes' => $datos->informes,
					'tickets' => $datos->tickets,
					'buzon' => $datos->buzon,
					'ranking' => $datos->ranking,
					'historial_actividades' => $datos->historial_actividades,
					'email_marketing' => $datos->email_marketing,
					'administrar_redes' => $datos->administrar_redes,
					'soporte' => $datos->soporte,
					'ajuste' => $datos->ajuste,
					'herramienta' => $datos->herramienta,
				]);
			}
				return redirect('mioficina/admin/settings/permisos')->with('msj', 'Updated '.$datos->nameuser.' User Permissions');
		} else {
			return redirect('mioficina/admin/settings/permisos');
		}
		
	}
	// Fin Confi Permiso

	// Confi Activacion
	/**
	 * Lleva a la vista de configuración de Activacion
	 * 
	 * @access public
	 * @return view
	 */
	public function indexActivacion()
	{
		$settingAct = SettingActivacion::find(1);
		return view('setting.activacion')->with(compact('settingAct'));
	}

	/**
	 * Permite Guarda la configuracion de la activacion
	 * 
	 * @access public
	 * @param request $datos - Datos de las activacion
	 * @return view
	 */
	public function saveActivacion(Request $datos)
	{
		if (!empty($datos)) {
			if (!empty($datos->id)) {
				SettingActivacion::where('id', $datos->id)->update([
					'tipoactivacion' => $datos->activacion, 
					'tiporecompra' => $datos->recompra, 
					'requisitoactivacion' => $datos->requisito_a, 
					'requisitorecompra' => $datos->requisito_r
				]);
			} else {
				SettingActivacion::create([
					'tipoactivacion' => $datos->activacion, 
					'tiporecompra' => $datos->recompra, 
					'requisitoactivacion' => $datos->requisito_a, 
					'requisitorecompra' => $datos->requisito_r
				]);
			}
			return redirect('mioficina/admin/settings/activacion')->with('msj', 'Activation Method Updated');
		}else{
			return redirect('mioficina/admin/settings/activacion');
		}
	}

	// Confi Moneda
	/**
	 * Lleva a la vista de configuración de monedas
	 * 
	 * @access public
	 * @return view
	 */
	public function indexMonedas()
	{
		$monedas = Monedas::all();
		$monedap = Monedas::where('principal', 1)->get()->first();
		return view('setting.monedas')->with(compact('monedas', 'monedap'));
	}

	/**
	 * Guarda las monedas con las que trabajara el sistema
	 * 
	 * @param request $datos - informacion de la moneda
	 * @return view
	 */
	public function saveMonedas(Request $datos)
	{
		$validate = $datos->validate([
			'nombre' => 'required',
			'simbolo' => 'required',
			'mostrar' => 'required'
		]);

		if ($validate) {
			Monedas::create([
				'nombre' => $datos->nombre,
				'simbolo' => $datos->simbolo,
				'mostrar_a_d' => $datos->mostrar,
				'principal' => 0
			]);

			return redirect('mioficina/admin/settings/monedas')->with('msj', $datos->nombre.' Currency Successfully Added');
		}
	}

	public function statusMoneda($id, $estado)
	{
		Monedas::where('principal', 1)->update(['principal' => 0]);
		if ($estado == 1) {
			Monedas::where('id', $id)->update(['principal' => $estado]);
		}
		$moneda = Monedas::find($id);
		return redirect('mioficina/admin/settings/monedas')->with('msj', $moneda->nombre.' Currency Successfully Updated');
	}

	public function deleteMoneda($id)
	{
		$moneda = Monedas::find($id);
		$nombre = $moneda->nombre;
		$moneda->delete();
		
		return redirect('mioficina/admin/settings/monedas')->with('msj', $nombre.' Currency Deleted Successfully');
	}
	//fin confi monedas
}


