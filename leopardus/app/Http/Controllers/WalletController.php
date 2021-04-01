<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Wallet;
use App\MetodoPago;
use App\SettingsComision;
use App\Pagos;
use App\Monedas;
use App\Http\Controllers\ComisionesController;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\IndexController;
use App\OrdenInversion;
use App\Http\Controllers\LiquidationController;


class WalletController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Wallet');
	}
	
	/**
	 *  Va a la vista principal de la billetera cash
	 * 
	 * @access public
	 * @return view
	 */
	public function index(){
	   
		$moneda = Monedas::where('principal', 1)->get()->first();
		$metodopagos = MetodoPago::all();
		$comisiones = SettingsComision::select('comisionretiro', 'comisiontransf')->where('id', 1)->get();
		$cuentawallet = '';
		$pagosPendientes = false;
		$validarPagos = Pagos::where([
			['iduser', '=', Auth::user()->ID],
			['estado', '=', 0]
		])->first();
		if (!empty($validarPagos)) {
			$pagosPendientes = true;
		}
		$wallets = Wallet::where([
			['iduser', '=', Auth::user()->ID], 
			['debito', '>', 0],
		])->orWhere([
			['iduser', '=', Auth::user()->ID], 
			['credito', '>', 0]
			])->get();
		$cuentawallet = DB::table('user_campo')->where('ID', Auth::user()->ID)->select('paypal')->get()[0];
		$cuentawallet = $cuentawallet->paypal;
		$correoUser = DB::table('wp_users')->where('ID', Auth::user()->ID)->select('user_email')->first();
		
	   	return view('wallet.indexwallet')->with(compact('metodopagos', 'comisiones', 'wallets', 'moneda', 'cuentawallet', 'pagosPendientes', 'correoUser'));
	}

	/**
	 *  Va a la vista principal de la billetera de puntos
	 * 
	 * @access public
	 * @return view
	 */
	public function indexPoints(){
	   
		$wallets = DB::table('wallet_point')
				->where('iduser', Auth::user()->ID)
				->selectRaw('SUM(point_left) as izq, SUM(point_right) as der, status')
				->groupBy('status')->get();
		
	   	return view('wallet.indexwalletpuntos')->with(compact('wallets'));
	}
	
	/**
	 * Realizar Transferencia de un usuario a otro
	 * 
	 * @access public
	 * @param Request
	 * @return view
	 */
	public function transferencia(Request $datos){
	   
	   if(!empty($datos)){
	       $verificaruser = User::where('user_email', $datos->usuario)->get()->toArray();
	       if (empty($verificaruser)){
			   return redirect('mioficina/admin/wallet')->with('msj2', 'El correo '.$datos->usuario.' no esta registrado');
	       }else{
	           $resta = ($datos->monto - $datos->comision);
	           if($resta > 0){
	               if($resta < $datos->montodisponible){
	                   $userOrigen = User::find(Auth::user()->ID);
    	               $userDestino = User::find($verificaruser[0]['ID']);
    	               $userOrigen->wallet_amount = ($userOrigen->wallet_amount - $datos['monto']);
    	               $userDestino->wallet_amount = ($userOrigen->wallet_amount + $resta);
    	               $userOrigen->save();
    	               $userDestino->save();
    	               $datosOrigen = [
    	                   'iduser' => $userOrigen->ID,
    	                   'usuario' => $userOrigen->display_name,
    	                   'descripcion' => 'Transfer sent to '.$userDestino->display_name,
    	                   'descuento' => ($datos['monto'] - $resta),
						   'debito' => 0,
						   'puntos' => 0,
						   'puntosI' => 0,
						   'puntosD' => 0,
						   'credito' => $datos['monto'],
						   'tantechcoin' => 0,
						   'balance' => $userOrigen->wallet_amount,
						   'tipotransacion' => 0
    	               ];
    	               $datosDestino = [
    	                   'iduser' => $userDestino->ID,
    	                   'usuario' => $userDestino->display_name,
    	                   'descripcion' => 'Transfer received from '.$userOrigen->display_name,
    	                   'descuento' => 0,
						   'debito' => $resta,
						   'puntos' => 0,
						   'puntosI' => 0,
						   'puntosD' => 0,
						   'credito' => 0,
						   'tantechcoin' => 0,
						   'balance' => $userDestino->wallet_amount,
						   'tipotransacion' => 0
    	               ];
    	               $this->saveWallet($datosOrigen);
    	               $this->saveWallet($datosDestino);
    	               
    	               return redirect('mioficina/admin/wallet')->with('msj', 'Transfer sent with Success');
	               }else{
	                   return redirect('mioficina/admin/wallet')->with('msj2', 'The amount to be transferred cannot exceed the amount available');
	               }
	           }else{
	               return redirect('mioficina/admin/wallet')->with('msj2', 'The amount to be transferred cannot be negative');
	           }
	       }
	   }else{
	       return redirect('mioficina/admin/wallet');
	   }
	}
	
	/**
	 * Guarda la informacion o los registro del la billetera
	 * 
	 * @access public
	 * @param array $datos - arreglo con los datos necesarios
	 */
	public function saveWallet($datos)
	{
		Wallet::create($datos);
	}
    
    /**
     * Solicita el proceso de retiro de un usuario
     * 
     * @access public
     * @param request $datos - datos para el retiro
     * @return view
     */
    public function retiro(Request $datos){
        $fecha = new Carbon;
        if (!empty($datos)){
			$resta = $datos->total;
			if (Auth::user()->check_token_google == 1) {
				if (!(new Google2FA())->verifyKey(Auth::user()->toke_google, $datos->code)) {
					return redirect()->back()->with('msj2', 'el codigo es incorrecto');
				}
			}
			$checkPago = Pagos::where([
				['iduser', '=', Auth::user()->ID],
				['estado', '=', 0]
			])->first();
			if (!empty($checkPago)) {
				return redirect()->back()->with('msj2', 'Tienes un retiro pendiente');
			}
            if($resta > 0){
                if($resta <= $datos->montodisponible){
                    $tipopago = '';
                    if(!empty($datos->metodocorreo)){
                        $tipopago = 'Email: '.$datos->metodocorreo;
                    }
                    if(!empty($datos->metodowallet)){
                        $tipopago = $tipopago.'- Wallet: '.$datos->metodowallet;
                    }
                    if(!empty($datos->metodobancario)){
                        $tipopago = $tipopago.'- Bank data: '.$datos->metodobancario;
                    }
                    $metodo = MetodoPago::find($datos->metodopago);
                    // if ($resta > $datos->monto_min) {
						// DB::table('user_campo')->where('ID', Auth::user()->ID)->update(['paypal' => $datos->metodowallet]);
						$user = Auth::user();
						$user->wallet_amount = ($user->wallet_amount - $resta);
						$datosW = [
							'iduser' => $user->ID,
							'usuario' => $user->display_name,
							'descripcion' => 'Retiro por un monto de - $ '. $datos->monto.' - A la billetera: '.$datos->metodowallet,
							'descuento' => ($datos->monto - $resta),
							'puntos' => 0,
							'puntosI' => 0,
							'puntosD' => 0,
							'debito' => 0,
							'credito' => $datos->monto,
							'balance' => $user->wallet_amount,
							'tipotransacion' => 1,
						];
						$this->saveWallet($datosW);
						$user->save();
						Pagos::create([
							'iduser' => Auth::user()->ID,
							'username' => Auth::user()->display_name,
							'email' => Auth::user()->user_email,
							'monto' => $resta,
							'descuento' => ($datos->monto - $resta),
							'fechasoli' => $fecha->now(),
							'metodo' => $metodo->nombre,
							'tipowallet' => $datos->tipowallet,
							'tipopago' => $tipopago,
							'estado' => 0
						]);
						return redirect()->back()->with('msj', 'El Retiro ha sido procesado');
					// } else {
					// 	return redirect()->back()->with('msj2', 'El monto a retirar no puede ser menor la monto minimo');	
					// }
                }else{
                    return redirect()->back()->with('msj2', 'El monto a retirar no puede ser mayor a monto disponible');
                }
            }else{
                return redirect()->back()->with('msj2', 'El monto a retirar no puede ser negativo o 0');
			}
        }else{
           return redirect()->back(); 
        }
    }
    
    /**
     * Permite Obtener por donde se procesara el pago al usuario
     * 
     * @access public
     * @param int $id - el metodo de pago selecionado por el usuario
     * @return json
     */
    public function datosMetodo($id){
        $metodo = MetodoPago::find($id);
        $datos = [
            'correo' => $metodo->correo,
            'wallet' => $metodo->wallet,
			'bancario' => $metodo->datosbancarios,
			'tipofeed' => $metodo->tipofeed,
			'feed' => $metodo->feed,
			'monto_min' => $metodo->monto_min
            ];
        return json_encode($datos);
    }


	/**
	 * Lleva a la vista donde puedo ver mis inversiones realizadas y sus ganancias
	 *
	 * @return void
	 */
	public function indexInversiones()
	{
		$funciones = new IndexController();

		$inversiones = $funciones->getInversionesUserDashboard(Auth::user()->ID, true);

		return view('wallet.indexInversiones', compact('inversiones')); 
	}

	/**
	 * Permite procesar el proceso de la liquidacion de la inversiones
	 *
	 * @param Request $request
	 * @return void
	 */
	public function retirarInversiones(Request $request)
	{

		$validate = $request->validate([
			'retirar' => ['numeric', 'required']
		]);

		try {
			if ($validate) {
				$user = User::find(Auth::user()->ID);
				$admin = User::find(1);
				$inversion = DB::table('log_rentabilidad')->where('id', $request->idinversion)->first();
				if ($inversion->balance > 0) {
					$concepto = 'Liquidacion de '.$request->retirar.' de la Rentabilidad: '.$request->idinversion;
					$credito = $request->retirar;
					$balance = 0;
					if ($request->porc_penalizacion != 0) {
						// $user->rentabilidad = ($user->rentabilidad - $request->retirar);
						// $admin->rentabilidad = ($user->rentabilidad + $request->mont_penalizacion);
						$total = ($inversion->retirado + $request->retirar);
						if ($total >= $inversion->limite) {
							return redirect()->back()->with('msj2', 'El valor total retirado supera el monto limite');
						}
						$balance = ($inversion->ganado - $total);
						$dataRent = [
							'retirado' => $total,
							'balance' => $balance
						];
					}

					$wallet = DB::table('user_campo')->where('ID', '=', Auth::user()->ID)->select('paypal')->first();

					$comisiones = new ComisionesController();
					$dataLiquidation = [
						'iduser' => Auth::user()->ID,
						'total' => $request->total,
						'wallet_used' => $wallet->paypal,
						'process_date' => Carbon::now(),
						'status' => 0,
						'type_liquidation' => 'Inversion',
						'idinversion' => $inversion->id,
						'monto_bruto' => $credito,
						'feed' => $request->mont_penalizacion
					];

					$dataPay = [
						'iduser' => Auth::user()->ID,
						'id_log_renta' => $inversion->id,
						'porcentaje' => 0,
						'debito' => 0,
						'credito' => $credito,
						'balance' => $balance,
						'fecha_pago' => Carbon::now(),
						'concepto' => $concepto,
					];

					$comisiones->savePayRentabilidad($dataPay, $inversion->id, $dataRent);
					
					// $concepto = 'Liquidacion generada por un monto de '.$credito;
					$liquidacion = new LiquidationController();
					$liquidacion->saveLiquidation($dataLiquidation);


					return redirect()->back()->with('msj', 'Retiro procesado con exito');
				}else{
					return redirect()->back()->with('msj', 'El monto disponible esta por debajo de 0');
				}
			}
		} catch (\Throwable $th) {
			\Log::error('Error Proceso retirarInversiones '.$th);
		}
	}

	/**
	 * Lleva a la vista de los detalles de las rentabilidad
	 *
	 * @param integer $id
	 * @return void
	 */
	public function indexInversionDetalle($id)
	{
		$detalles = DB::table('log_rentabilidad_pay')->where('id_log_renta', $id)->get();

		return view('wallet.indexInversionesDetalles', compact('detalles')); 
	}

	/**
	 * Permite procesar el proceso de la liquidacion de la inversiones
	 *
	 * @param Request $request
	 * @return void
	 */
	public function retirarInvertido(Request $request)
	{

		$user = User::find(Auth::user()->ID);
		$admin = User::find(1);
		$inversion = OrdenInversion::find($request->idinversion);
		$inversion->status = 2;
		$inversion->save();
		$concepto = 'Retiro de la inversion realizada '.$request->retirar.' - Ganancia perdida '.$request->ganacia;
		$credito = $request->retirar;
		$user->rentabilidad = ($user->rentabilidad - $request->ganacia);
		
		$user->save();
		$admin->save();

		$wallet = DB::table('user_campo')->where('ID', '=', Auth::user()->ID)->select('paypal')->first();
		
		$data = [
			'iduser' => $inversion->iduser,
			'idinversion' => $inversion->id,
			'concepto' => $concepto,
			'debito' => 0,
			'credito' => $request->ganacia,
			'balance' => $user->rentabilidad,
			'semana' => '',
			'year' => '',
			'fecha_retiro' => Carbon::now(),
			'descuento' => 0,
			'correo' => $user->user_email
		];

		$comisiones = new ComisionesController();

        $dataLiquidation = [
            'iduser' => Auth::user()->ID,
            'total' => $credito,
            'wallet_used' => $wallet->paypal,
            'process_date' => Carbon::now(),
            'status' => 0,
			'type_liquidation' => 'Retiro Invertido',
			'idinversion' => $comisiones->sabeWalletRentabilidad($data),
			'monto_bruto' => $credito,
			'feed' => 0
		];
		
		// $concepto = 'Liquidacion generada por un monto de '.$credito;

		$liquidacion = new LiquidationController();
		$liquidacion->saveLiquidation($dataLiquidation);
		
		return redirect()->back()->with('msj', 'Retiro de lo Invertido procesado con exito');
	}

}
