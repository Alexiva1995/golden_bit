<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

use App\Settings;
use App\Sidebar;
use App\MenuAction;

class Core
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

        try{
            //
            $is_configured = $env->getValue("DB_DATABASE") == 'homestead' ? false : true;

            $_ifNotPathInitial = $request->segment(1) != 'install' && $request->path() != '/';

            $_defaultSettings = (object)[
                'name' => 'LEOPARDUS',
                'name_styled' => 'LEO<strong>PARDUS</stron>',
                'slogan' => 'Sistema hecho en PHP/Laravel para todo tipo de uso.', 
                'description' => 'Sistema hecho en PHP/Laravel para todo tipo de uso.'
            ];

            if( $is_configured ) {

                $_existSettingsTable = Schema::hasTable('settings');
                
                if( $_existSettingsTable ) {

                    $settings = Settings::first();

                    if(! $settings ) {
                        $settings = $_defaultSettings;
                    }

                    $isInstalled = true;
                    
                    $sidebar_menu = Sidebar::orderBy('order', 'asc')->get();

                    $action_menu = MenuAction::orderBy('order', 'asc')->get();
                    //
                    View::share( compact('sidebar_menu', 'action_menu', 'isInstalled') );

                }elseif( $_ifNotPathInitial ) {
                    header("Location:" . url('install/?step=2'));
                    exit;
                }
            } elseif( $_ifNotPathInitial ) {
                header("Location:" . url('install'));
                exit;
            }

            if( !$is_configured || !$_existSettingsTable ) {
                // Declaramos la configuración por defecto 
                $settings = $_defaultSettings;

                $isInstalled = false;
            }

            View::share(compact('settings', 'isInstalled'));

            // Response
            return $next($request);

        }catch(DotEnvException $e){
            echo $e->getMessage();
        }
    }
}
