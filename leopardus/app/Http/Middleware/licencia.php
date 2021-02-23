<?php

namespace App\Http\Middleware;

use Closure;
use App\Settings;
use Carbon\Carbon;
// use App\Http\Requests;
use Illuminate\Http\Request;

class licencia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $setting = Settings::first();
        // $fecha = new Carbon;
        // $fecha_v = new Carbon($setting->fecha_vencimiento);
        if(!request()->secure())
        {
            return redirect()->secure(request()->getPathInfo(),301);
        }
        // if (!empty($setting->licencia)) {
        //     if ($fecha->now() > $fecha_v) {
        //         return redirect('login')->with('msj3', 'Licencia Caducada, Comuniquese con el Administrador');    
        //     }
        // }else{
        //     return redirect('login')->with('msj3', 'Licencia no Registrada, Comuniquese con el Administrador');
        // }
        return $next($request);
    }
}
