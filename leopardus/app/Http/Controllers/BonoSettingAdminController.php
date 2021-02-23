<?php

namespace App\Http\Controllers;

use App\SettingsBono;
use Illuminate\Http\Request;


class BonoSettingAdminController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Configuracion de bonos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $bonodirecto = SettingsBono::where('type_bono', 'directo')->first();
            $bonodirecto->settings_bono = json_decode($bonodirecto->settings_bono);
            $bonomatrix = SettingsBono::where('type_bono', 'matrix')->first();
            $bonomatrix->settings_bono = json_decode($bonomatrix->settings_bono);
            $bonoblackbox = SettingsBono::where('type_bono', 'blackbox')->first();
            $bonoblackbox->settings_bono = json_decode($bonoblackbox->settings_bono);
            return view('admin.bonosetting.index', compact('bonodirecto', 'bonomatrix', 'bonoblackbox'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'type_bono' => $request->type_bono,
                'settings_bono' => ''
            ];
            if ($request->type_bono == 'directo') {
                $request->validate([
                    'bd_bronce' => ['required', 'numeric'],
                    'bd_plata' => ['required', 'numeric'],
                    'bd_oro' => ['required', 'numeric'],
                ]);
                $data['settings_bono'] = json_encode($this->configurationDirecta($request));
            }

            if ($request->type_bono == 'blackbox') {
                $request->validate([
                    'blackbox' => ['required', 'numeric'],
                ]);
                $data['settings_bono'] = json_encode(['blackbox' => $request->blackbox]);
            }

            if ($request->type_bono == 'matrix') {
                for ($i=1; $i < 11; $i++) { 
                    $request->validate([
                        'bm_nivel'.$i => ['required', 'numeric'],
                    ]);
                }
                
                $data['settings_bono'] = json_encode($this->configurationMatrix($request));
            }

            SettingsBono::create($data);

            return redirect()->back()->with('msj', 'Configuracion exitosa del bono '.$request->type_bono);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite Realizar la configuracion del bono matriz
     *
     * @param object $request
     * @return array
     */
    public function configurationMatrix(object $request): array
    {
        $data = [];
        for ($i=1; $i < 11; $i++) { 
            $data[$i] = $request['bm_nivel'.$i];
        }
        return $data;
    }

    /**
     * Permite configurar las opciones para le nuevo bono
     *
     * @param object $request
     * @return array
     */
    public function configurationDirecta(object $request):array
    {
        $data = [
            'bronce' => ($request->bd_bronce / 100),
            'plata' => ($request->bd_plata / 100),
            'oro' => ($request->bd_oro / 100)
        ];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $data = [
                'type_bono' => $request->type_bono,
                'settings_bono' => ''
            ];
            if ($request->type_bono == 'directo') {
                $request->validate([
                    'bd_bronce' => ['required', 'numeric'],
                    'bd_plata' => ['required', 'numeric'],
                    'bd_oro' => ['required', 'numeric'],
                ]);
                $data['settings_bono'] = json_encode($this->configurationDirecta($request));
            }

            if ($request->type_bono == 'blackbox') {
                $request->validate([
                    'blackbox' => ['required', 'numeric'],
                ]);
                $data['settings_bono'] = json_encode(['blackbox' => $request->blackbox]);
            }

            if ($request->type_bono == 'matrix') {
                for ($i=1; $i < 11; $i++) { 
                    $request->validate([
                        'bm_nivel'.$i => ['required', 'numeric'],
                    ]);
                }
                
                $data['settings_bono'] = json_encode($this->configurationMatrix($request));
            }

            SettingsBono::where('id', $id)->update($data);

            return redirect()->back()->with('msj', 'Configuracion exitosa del bono '.$request->type_bono);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
