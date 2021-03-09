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

use function GuzzleHttp\json_decode;

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
            'name' => ['required']
        ]);
        try {
            if ($validate) {
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
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('msj', 'Ah Ocurrido un error, por favor contacte con el administrador');
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
    public function pagoGold()
    {
        try{      
            $inversion = $this->getValorPaqueteGold(Auth::user()->ID);
            $porcentage = ($inversion * 0.06);
            $total = ($inversion + $porcentage);
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
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('msj', 'Ah Ocurrido un error, por favor contacte con el administrador');
        }
    }
}
