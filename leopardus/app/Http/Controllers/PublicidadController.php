<?php

namespace App\Http\Controllers;

use App\CheckPublicidad;
use App\CicloPublicidad;
use App\Publicidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function GuzzleHttp\json_decode;

class PublicidadController extends Controller
{

    function __construct()

	{

        // TITLE

		view()->share('title', 'Publicidad');

	}
    /**
     * lleva a la vista para crear las publicidad
     *
     * @return void
     */
    public function indexAdmin()
    {
        $publicidades = Publicidad::all();

        foreach ($publicidades as $publi) {
            $publi->img = asset('products/'.$publi->img);
        }

        return view('publicidad.index', compact('publicidades'));
    }

    /**
     * Permite guardar la informacion de la publicidad a compartir
     *
     * @param Request $request
     * @return void
     */
    public function savePublicidad(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'imagen' => 'image'
        ]);
        if ($validate) {
            $name = str_replace(' ', '-', $request->name);
            $routeLogo = '';
            if (!empty($request->file('imagen'))) {
                $file = $request->file('imagen');
                $routeLogo = $this->fileSave('publicidad', $file, 'publicidad_'.$name);
            }
            Publicidad::create([
                'titulo' => $request->name,
                'descripcion' => $request->content,
                'img' => $routeLogo,
            ]);

            return redirect()->back()->with('msj', 'Publicidad '.$request->name.' agregada');
        }
    }

    /**
     * Permite editar la informacion de la publicidad
     *
     * @param Request $request
     * @return void
     */
    public function editPublicidad(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'imagen' => 'image'
        ]);
        if ($validate) {
            $name = str_replace(' ', '-', $request->name);
            $routeLogo = '';
            if (!empty($request->file('imagen'))) {
                $file = $request->file('imagen');
                $routeLogo = $this->fileSave('publicidad', $file, 'publicidad_'.$name);
            }
            Publicidad::where('id', '=', $request->idproduct)->update([
                'titulo' => $request->name,
                'descripcion' => $request->content,
                'img' => $routeLogo,
            ]);

            return redirect()->back()->with('msj', 'Publicidad '.$request->name.' actualizada');
        }
    }

    /**
     * Permite eliminar la publicidad del sistema
     *
     * @param integer $id
     * @return void
     */
    public function deletePublicidad($id)
    {
        $nametmp = '';

        $publi = Publicidad::find($id);
        $nametmp = $publi->titulo;
        $publi->delete();

        return redirect()->back()->with('msj', 'Publicidad '.$nametmp.' borrado sastifactoriamente');
    }

    /**
     * Permite guardar los archivos y devuelve la ruta para acceder a ella
     *
     * @param string $directory
     * @param object $file
     * @param string $nameProduct
     * @return string
     */
    public function fileSave(string $directory, $file, string $nameProduct) : string
    {
        $namePhoto = Str::slug($nameProduct.''.now()->format('Ymd'), '_');
        $nameExtention = $namePhoto.'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $nameExtention, 'assets');
        $asset_path = $path;
        return $asset_path;
    }

    /**
     * Permite obtener y verificar si las publicidad ya fue compartidad
     *
     * @param integer $iduser
     * @return array
     */
    public function getPublicidadCompartir($iduser): array
    {
        $publicidades = Publicidad::all();
        $fechaActual = Carbon::now();
        $arregPublicidad = [];
        $redes = ['facebook'];
        foreach ($publicidades as $publi) {
            $social = [];
            foreach ($redes as $redsocial) {
                $checkPublicidad = CheckPublicidad::where([
                    ['iduser', '=', $iduser],
                    ['idpublicidad', '=', $publi->id],
                    ['fecha', '=', $fechaActual->format('Y-m-d')],
                    ['red_social', '=', $redsocial]
                ])->first();
                if (empty($checkPublicidad)) {
                    $social [] = $redsocial;
                }
            }
            if (!empty($social)) {
                $publi->img = asset('products/'.$publi->img);
                $publi->social = $social;
                $arregPublicidad [] = $publi;
            }
        }
        return $arregPublicidad;
    }

    /**
     * Lleva a la vista de publicidad de los usuario
     *
     * @return void
     */
    public function indexUser()
    {
        $publicidades = $this->getPublicidadCompartir(Auth::user()->ID);

        return view('publicidad.indexUser', compact('publicidades'));
    }

    /**
     * Permite llamar a las funciones para el guardado de la publicacion realizada por el usuario
     *
     * @param Request $request
     * @return void
     */
    public function compartido(Request $request)
    {

        if (!$this->checkCompletado()) {
            if (!$this->checkCiclo()) {
                CheckPublicidad::create([
                    'iduser' => Auth::user()->ID,
                    'idpublicidad' => $request->id,
                    'fecha' => Carbon::now(),
                    'red_social' => $request->social
                ]);
                $this->saveCiclo();
            }
        }


    }

    /**
     * Permite saber si un usuario ya completo su ciclo de publicidad
     *
     * @return void
     */
    public function checkCompletado()
    {
        $result = false;
        $fechatmpSemana = Carbon::now();
        $semana = $fechatmpSemana->weekOfYear;
        $year = $fechatmpSemana->year;
        $completado = CicloPublicidad::where([
            ['iduser', '=', Auth::user()->ID],
            ['completado', '=', 1],
            ['semana', '=', $semana],
            ['year', '=', $year]
        ])->first();
        if (!empty($completado)) {
            $result = true;
        }
        return $result;
    }

    /**
     * Permite saber el estado del ciclo de publicidad diario
     *
     * @return void
     */
    public function checkCiclo()
    {
        $result = false;
        $arreDia = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miercoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sabado',
            7 => 'Domingo'
        ];
        $fechatmpSemana = Carbon::now();
        $semana = $fechatmpSemana->weekOfYear;
        $year = $fechatmpSemana->year;
        $completado = CicloPublicidad::where([
            ['iduser', '=', Auth::user()->ID],
            ['completado', '=', 0],
            ['semana', '=', $semana],
            ['year', '=', $year]
        ])->first();
        if (!empty($completado)) {
            $ciclo = json_decode($completado->ciclo);
            foreach ($ciclo as $index => $value) {
                if ($index == $arreDia[$fechatmpSemana->dayOfWeekIso]) {
                    if ($value['status'] == 1) {
                        $result = true;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Permite guardar e actualizar la informacion del ciclo de publicidad
     *
     * @return void
     */
    public function saveCiclo()
    {
        $arreDia = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miercoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sabado',
            7 => 'Domingo'
        ];
        $arreCiclo = [
            'Lunes',
            'Martes',
            'Miercoles',
            'Jueves',
            'Viernes',
            'Sabado',
            'Domingo'
        ];
        $fechatmpSemana = Carbon::now();
        $semana = $fechatmpSemana->weekOfYear;
        $year = $fechatmpSemana->year;
        $paquete = json_decode(Auth::user()->paquete);
        $completado = CicloPublicidad::where([
            ['iduser', '=', Auth::user()->ID],
            ['completado', '=', 0],
            ['semana', '=', $semana],
            ['year', '=', $year]
        ])->first();
        if (!empty($completado)) {
            $ciclo = json_decode($completado->ciclo);
            $cant = $ciclo[$arreDia[$fechatmpSemana->dayOfWeekIso]]['cant'];
            $ciclo[$arreDia[$fechatmpSemana->dayOfWeekIso]]['cant'] = ($cant + 1);
            if ($ciclo[$arreDia[$fechatmpSemana->dayOfWeekIso]]['cant'] >= $paquete->limite) {
                $ciclo[$arreDia[$fechatmpSemana->dayOfWeekIso]]['status'] = 1;
            }
            $cantCompletado = 0;
            foreach ($ciclo as $elemt) {
                if ($elemt['status'] == 1) {
                    $cantCompletado++;
                }
            }
            if ($cantCompletado >= 7) {
                $completado->completado == 1;
            }
            $completado->ciclo = json_encode($ciclo);
            $completado->save();
        }else{
            $ciclo = [];
            foreach ($arreCiclo as $element) {
                if ($element == $arreDia[$fechatmpSemana->dayOfWeekIso]) {
                    $ciclo[$element] = [
                        'cant' => 1,
                        'status' => 0
                    ];
                }else{
                    $ciclo[$element] = [
                        'cant' => 0,
                        'status' => 0
                    ];
                }
            }
            CicloPublicidad::create([
                'iduser' => Auth::user()->ID,
                'ciclo' => json_encode($ciclo),
                'completado' => 0,
                'semana' => $semana,
                'year' => $year
            ]);
        }
    }

    /**
     * Permite obtener la informacion de las publicaciones diarias
     *
     * @return void
     */
    public function getInfoDiario()
    {
        $arregloGrafica = [];
        $fechatmpSemana = Carbon::now();
        $semana = $fechatmpSemana->weekOfYear;
        $year = $fechatmpSemana->year;
        $completado = CicloPublicidad::where([
            ['iduser', '=', Auth::user()->ID],
            ['completado', '=', 0],
            ['semana', '=', $semana],
            ['year', '=', $year]
        ])->first();
        if (!empty($completado)) {
            $ciclo = json_decode($completado->ciclo);
            foreach ($ciclo as $dia) {
                $arregloGrafica [] = $dia->cant;
            }
        }else{
            $arregloGrafica = [0, 0, 0, 0, 0, 0, 0];
        }
        return $arregloGrafica;
    }
}
