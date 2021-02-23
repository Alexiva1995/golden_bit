<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Liquidacion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ComisionesController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;


class LiquidationController extends Controller
{
    /**
     * LLeva a la vista de las liquidaciones pendientes
     *
     * @return void
     */
    public function index()
    {
        // TITLE
        view()->share('title', 'Generar Liquidaciones');

        $comisiones = $this->getComisionesTotalIndex([], Auth::user()->ID);
        $filtro = false;
        return view('liquidation.index', compact('comisiones', 'filtro'));
    }

    public function indexUserComision()
    {
        // TITLE
        view()->share('title', 'Generar Liquidaciones');

        return view('liquidation.indexComisiones');
    }

    /**
     * Permite el proceso de filtrado en las liquidaciones
     *
     * @param Request $request
     * @return void
     */
    public function indexFiltro(Request $request)
    {
        // TITLE
        view()->share('title', 'Generar Liquidaciones');
        $comisiones = $this->getComisionesTotalIndex($request->all(), Auth::user()->ID);
        $filtro = true;
        return view('liquidation.index', compact('comisiones', 'filtro'));
    }

    /**
     * Permite traer las comisiones a proccesar dependiendo del o de los filtro aplicados
     *
     * @param array $filtros
     * @param integer $iduser
     * @return array
     */
    public function getComisionesTotalIndex(array $filtros, $iduser = null): array
    {
        $comisiones = [];
        if ($iduser != null && $iduser != 1) {
            $comisionestmp = Commission::where([
                ['status', '=', 0],
                ['user_id', '=', $iduser]
            ])->select(
                DB::raw('sum(total) as total'), 'user_id'
            )->groupBy('user_id')->get();
        }else{
            $comisionestmp = Commission::where('status', '=', 0)->select(
                DB::raw('sum(total) as total'), 'user_id'
            )->groupBy('user_id')->get();
        }

        foreach ($comisionestmp as $comision) {
            $user = User::find($comision->user_id);
            $comision->usuario = 'Usuario No Disponible';
            $comision->status = 0;
            $comision->email = 'Correo no disponible';
            if (!empty($user)) {
                $comision->usuario = $user['display_name'];
                $comision->status = $user['status'];
                $comision->email = $user['user_email'];
            }
            if ($filtros == []) {
                $comisiones[] = $comision;
            }else{
                if (!empty($filtros['activo'])) {
                    if ($comision->status == 1) {
                        if (!empty($filtros['mayorque'])) {
                            if ($comision->total >= $filtros['mayorque']) {
                                $comisiones[] = $comision;
                            }
                        } else {
                            $comisiones[] = $comision;
                        }
                    }
                }else{
                    if (!empty($filtros['mayorque'])) {
                        if ($comision->total >= $filtros['mayorque']) {
                            $comisiones[] = $comision;
                        }
                    } else {
                        $comisiones[] = $comision;
                    }
                }
            }
        }
        return $comisiones;
    }

    /**
     * Permite obtener las comisiones un usuario
     *
     * @param integer $iduser
     * @param integer $status
     * @return object
     */
    public function getComisiones(int $iduser, $status): object {
        $comisiones = Commission::where([
            ['status', '=', $status],
            ['user_id', '=', $iduser]
        ])->select('id', 'date', 'referred_email', 'total', 'concepto')->get();

        foreach ($comisiones as $comision) {
            $user = User::where('user_email', '=', $comision->referred_email)->select('ID', 'display_name')->first();
            $comision->idreferido = 0;
            $comision->referido = 'Usuario no Disponible';
            if (!empty($user)) {
                $comision->idreferido = $user->ID;
                $comision->referido = $user->display_name;
                $comision->date = date('d-m-Y', strtotime($comision->date));
                $comision->total2 = number_format($comision->total, 2, ',', '.');
            }
        }

        return $comisiones;
    }

    /**
     * Permite obtener el total a pagar de las comisiones de un usuario
     *
     * @param integer $iduser
     * @param integer $status
     * @return float
     */
    public function getTotaPagar(int $iduser, $status) : float
    {
        $total = Commission::where([
            ['status', '=', $status],
            ['user_id', '=', $iduser]
        ])->get()->sum('total');

        return $total;
    }

    /**
     * Permite obtener los detalles de las comisiones
     *
     * @param integer $iduser
     * @return string
     */
    public function detalles(int $iduser): string
    {
        $user = User::find($iduser)->only('display_name');
        $data = [
            'comisiones' => $this->getComisiones($iduser, 0),
            'totalPagar' => number_format($this->getTotaPagar($iduser, 0), 2, ',', '.'),
            'usuario' => $user['display_name']
        ];

        return json_encode($data);
    }

    /**
     * Permite general la liquidaciones pendientes de los usuarios
     *
     * @param Request $request
     * @return void
     */
    public function liduidarUser(Request $request)
    {
        $validate = $request->validate([
            'listuser' => ['required']
        ]);
        if ($validate) {
            foreach ($request->listuser as $user) {
                $this->generanLiquidacion($user, []);
            }
            return redirect()->route('liquidacion')->with('msj', 'Liquidaciones Procesadas');
        }
    }

    /**
     * Permite Procesar las liquidaciones de forma individual para cada usuario
     *
     * @param Request $request
     * @return void
     */
    public function procesarComisiones(Request $request)
    {
        $validate = $request->validate([
            'listcomisiones' => ['required']
        ]);
        if ($validate) {
            if ($request->action == 'liquidar') {
                $this->generanLiquidacion($request->iduser, $request->listcomisiones);
                return redirect()->route('liquidacion')->with('msj', 'Liquidacion Procesadas');
            }elseif($request->action == 'rechazar'){
                $this->rechazarComisiones($request->listcomisiones, $request->iduser);
                return redirect()->route('liquidacion')->with('msj', 'Comisiones Rechazadas');
            }
        }
    }

    /**
     * Permite rechazar las comisiones
     *
     * @param array $listComisiones
     * @param integer $iduser
     * @return void
     */
    public function rechazarComisiones(array $listComisiones, int $iduser)
    {
        $totalLiquidation = 0;
        foreach ($listComisiones as $comision) {
            $totalLiquidation = ($totalLiquidation + $comision->total);
            Commission::where('id', $comision)->update(['status' => 2]);
        }

        $concepto = 'Comisiones no Restribuidas';

        $user = User::find($iduser);
        $user->wallet_amount = ($user->wallet_amount - $totalLiquidation);
        $dataWallet = [
            'iduser' => $iduser,
            'usuario' => $user->display_name,
            'descripcion' => $concepto,
            'descuento' => 0,
            'debito' => 0,
            'credito' => $totalLiquidation,
            'balance' => $user->wallet_amount,
            'tipotransacion' => 3,
            'status' => 0
        ];
        $this->saveWallet($dataWallet);
    }

    /**
     * Permite procesar las liquidaciones de los usuarios 
     *
     * @param integer $iduser
     * @param array $comisiones
     * @return void
     */
    public function generanLiquidacion($iduser, $comisionesList)
    {
        $comisiones = $this->getComisiones($iduser, 0);
        $comisionesProcesar = [];
        $totalLiquidation = 0;
        foreach ($comisiones as $comision) {
            if ($comisionesList != []) {
                if (in_array($comision->id, $comisionesList)) {
                    $comisionesProcesar [] = $comision;
                    $totalLiquidation = ($totalLiquidation + $comision->total);
                }
            }else{
                $comisionesProcesar [] = $comision;
                $totalLiquidation = ($totalLiquidation + $comision->total);
            }
        }
        
        $wallet = DB::table('user_campo')->where('ID', '=', $iduser)->select('paypal')->first();
        $feed = ($totalLiquidation * 0.1);
        $totalPagar = ($totalLiquidation - $feed);
        $data = [
            'iduser' => $iduser,
            'total' => $totalPagar,
            'wallet_used' => $wallet->paypal,
            'process_date' => Carbon::now(),
            'status' => 0,
            'type_liquidation' => 'Comisiones',
            'monto_bruto' => $totalLiquidation,
            'feed' => $feed
        ];
        $idLiquidacion = $this->saveLiquidation($data);

        $concepto = 'Liquidacion generada por un monto de '.$totalLiquidation;
        
        $user = User::find($iduser);
        $user->wallet_amount = ($user->wallet_amount - $totalLiquidation);
        $user->save();
        $dataWallet = [
            'iduser' => $iduser,
            'usuario' => $user->display_name,
            'descripcion' => $concepto,
            'descuento' => $feed,
            'debito' => 0,
            'credito' => $totalPagar,
            'balance' => $user->wallet_amount,
            'tipotransacion' => 3,
            'status' => 0,
            'correo' => $user->user_email,
        ];
        $this->saveWallet($dataWallet);

        foreach ($comisionesProcesar as $comision) {
            Commission::where('id', $comision->id)->update(['status' => 1, 'id_liquidacion' => $idLiquidacion]);
        }
    }

    /**
     * Permite guardar la liquidacion y devolver el id correspondiente
     *
     * @param array $data
     * @return integer
     */
    public function saveLiquidation($data): int
    {
        $liquidacion = Liquidacion::create($data);

        return $liquidacion->id;
    }

    /**
     * Permite guardar en la billetera
     *
     * @param array $data
     * @return void
     */
    public function saveWallet(array $data)
    {
        $funciones = new WalletController;
        $funciones->saveWallet($data);
    }

    /**
     * Permite llevar a las liquidaciones pendientes
     *
     * @return void
     */
    public function liquidacionPendientes()
    {
        // TITLE
        view()->share('title', 'Liquidaciones Pendientes');
        $liquidaciones = Liquidacion::where('status', '=', 0)->get();

        foreach ($liquidaciones as $liquidacion) {
            $user = User::find($liquidacion->iduser);
            $liquidacion->usuario = 'Usuario No Disponible';
            $liquidacion->email = 'Correo no disponible';
            if (!empty($user)) {
                $liquidacion->usuario = $user['display_name'];
                $liquidacion->email = $user['user_email'];
            }
        }

        return view('liquidation.liquidacionPendiente', compact('liquidaciones'));
    }

    /**
     * Permite llevar a las liquidaciones Realizadas
     *
     * @return void
     */
    public function liquidacionesRealizada()
    {
        // TITLE
        view()->share('title', 'Liquidaciones Realizadas');
        $liquidaciones = Liquidacion::where('status', '=', 1)->get();

        foreach ($liquidaciones as $liquidacion) {
            $user = User::find($liquidacion->iduser)->only('display_name', 'user_email');
            $liquidacion->usuario = 'Usuario No Disponible';
            $liquidacion->email = 'Correo no disponible';
            if (!empty($user)) {
                $liquidacion->usuario = $user['display_name'];
                $liquidacion->email = $user['user_email'];
            }
        }

        return view('liquidation.liquidacionRealizadas', compact('liquidaciones'));
    }
    
    /**
     * Permite procesar las liquidaciones ya una vez en estado de pendiente
     *
     * @param Request $request
     * @return void
     */
    public function updateLiquidation(Request $request)
    {
        if ($request->action == 'reversar') {
            $validate = $request->validate([
                'comentario' => 'required'
            ]);
        }else{
            $validate = true;
        }

        if ($validate) {
            $accion = '';
            if ($request->action == 'reversar') {
                $accion = 'Se reverso con exito la liquidacion '.$request->liquidacion;
                $this->reversarLiquidaciones($request->iduser, $request->liquidacion, $request->comentario);
            }else{
                $accion = $this->aprobarLiquidacion($request);
            }
            return redirect()->back()->with('msj', $accion);
        }
    }

    /**
     * Permite aprobar las liquidaciones
     *
     * @param object $data
     * @return string
     */
    public function aprobarLiquidacion(object $data): string
    {
        try {
            $estado = '';
            $liquidacion = Liquidacion::find($data->liquidacion);
            $liquidacion->comment = $data->comentario;
            $liquidacion->status = 1;
            $valor = $this->getRateBtc();
            if ($valor != 0) {
                $cmd = 'create_withdrawal';
                $dataPago = [
                    'amount' => ($liquidacion->total * $valor),
                    'currency' => 'BTC',
                    'address' => $liquidacion->wallet_used,
                ];
                // llamo la a la funcion que va a ser la transacion
                $result = $this->coinpayments_api_call($cmd, $dataPago);
                if (!empty($result['result'])) {
                    $estado = 'Se aprobo con exito la liquidacion '.$liquidacion->id;
                    $liquidacion->hash = $result['result']['id'];
                    $this->bonoRetiro($liquidacion->iduser, $valor);
                    $liquidacion->save();
                }else{
                    $estado = "Hubo un error al momento de procesar el retiro";
                }
            }else{
                $estado = "Hubo un error al momento de obtener el valor del btc";
            }
            return $estado;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite pagar el bono de retiro
     *
     * @param integer $iduser - usuario que pagara
     * @param float $monto - monto a pagar
     * @return void
     */
    public function bonoRetiro($iduser, $monto)
    {
        $comisiones = new ComisionesController();
        $referido = User::find($iduser);
        $sponsor = User::where('ID', $referido->referred_id)->first();
        if (!empty($sponsor)) {
            $paquete = null;
            if ($sponsor->paquete) {
                $paquete = json_decode($sponsor->paquete);
            }
            if ($paquete != null) {
                if ($paquete->code == 1) {
                    $pagar = ($monto * 0.02);
                    $idcompra = $iduser.Carbon::now()->format('Ymd');
                    $concepto = 'Bono de Retiro por usuario '.$referido->Display_name;
                    $comisiones->saveComision($iduser, $idcompra, $pagar, $iduser, $sponsor->nivel, $concepto, 'Bono Retiro');
                }
            }
        }
    }

    /**
     * Permite reversar todas las liquidaciones procesadas
     *
     * @param integer $iduser
     * @param integer $idliquidacion
     * @param string $comentario
     * @return void
     */
    public function reversarLiquidaciones(int $iduser, int $idliquidacion, string $comentario)
    {
        try {
            $liquidacion = Liquidacion::find($idliquidacion);
            $user = User::find($iduser);
            if ($liquidacion->type_liquidation != 'Comisiones') {
                $rentabilidad = DB::table('log_rentabilidad')->where('id', $liquidacion->idinversion)->first();
                $comisiones = new ComisionesController();
                $total = ($rentabilidad->retirado - $liquidacion->monto_bruto);
                $balance = ($rentabilidad->ganado - $total);
                $dataRent = [
                    'retirado' => $total,
                    'balance' => $balance
                ];

                $concepto = 'Reverso de la  liquidacion de '.$liquidacion->monto_bruto.' de la inversion: '.$rentabilidad->id;

                $dataPay = [
                    'iduser' => Auth::user()->ID,
                    'id_log_renta' => $rentabilidad->id,
                    'porcentaje' => 0,
                    'debito' => $total,
                    'credito' => 0,
                    'balance' => $balance,
                    'fecha_pago' => Carbon::now(),
                    'concepto' => $concepto,
                ];
        
                $comisiones->savePayRentabilidad($dataPay, $rentabilidad->id, $dataRent);


            }elseif($liquidacion->type_liquidation == 'Comisiones'){

                $concepto = 'Reverso de la liquidacion con un monto de '.$liquidacion->monto_bruto;
                $user->wallet_amount = ($user->wallet_amount + $liquidacion->monto_bruto);
                $dataWallet = [
                    'iduser' => $iduser,
                    'usuario' => $user->display_name,
                    'descripcion' => $concepto,
                    'descuento' => 0,
                    'debito' => $liquidacion->monto_bruto,
                    'credito' => 0,
                    'balance' => $user->wallet_amount,
                    'tipotransacion' => 3,
                    'status' => 0
                ];
                $user->save();
                $this->saveWallet($dataWallet);
                Commission::where('id_liquidacion', '=', $liquidacion->id)->update(['status' => 0, 'id_liquidacion' => '']);
            }
            $liquidacion->comment_reverse = $comentario;
            $liquidacion->status = 2;
            $liquidacion->save();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite obtener la informacion del valor de la moneda
     *
     * @return float
     */
    public function getRateBtc(): float
    {
        $valor = 0;
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
            $valor = $currency->data->rates->BTC;
        }
        return $valor;
    }

    /**
     * Permite ejecutar los comando de coinpayment
     *
     * @param string $cmd
     * @param array $req
     * @return void
     */
    public function coinpayments_api_call($cmd, $req = array()) {
        // Fill these in from your API Keys page
        $public_key = env('COIN_PAYMENT_PUBLIC_KEY');
        $private_key = env('COIN_PAYMENT_PRIVATE_KEY');
        
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
    }

}
