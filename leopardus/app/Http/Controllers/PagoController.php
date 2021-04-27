<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use Carbon\Carbon;
use App\Pagos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Monedas;
use App\Http\Controllers\WalletController;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class PagoController extends Controller
{
	
	/**
	 * Vista de historial de pago
	 * 
	 * @access public
	 * @return view
	 */
	public function historyPrice(){
		view()->share('title', 'Historial de retiro');
	    $moneda = Monedas::where('principal', 1)->get()->first();
		$pagos = Pagos::where('estado', '!=', 0)->get();
		$fechas = [
			'desde' => '',
			'hasta' => ''
		];
	    return view('pagos.historialpago')->with(compact('pagos', 'fechas', 'moneda'));
	}
	
	/**
	 * Vista de Confirmacion de pago 
	 * 
	 * vista que confirma o rechaza los pagos
	 * 
	 * @access public
	 * @return view
	 */
	public function confimPrice(){
		view()->share('title', 'Confirmar Pagos');
	    $moneda = Monedas::where('principal', 1)->get()->first();
		$pagos = Pagos::where('estado', 0)->get();
		$fechas = [
			'desde' => '',
			'hasta' => ''
		];
	    return view('pagos.confirmarpago')->with(compact('pagos', 'fechas', 'moneda'));
	}

	/**
	 * Filtra por fecha los formularios indicados
	 */
	public function filtro(Request $datos)
	{
		$moneda = Monedas::where('principal', 1)->get()->first();
		if (!empty($datos)) {
			$desde = new Carbon($datos->desde);
			$hasta = new Carbon($datos->hasta);
			$fechas = [
				'desde' => $desde,
				'hasta' => $hasta
			];
			if ($datos->form == "confirmarpago") {
				if ($desde > $hasta) {
					return redirect('mioficina/admin/price/confirmar')->with('msj2', 'La fecha desde no puede ser mayor que la fecha hasta');
				}
				$pagos = Pagos::where('estado', 0)->where('fechasoli', '>=', $desde)->where('fechasoli', '<=', $hasta)->get();
	    		return view('pagos.confirmarpago')->with(compact('pagos', 'fechas', 'moneda'));
			} else {
				if ($desde > $hasta) {
					return redirect('mioficina/admin/price/historial')->with('msj2', 'La fecha desde no puede ser mayor que la fecha hasta');
				}
				$pagos = Pagos::where('estado', '!=', 0)->where('fechapago', '>=', $desde)->where('fechapago', '<=', $hasta)->get();
	    		return view('pagos.historialpago')->with(compact('pagos', 'fechas', 'moneda'));
			}
			
		}
	}

	/**
	 * Aprueba los pagos solicitados
	 * 
	 * @access public
	 * @param int $id - id del pago a procesar
	 * @return view
	 */
	public function aprobarPago($id)
	{
		$fecha = new Carbon;
		$pagos = Pagos::find($id);
		$user = User::find($pagos->iduser);
		$campo_user = DB::table('user_campo')->where('ID', '=', $pagos->iduser)->select('paypal')->first();
		$pagos->estado = 1;
		$pagos->fechapago = $fecha->now();
		$descuento = (!empty($pagos->descuento) ? $pagos->descuento : 0);
		$resta = ($pagos->monto + $descuento);

		// inicia el curl para conectarse a coinbase
		$cURL = curl_init();
		// toda la informacion del arreglo de coinbase
		curl_setopt_array($cURL, array(
            CURLOPT_URL => "https://api.coinbase.com/v2/exchange-rates",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
			));
		// se ejecuta el curl
		$tmpResult = curl_exec($cURL);
		// verifica si trae la informacion
		if ($tmpResult !== false) {
			$currency = json_decode($tmpResult);
			$cmd = 'create_withdrawal';
			// creo el arreglo de la transacion en coipayment
			$dataPago = [
				'amount' => ($currency->data->rates->ETH * $resta),
				'currency' => 'ETH',
				'address' => $campo_user->paypal,
			];
			// llamo la a la funcion que va a ser la transacion
			$result = $this->coinpayments_api_call($cmd, $dataPago);
			if (!empty($result['result'])) {
				// mando un correo una vez la transacion realizada
				$dataCorreo = [
					'monto' => $pagos->monto,
					'fecha' => Carbon::now()->format('d-m-Y'),
					'hora' => Carbon::now()->format('h:i:s')
				];
				Mail::send('emails.retiro',  ['data' => $dataCorreo], function($msj) use ($user){
					$msj->subject('Retiro exitoso');
					$msj->to($user->user_email);
				});
				$pagos->save();
				return redirect('mioficina/admin/price/confirmar')->with('msj', 'Pago Aprobado sastifactoriamente');
			}else{
				return redirect('mioficina/admin/price/confirmar')->with('msj2', 'Ocurrio un erro al aprobar el pago, vuelva a intentar - Error: '.$result['error']);
			}
		}else{
			return redirect('mioficina/admin/price/confirmar')->with('msj2', 'Ocurrio un erro al aprobar el pago, vuelva a intentar');
		}
	}

	/**
	 * Funcion que hace el llamado a la api de coinpayment
	 * 	ojo: esto dejarlo tal cual, en coinpayment debe permitir este procedimiento "create_withdrawal"
	 *
	 * @param string $cmd - transacion a ejecutar
	 * @param array $req - arreglo con el request a procesar
	 * @return void
	 */
	public function coinpayments_api_call($cmd, $req = array()) {
		// Fill these in from your API Keys page
		$public_key = env('COIN_PAYMENT_PUBLIC_KEY', '');
		$private_key = env('COIN_PAYMENT_PRIVATE_KEY', '');
		
		// Set the API command and required fields
		$req['version'] = 1;
		$req['cmd'] = $cmd;
		$req['key'] = $public_key;
		$req['format'] = 'json'; //supported values are json and xml
		
		// Generate the query string
		$post_data = http_build_query($req, '', '&');
		
		// Calculate the HMAC signature on the POST data
		$hmac = hash_hmac('sha512', $post_data, $private_key);
		
		// Create cURL handle and initialize (if needed)
		static $ch = NULL;
		if ($ch === NULL) {
			$ch = curl_init('https://www.coinpayments.net/api.php');
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		
		// Execute the call and close cURL handle     
		$data = curl_exec($ch);                
		// Parse and return data if successful.
		if ($data !== FALSE) {
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
				// We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
				$dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
			} else {
				$dec = json_decode($data, TRUE);
			}
			if ($dec !== NULL && count($dec)) {
				return $dec;
			} else {
				// If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
				return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
			}
		} else {
			return array('error' => 'cURL error: '.curl_error($ch));
		}
		// dd($this->coinpayments_api_call('rates'));
	} 

	public function rechazarPago($id)
	{
		$fecha = new Carbon;
		$pagos = Pagos::find($id);
		$user = User::find($pagos->iduser);
		$pagos->estado = 2;
		$pagos->fechapago = $fecha->now();
		$descuento = (!empty($pagos->descuento) ? $pagos->descuento : 0);
		$resta = ($pagos->monto + $descuento);
		$user->wallet_amount = ($user->wallet_amount + $resta);
		$datos = [
			'iduser' => $user->ID,
			'usuario' => $user->display_name,
			'descripcion' => 'Pago Rechazado por el Administrador',
			'descuento' => $descuento,
			'puntos' => 0,
			'puntosI' => 0,
			'puntosD' => 0,
			'debito' => $resta,
			'credito' => 0,
			'balance' => $user->wallet_amount,
			'tipotransacion' => 2,
		];
		$wallet = new WalletController;
		$wallet->saveWallet($datos);
		$user->save();
		$pagos->save();
		return redirect('mioficina/admin/price/confirmar')->with('msj', 'Pago Rechado sastifactoriamente');
	}
	
	public function confirmados(){
	    
	    $pagos = Pagos::where('estado', 1)->get();
	    return view('pagos.confirmados')->with(compact('pagos'));
	}
}
