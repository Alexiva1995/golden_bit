<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;
use App\Settings;
use Closure; use DB;

class Intall
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
        $env = new DotenvEditor();

        try {
            $is_bd = ($env->getValue('DB_DATABASE') == 'homestead') ? false : true;
            
            $_ifNotPathInitial = $request->segment(1) != 'installer' && $request->path() != '/';
            if ($is_bd) {
                $settings = Settings::first();
                $settings->valor_niveles = json_decode($settings->valor_niveles);
                if (!empty($settings)) {

                    View::share(compact('settings'));

                } elseif($_ifNotPathInitial) {
                    return redirect()->route('install-step2');
                    exit;    
                }
                
            }elseif($_ifNotPathInitial){
                return redirect()->route('install-step1');
                exit;
            }   

        } catch (DotEnvException $e) {
            echo $e->getMessage();
        }   
        
        return $next($request);
    }
}
