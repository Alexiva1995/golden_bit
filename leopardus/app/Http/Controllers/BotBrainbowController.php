<?php

namespace App\Http\Controllers;

use App\Botbrainbow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\BotImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BotBrainbowController extends Controller
{
    /**
     * Lleva a la vista para agregar los registro del bot
     *
     * @return void
     */
    public function index()
    {
        view()->share('title', 'Bot Brainbow');
        $botbrainbow = Botbrainbow::orderBy('id', 'desc')->get();
        
        return view('admin.botbrainbow', compact('botbrainbow'));
    }

    /**
     * Permite guardar los registro del bot
     *
     * @param Request $request
     * @return void
     */
    public function saveBotBrainbow(Request $request)
    {
        $validate = $request->validate([
            'fondo_inversion' => ['required', 'numeric'],
            'redes_neuronales' => ['required', 'numeric'],
            'acciones' => ['required', 'numeric'],
            'mes' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
        ]);
        if ($validate) {
            $data = $request->all();
            $this->updateBotBrainbow($data, true, 0);
            return redirect()->back()->with('msj', 'Registro Exitoso');
        }
    }

    public function updateBotBrainbow($data, $new, $idbotbrainbow)
    {
        if ($new) {
            Botbrainbow::create($data);
        }else{
            Botbrainbow::where('id', $idbotbrainbow)->update($data);
        }
    }

    /**
     * Permite saber si el nuevo registro es subio o bajo con respecto al ultimo registro
     *
     * @param string $fecha
     * @param float $valor
     * @return integer
     */
    public function getSubioBajo($fecha, $valor) : int
    {
        $botbrainbow = Botbrainbow::where('fecha_numerica', '<', $fecha)->first();
        $resul = 1;
        if (!empty($botbrainbow)) {
            if ($botbrainbow->cerrado > $valor) {
                $resul = 0;
            }
        }
        return $resul;
    }

    /**
     * Permite Actualizar los valores de los bot
     *
     * @param Request $request
     * @return void
     */
    public function updateBot(Request $request)
    {
        $validate = $request->validate([
            'fondo_inversion' => ['required', 'numeric'],
            'redes_neuronales' => ['required', 'numeric'],
            'acciones' => ['required', 'numeric'],
            'mes' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
        ]);
        if ($validate) {
            $data = [
                'fondo_inversion' => $request->fondo_inversion,
                'redes_neuronales' => $request->redes_neuronales,
                'acciones' => $request->acciones,
                'mes' => $request->mes,
                'year' => $request->year,
            ];
            $this->updateBotBrainbow($data, false, $request->idbot);

            return redirect()->back()->with('msj', 'Actualizar Registro Bot');
        }
    }

    /**
     * Permite obtener la grafica de brainbow
     *
     * @return void
     */
    public function getBotBrainbow()
    {
        $botBrainbow = Botbrainbow::select(
            DB::raw('SUM(fondo_inversion) as fondos'), 
            DB::raw('SUM(redes_neuronales) as redes'),
            DB::raw('SUM(acciones) as acciones'),
            'mes', 'year'
        )->where('year', '>=', '2018')->groupBy('mes', 'year')->orderBy('year', 'asc')->orderBy('mes')->get();
        $arrayMes = [
            1 => 'Ene', 2 => 'Feb', 3 => 'Mar', 4 => 'Abr', 5 => 'May', 6 => 'Jun',
            7 => 'Jul', 8 => 'Ago', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dic'
        ];
        $arrayFondo = [];
        $arrayRedes = [];
        $arrayAcciones = [];
        $arrayMeses = [];
        foreach ($botBrainbow as $bot) {
            $arrayFondo [] = $bot->fondos;
            $arrayRedes [] = $bot->redes;
            $arrayAcciones [] = $bot->acciones;
            $arrayMeses [] = $arrayMes[$bot->mes].' - '.$bot->year;
        }

		$dataGrafica = [
            'fondos' => $arrayFondo,
            'redes' => $arrayRedes,
            'acciones' => $arrayAcciones,
            'meses' => $arrayMeses,
            'year' => '2018 - '.Carbon::now()->format('Y')
        ];
		
        return json_encode($dataGrafica);
    }

    /**
     * Permite guardar la informacion por lotes de botbrainbow
     *
     * @param Request $request
     * @return void
     */
    public function saveBotExcel(Request $request)
    {
        $validate = $request->validate([
            'lote' => ['required', 'file', 'mimes:xls,xlsx,csv']
            ]);
        try {
            if ($validate) {
                Excel::import(new BotImport, $request->file('lote'));
    
                return redirect()->back()->with('msj', 'Informacion Agregada con exito');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show_bot()
    {
        view()->share('title', 'Bot Brainbow');
        return view('wallet.botbrainbow');
    }
}
