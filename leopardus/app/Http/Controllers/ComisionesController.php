<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User; 
use App\Commission;
use App\OrdenInversion;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WalletController;

class ComisionesController extends Controller
{

    public $walletController;
    public $indexController;

    public function __construct()
    {
        $this->walletController = new WalletController();
        $this->indexController = new IndexController();
    }

    /**
     * Permite pagar el bono directo
     *
     * @return void
     */
    public function bonoDirecto()
    {
        try {
            $ordenes = $this->getInversionesBonos();
        
            foreach ($ordenes as $orden) {
                $referido = User::find($orden->iduser);
                $padre = User::find($referido->referred_id);
                $bono = ($orden->invertido * 0.08);
                $concepto = 'Bono Directo, del usuario '.$referido->display_name.' de la inversion '.$orden->id;
                $this->saveComision($padre->ID, $orden->id, $bono, $referido->ID, 1, $concepto, 'Bono Directo');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite pagar el bono binario
     *
     * @return void
     */
    public function bonoBinario()
    {
        try {
            $users = User::where([
                ['status', '=', 1],
                ['puntosizq', '>', 0],
                ['puntosder', '>', 0]
            ])->get();
            
            foreach ($users as $user) {
                if ($this->indexController->statusBinary($user->ID)) {
                    $paquete = json_decode($user->paquete);
                    $porcentaje = ($paquete->code == 1) ? 0.1 : 0.05;
                    $puntos = 0;
                    if ($user->puntosizq >= $user->puntosder) {
                        $puntos = $user->puntosder;
                    }else{
                        $puntos = $user->puntosder;
                    }
                    $pagar = ($puntos * $porcentaje);
                    $concepto = 'Bono Binario, Puntos pagados: '.$puntos;
                    $usuarios = User::find($user->ID);
                    $usuarios->puntosizq = ($usuarios->puntosizq - $puntos);
                    $usuarios->puntosder = ($usuarios->puntosder - $puntos);
                    $usuarios->save();
    
                    $idcomision = $user->ID.Carbon::now()->format('Ymd');
    
                    $this->saveComision($user->ID, $idcomision, $pagar, $user->ID, 0, $concepto, 'Bono Binario');
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite guardar el registro de los bonos ganados
     *
     * @param integer $iduser
     * @param integer $idcompra
     * @param float $debito
     * @param integer $idreferido
     * @param integer $nivel_referido
     * @param string $concepto
     * @param string $tipo_bonus
     * @return void
     */
    public function saveComision(int $iduser, int $idcompra, float $debito, int $idreferido, int $nivel_referido, string $concepto, string $tipo_bonus)
    {
        $checkComision = Commission::where([
            ['user_id', '=', $iduser],
            ['compra_id', '=', $idcompra]
        ])->first();

        if ($checkComision == null) {
            $user = User::find($iduser);
            $referido = User::find($idreferido);
            Commission::create([
                'user_id' => $iduser,
                'compra_id' => $idcompra,
                'date' => Carbon::now()->format('Y-m-d'),
                'total' => $debito,
                'referred_email' => $referido->user_email,
                'referred_level' => $nivel_referido,
                'status' => 0,
                'concepto' => $concepto,
                'tipo_comision' => $tipo_bonus
            ]);

            $user->wallet_amount = ($user->wallet_amount + $debito);

            $dataWallet = [
                'iduser' => $iduser,
                'usuario' => $user->display_name,
                'correo' => $referido->user_email,
                'descripcion' => $concepto,
                'debito' => $debito,
                'credito' => 0,
                'balance' => $user->wallet_amount,
                'descuento' => 0,
                'tipotransacion' => 2,
                'status' => 0
            ];

            $this->walletController->saveWallet($dataWallet);

            $user->save();
        }
    }

    /**
     * Permite obtener la informacion para la barra de progreso
     *
     * @param integer $iduser
     * @return array
     */
    public function getBarraRentabilidad(int $iduser): array
    {
        $data = [
            'maximo' => 0,
            'progreso' => 0,
            'progre_porc' => 0
        ];

        return $data;
    }

    /**
     * Permite pagar el bono de rentabilidad
     *
     * @return void
     */
    public function pagarRentabilidad()
    {
        try {
            $users = User::where('status', 1)->get();
            $arrayGold = [
                0 => 1, 1 => 1.1, 2 => 1.2, 3 => 1.3, 4 => 1.4, 5 => 1.5
            ];
            $arrayStandar = [
                0 => 0.5, 1 => 0.6, 2 => 0.7, 3 => 0.8, 4 => 0.9, 5 => 0.9
            ];
            $numero = mt_rand(0, 5);
            foreach ($users as $user) {
                $paquete = json_decode($user->paquete);
                $porcentaje = 0;
                if ($paquete->code == 1) {
                    $porcentaje = ($arrayGold[$numero] / 100);
                }else{
                    $porcentaje = ($arrayStandar[$numero] / 100);
                }
                $ordens = OrdenInversion::where([
                    ['iduser', '=', $user->ID],
                    ['status', '=', 1],
                    ['paquete_inversion', '!=', '100']
                ])->whereDate('fecha_fin', '>', Carbon::now())->get();
                foreach ($ordens as $orden) {
                    $ganado = ($orden->invertido * $porcentaje);
                    $this->updateBonoRentabilidad($user->ID, $orden->id, $porcentaje, $ganado);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite agregar lo ganado en la rentabilidad
     *
     * @param integer $iduser
     * @param integer $idcompra
     * @param double $porcentaje
     * @param float $ganado
     * @return void
     */
    public function updateBonoRentabilidad($iduser, $idcompra, $porcentaje, $ganado)
    {
        $rentabilidad = DB::table('log_rentabilidad')->where([
            ['iduser', '=', $iduser],
            ['idcompra', '=', $idcompra],
            ['progreso', '<', 100]
        ])->first();

        if ($rentabilidad != null) {
            $tmpganado = ($rentabilidad->ganado + $ganado);
            if ($tmpganado > $rentabilidad->limite) {
                $tmpganado = $rentabilidad->limite;
            }
            $fecha = Carbon::now()->format('Y-m-d');

            $progreso = (($tmpganado / $rentabilidad->limite) * 100);
            $dataRent = [
                'ganado' => $tmpganado,
                'balance' => $tmpganado,
                'progreso' => $progreso,
                'fecha_fin' => Carbon::now()->addYear()->format('Y-m-d')
            ];
            if ($progreso == 100) {
                $dataRent['fecha_fin'] = $fecha;
            }
            
            $dataPay = [
                'iduser' => $iduser,
                'id_log_renta' => $rentabilidad->id,
                'porcentaje' => $porcentaje,
                'debito' => $ganado,
                'credito' => 0,
                'balance' => $tmpganado,
                'fecha_pago' => $fecha,
                'concepto' => 'Pagos Utilidades ('.$porcentaje.') - Fecha: '.$fecha,
            ];
            $this->savePayRentabilidad($dataPay, $rentabilidad->id, $dataRent);
        }
    }

    /**
     * Permite guardar los pagos de rentabilidad
     *
     * @param array $data
     * @param integer $idrentabilidad
     * @param array $dataRent
     * @return void
     */
    public function savePayRentabilidad($data, $idrentabilidad, $dataRent)
    {
        DB::table('log_rentabilidad')->where('id', $idrentabilidad)->update($dataRent);

        DB::table('log_rentabilidad_pay')->insert($data);
    }

    /**
     * Permite saber si la rentabilidad existe sino la agrega 
     *
     * @param integer $iduser
     * @param integer $idcompra
     * @return void
     */
    public function checkExictRentabilidad($iduser, $idcompra)
    {
        try {
            $rentabilidad = DB::table('log_rentabilidad')->where([
                ['iduser', '=', $iduser],
                ['idcompra', '=', $idcompra],
            ])->first();

            if ($rentabilidad == null) {

                $orden = OrdenInversion::where([
                    ['iduser', '=', $iduser],
                    ['id', '=', $idcompra]
                ])->first();
        
                $user = User::find($iduser);

                $this->saveRentabilidad($iduser, $idcompra, $user->paquete, $orden->invertido);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite registrar una nueva rentabilidad
     *
     * @param integer $iduser
     * @param integer $idcompra
     * @param string $paquete
     * @param float $precio
     * @return void
     */
    public function saveRentabilidad($iduser, $idcompra, $paquete, $precio)
    {
        $data = [
            'iduser' => $iduser,
            'idcompra' => $idcompra,
            'idproducto' => 0,
            'detalles_producto' => $paquete,
            'precio' => $precio,
            'limite' => ($precio * 2),
            'ganado' => 0,
            'retirado' => 0,
            'balance' => 0,
            'progreso' => 0,
            'nivel_minimo_cobro' => 0
        ];

        DB::table('log_rentabilidad')->insert($data);
    }

    /**
     * Permite obtener las inversiones de los ultimos 30 dias para poder pagar lo bonos
     *
     * @return void
     */
    public function getInversionesBonos(): object
    {
        $fecha = Carbon::now();
        $ordenes = OrdenInversion::where([
            ['status', '=', 1],
            ['paquete_inversion', '!=', '100']
        ])->whereDate('fecha_inicio', '>=', $fecha->copy()->subDays(30))->get();
        return $ordenes;
    }

    /**
     * Permite obtener el valor maximo invertido
     *
     * @param integer $iduser
     * @return float
     */
    public function getMaxInversion(int $iduser): float
    {
        $max = OrdenInversion::where([
            ['iduser', '=', $iduser],
            ['status', '=', 1],
        ])->get()->max('invertido');

        if ($max == null) {
            $max = 0;
        }

        return $max;
    }

    /**
     * Permite pagar los puntos binarios
     *
     * @return void
     */
    public function pointsBinary()
    {
        try {
            $ordenes = $this->getInversionesBonos();
            foreach ($ordenes as $orden) {
                $sponsors = $this->indexController->getSponsor($orden->iduser, [], 0, 'ID', 'position_id');
                $referido = User::find($orden->iduser);
                $side = $referido->ladomatrix;
                foreach ($sponsors as $sponsor) {
                    if ($sponsor->ID != $orden->iduser) {
                        if ($this->candadoBinario($sponsor->nivel, $sponsor->ID)) {
                            if ($this->indexController->statusBinary($sponsor->ID)) {
                                $pointI = 0;
                                $pointD = 0;
                                if ($side == 'D') {
                                    $pointD = $orden->invertido;
                                }else{
                                    $pointI = $orden->invertido;
                                }
                                
                                $concepto = 'Puntos Binarios del usuario '.$referido->display_name.' - de la inversion '.$orden->id;
                                $dataPoint = [
                                    'iduser' => $sponsor->ID,
                                    'idcompra' => $orden->id,
                                    'idreferido' => $referido->ID,
                                    'concepto' => $concepto,
                                    'point_left' => $pointI,
                                    'point_right' => $pointD,
                                    'side' => $side,
                                    'status' => 0,
                                ];
                                $this->savePoints($dataPoint);
                            }
                        }
                        $side = $sponsor->ladomatrix;
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite verificar si el usuario puede o no cobrar ciertos puntos binarios
     *
     * @param integer $nivel
     * @param integer $iduser
     * @return boolean
     */
    public function candadoBinario($nivel, $iduser): bool
    {
        $result = false;
        $invertido = $this->getMaxInversion($iduser);

        if ($invertido >= 500) {
            if ($nivel <= 4) {
                $result = true;
            }
        }
        if ($invertido >= 1000) {
            if ($nivel <= 6) {
                $result = true;
            }
        }
        if ($invertido >= 5000) {
            if ($nivel <= 10) {
                $result = true;
            }
        }
        if ($invertido >= 50000) {
            if ($nivel <= 20) {
                $result = true;
            }
        }
        if ($invertido >= 100000) {
            if ($nivel <= 30) {
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Permite guardar los puntos ganados
     *
     * @param array $data
     * @return void
     */
    public function savePoints($data)
    {
        $verificar = DB::table('wallet_point')->where([
            ['iduser', '=', $data['iduser']],
            ['idcompra', '=', $data['idcompra']],
            ['idreferido', '=',  $data['idreferido']],
        ])->first();
        if ($verificar == null) {
            $user = User::find($data['iduser']);
            $user->puntosizq = ($user->puntosizq + $data['point_left']);
            $user->puntosder = ($user->puntosder + $data['point_right']);
            $user->save();
            DB::table('wallet_point')->insert($data);
        }
    }

}

