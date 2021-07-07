<?php

namespace App\Http\Controllers;

use App\OrdenInversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use CoinPayment;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ComisionesController;
use App\Http\Controllers\ActivacionController;
use App\Http\Controllers\WalletController;

class InversionController extends Controller
{
    public $comisionController;
    public $indexController;
    public $activacionController;

    public function __construct()
    {
        $this->comisionController = new ComisionesController();
        $this->indexController = new IndexController();
        $this->activacionController = new ActivacionController();
    }
    /**
     * Permite realizar el pago de la inversion realizada
     *
     * @param Request $request
     * @return void
     */
    public function pago(Request $request)
    {
        $validate = $request->validate([
            'inversion' => ['required', 'numeric', 'min:100'],
            // 'inversion' => ['required'],
            'name' => ['required'],
            // 'tipo_pago' => ['required']
        ]);
        try {
            if ($validate) {
                // if ($request->tipo_pago == 'btc') {
                    $inversion = (double) $request->inversion;
                    $porcentage = ($inversion * 0.06);
                    $total = ($inversion + $porcentage);

                    $transacion = [
                        'amountTotal' => $total,
                        'note' => 'Inversion de '.number_format($request->inversion, 2, ',', '.').' USD',
                        'idorden' => $this->saveOrden($inversion, 0),
                        'tipo' => 'inversion',
                        'buyer_email' => Auth::user()->user_email,
                        'redirect_url' => route('tienda-index')
                    ];

                    $transacion['items'][] = [
                        'itemDescription' => 'Inversion de '.number_format($request->inversion, 2, ',', '.').' USD',
                        'itemPrice' => $inversion, // USD
                        'itemQty' => (INT) 1,
                        'itemSubtotalAmount' => $inversion // USD
                    ];
        
                    $ruta = CoinPayment::generatelink($transacion);
                    return redirect($ruta);
                // }else{
                //     $msj = $this->procesarInversionWallet($request);
                //     return redirect()->back()->with('msj', $msj);
                // }
            }
        } catch (\Throwable $th) {
            \Log::error('Error Proceso Pago '.$th);
            return redirect()->back()->with('msj', 'Ha ocurrido un error, por favor contacte con el administrador');
        }
    }

    /**
     * Permite procesar las compras con las ganancia de la inversion
     *
     * @param float $inversion - total invertido
     * @param float $totalPagar - valor total a pagar
     * @param integer $paquete
     * @return string
     */
    function procesarInversionWallet($inversion, $totalPagar, int $paquete): string
    {
        try {
            $iduser = Auth::user()->ID;
            $msj = 'La inversion es mayor al monto disponible';
            $inversion = (double) $inversion;
            $inversionPagar = DB::table('log_rentabilidad')->where([
                ['iduser', '=', $iduser],
                ['ganado', '>=', $totalPagar]
            ])->first();
            if ($inversionPagar != null) {
                $total = ($inversionPagar->retirado + $totalPagar);
                if ($total >= $inversionPagar->limite) {
                    $msj = 'El valor total retirado supera el monto limite';
                }else{
                    $balance = ($inversionPagar->ganado - $total);
                    $dataRent = [
                        'retirado' => $total,
                        'balance' => $balance
                    ];
                    $idOrden = $this->saveOrden($inversion, $paquete);
                    $fecha_inicio = Carbon::now();
                    DB::table('orden_inversiones')->where('id', '=', $idOrden)->update([
                        'fecha_inicio' => $fecha_inicio,
                        'idtrasancion' => 'Wallet-'.$fecha_inicio->format('Ymd-His'),
                        'fecha_fin' => $fecha_inicio->copy()->addYear(),
                        'status' => 1
                    ]);
                    if ($paquete != 100) {
                        $this->comisionController->checkExictRentabilidad($iduser, $idOrden);
                    }

                    $concepto = 'Compra de un paquete de inversion por un monto de '.$inversion;
                    if ($paquete == 100) {
                        $concepto = 'Actualizar el paquete de membresia';
                    }

                    $dataPay = [
                        'iduser' => Auth::user()->ID,
                        'id_log_renta' => $inversionPagar->id,
                        'porcentaje' => 0,
                        'debito' => 0,
                        'credito' => $inversion,
                        'balance' => $balance,
                        'fecha_pago' => Carbon::now(),
                        'concepto' => $concepto,
                    ];

                    $this->comisionController->savePayRentabilidad($dataPay, $inversionPagar->id, $dataRent);

                    $msj = 'Compra Procesada Con exito';
                }
            }
            return $msj;
        } catch (\Throwable $th) {
            \Log::error('Error Proceso procesarInversionWallet '.$th);
        }
    }

    /**
     * Permite guardar la orden de compra de la inversion
     *
     * @param string $inversion - monto invertido
     * @param string $idpaquete - id del paqueted de inversion
     * @return integer
     */
    public function saveOrden($inversion, $idpaquete): int
    {
        $data = [
            'invertido' => (DOUBLE) $inversion,
            'concepto' => ($idpaquete == 0) ? 'Inversion de '.number_format($inversion, 2, ',', '.'). ' USD' : 'Paquete Gold',
            'iduser' => Auth::user()->ID,
            'idtrasancion' => '',
            'status' => 0,
            'paquete_inversion' => $idpaquete
        ];

        $orden = OrdenInversion::create($data);

        return $orden->id;
    }

    /**
     * Lleva a la vista de inversiones del admin
     *
     * @return void
     */
    public function indexAdminInversion()
    {
        view()->share('title', 'Inversiones');
        
        $inversiones = DB::table('log_rentabilidad')->get();
        
        foreach ($inversiones as $inversion) {
            $inversion->plan = 'Paquete no defenido';
            $user = User::find($inversion->iduser);
            if (!empty($user)) {
                $inversion->correo = $user->user_email;
                $inversion->usuario = $user->display_name;
                $inversion->wallet = $user->wallet_amount;
            }else{
                $inversion->correo = 'Usuario Eliminado o no disponible';
                $inversion->usuario = 'Usuario Eliminado o no disponible';
            }
        }
        return view('admin.indexAdminInversiones', compact('inversiones'));
    }

    /**
     * Permite Verificar las compras procesadas
     *
     * @return void
     */
    public function verificarCompras()
    {
        try {
            $transaciones = DB::table('coinpayment_transactions')->where([
                ['status', '=', 0]
            ])->get();
            foreach ($transaciones as $transacion) {
                $result = CoinPayment::getstatusbytxnid($transacion->txn_id);
                if ($result != null && is_array($result)) {
                    DB::table('coinpayment_transactions')->where('txn_id', $transacion->txn_id)->update($result);
                    $orden = null;
                    if ($result['status'] == 100) {
                        $orden = OrdenInversion::find($transacion->idorden);
                    }
                    if ($orden != null) {
                        if ($orden->paquete_inversion == 0) {
                            $fecha_inicio = new Carbon($transacion->created_at);
                            $fecha_fin = new Carbon($transacion->created_at);
                            DB::table('orden_inversiones')->where('idtrasancion', '=', $orden->idtrasancion)->update([
                                'fecha_inicio' => $fecha_inicio,
                                'fecha_fin' => $fecha_fin->addYear(),
                                'status' => 1
                            ]);
                            $this->comisionController->checkExictRentabilidad($orden->iduser, $orden->id);
                        }elseif($orden->paquete_inversion == 100){
                            $fecha_inicio = new Carbon($transacion->created_at);
                            DB::table('orden_inversiones')->where('idtrasancion', '=', $orden->idtrasancion)->update([
                                'fecha_inicio' => $fecha_inicio,
                                'fecha_fin' => $fecha_inicio,
                                'status' => 1
                            ]);
                            $this->activacionController->activarPaqueteGold($orden->iduser);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite Verificar las compras procesadas
     *
     * @return void
     */
    public function ActivarManualesCompras()
    {
        try {
            $fecha = Carbon::now();
            $transaciones = DB::table('coinpayment_transactions')->where([
                ['status', '=', 100]
            ])
            ->whereDate('created_at', '>=', $fecha->copy()->subDay(7))
            ->get();
            foreach ($transaciones as $transacion) {
                $orden = OrdenInversion::find($transacion->idorden);
                if ($orden != null) {
                    if ($orden->paquete_inversion == 0) {
                        $fecha_inicio = new Carbon($transacion->created_at);
                        $fecha_fin = new Carbon($transacion->created_at);
                        DB::table('orden_inversiones')->where('idtrasancion', '=', $orden->idtrasancion)->update([
                            'fecha_inicio' => $fecha_inicio,
                            'fecha_fin' => $fecha_fin->addYear(),
                            'status' => 1
                        ]);
                        $this->comisionController->checkExictRentabilidad($orden->iduser, $orden->id);
                    }elseif($orden->paquete_inversion == 100){
                        $fecha_inicio = new Carbon($transacion->created_at);
                        DB::table('orden_inversiones')->where('idtrasancion', '=', $orden->idtrasancion)->update([
                            'fecha_inicio' => $fecha_inicio,
                            'fecha_fin' => $fecha_inicio,
                            'status' => 1
                        ]);
                        $this->activacionController->activarPaqueteGold($orden->iduser);
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite obtener el valor del paquete gold a pagar
     *
     * @param integer $iduser
     * @return float
     */
    public function getValorPaqueteGold(int $iduser): float
    {
        $fecha = Carbon::now();
        $totalInversion = OrdenInversion::where([
            ['iduser', '=', $iduser],
            ['status', '=', 1],
            ['paquete_inversion', '=', 0]
        ])->whereDate('fecha_fin', '>=', $fecha)
        ->get()->sum('invertido');

        $valorGold = ($totalInversion * 0.06);

        return $valorGold;
    }

    /**
     * Permite actualizar el paquete gold
     *
     * @return void
     */
    public function pagoGold(Request $request)
    {
        $validate = $request->validate([
            'tipo_pago' => 'required'
        ]);
        try{      
            $iduser = Auth::user()->ID;
            $inversion = $this->getValorPaqueteGold($iduser);
            $porcentage = ($inversion * 0.06);
            $total = ($inversion + $porcentage);
            if ($request->tipo_pago == 'btc') {
                $transacion = [
                    'amountTotal' => $total,
                    'note' => 'Paquete Gold',
                    'idorden' => $this->saveOrden($inversion, 100),
                    'tipo' => 'Paquete',
                    'buyer_email' => Auth::user()->user_email,
                    'redirect_url' => route('tienda-index')
                ];
                $transacion['items'][] = [
                    'itemDescription' => 'Paquete gold',
                    'itemPrice' => $inversion, // USD
                    'itemQty' => (INT) 1,
                    'itemSubtotalAmount' => $inversion // USD
                ];
    
                $ruta = CoinPayment::generatelink($transacion);
                return redirect($ruta);
            } else {
                $msj = $this->procesarInversionWallet($inversion, $total, 100);
                $this->activacionController->activarPaqueteGold($iduser);
                return redirect()->back()->with('msj', $msj);
            }
            
            
            
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('msj', 'Ha ocurrido un error, por favor contacte con el administrador');
        }
    }

    /**
     * Permite hacer una reinversion 
     *
     * @param Request $request
     * @return void
     */
    public function reinversion(Request $request)
    {
        $validate = $request->validate([
            'reinversion' => ['required', 'numeric']
        ]);

        try{
            if ($validate) {
                // Rentabilidad
                $rentabilidad = DB::table('log_rentabilidad')->where('id', $request->idinversion3)->first();
                // User
                $user = User::find($rentabilidad->iduser);
                $user->wallet_amount = ($user->wallet_amount - $request->total);
                // Orden
                $orden = OrdenInversion::find($rentabilidad->idcompra);
                $orden->invertido = ($orden->invertido + $request->reinversion);
                $orden->fecha_inicio = Carbon::now();
                $orden->fecha_fin = Carbon::now()->addYear();
                // Recalculo de la nueva informacion de la inversio 
                $limite = ($orden->invertido * 2);
                $progreso = (($rentabilidad->ganado / $limite) * 100);
                $updateRentabilidad = [
                    'limite' => $limite,
                    'precio' => $orden->invertido,
                    'progreso' => $progreso,
                ];
                // registrar el movimiento del saldo usado
                $concepto = 'Reinversion por un monto de '.$request->reinversion;
                $dataWallet = [
                    'iduser' => $user->ID,
                    'usuario' => $user->display_name,
                    'descripcion' => $concepto,
                    'descuento' => $request->mont_fee,
                    'debito' => 0,
                    'credito' => $request->total,
                    'balance' => $user->wallet_amount,
                    'tipotransacion' => 3,
                    'status' => 0,
                    'correo' => $user->user_email,
                ];
                $this->saveWallet($dataWallet);

                // Actualizar Informacion
                DB::table('log_rentabilidad')->where('id', $request->idinversion3)->update($updateRentabilidad);
                $orden->save();
                $user->save();

                return redirect()->back()->with('msj', 'Reinversion realizada con exito');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('msj', 'Ha ocurrido un error, por favor contacte con el administrador');
        }
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
}
