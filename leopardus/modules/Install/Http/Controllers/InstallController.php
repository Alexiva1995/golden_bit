<?php

namespace Modules\Install\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

use \Artisan;
use App\Settings;
Use App\User;
use \Auth;

class InstallController extends Controller
{
    /**
     * Instalador del sistema.
     * @return View
     */
    public function index(Request $request)
    {
        // Obtenemos las configuraciones
        $env = new DotenvEditor();

        try{
            // Comprobamos si ya se configuro el .env
            $is_configured = $env->getValue("DB_DATABASE") == 'homestead' ? false : true;

            if( $is_configured && $request->input('step', 1) < 2 ) {
                return redirect('install?step=2');
            }

            // Titulo de la pagina.
            $page = 'Instalador del sistema';
            
            // Paso actual
            $step = $request->input('step', 1);
            
            // Share
            view()->share( compact('page', 'step') );
            
            //
            return view('install::index');

        }catch(DotEnvException $e){
            echo $e->getMessage();
        }
    }

    /**
     * Procesa la información enviada a través de los formularios
     * al instalar el sistema.
     * @return Redirect
     */
    public function processing(Request $request)
    {
        switch ($request->step) {
            case '1':
                try {
                    // Creamos las reglas de validación
                    $validator = \Validator::make($request->all(), [
                        'host' => 'required',
                        'user' => 'required',
                        'pass' => '',
                        'bd' =>   'required'
                    ]);

                    if ($validator->fails()) {
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput();
                    }

                    // Comprobar conexion a la base de datos
                    // si los datos no son correctos enviar mensaje de error.
                    $connection = @mysqli_connect(
                        $request->input('host'),
                        $request->input('user'),
                        $request->input('pass'),
                        $request->input('bd')
                    );

                    if (!$connection) {
                        return redirect()
                                ->back()
                                ->withErrors([
                                    'Imposible conectar a la base de datos. Error: ' . mysqli_connect_error()
                                ])
                                ->withInput();
                    }

                    /* Cierra la conexión */
                    mysqli_close($connection);

                    $env = new DotenvEditor();

                    // Cambimos el .env
                    $env->changeEnv([
                       'DB_DATABASE'   => $request->input('bd'),
                       'DB_USERNAME'   => $request->input('user'),
                       'DB_PASSWORD'   => $request->input('pass'),
                       'DB_HOST'       => $request->input('host'),
                    ]);

                    return redirect('install?step=2');

                } catch (Exception $e) {
                    return redirect()->back()->withErrors([$e])->withInput();
                }
                break;

            case '2':
                try {
                    // Validamos los campos.
                    $validator = \Validator::make($request->all(), [
                        'title' => 'required',
                        'slogan' => 'required',
                        'name' => 'required',
                        'email' =>   'required',
                        'pass' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput();
                    }

                    $env = new DotenvEditor();

                    // Cambimos el .env
                    $env->changeEnv([
                       'APP_URL'   => $request->input('url')
                    ]);

                    // Establecemos el tiempo de respuesta maximo a 5min.
                    set_time_limit(3000);

                    // Ejecutamos las migraciones
                    $migrate = \Artisan::call('migrate', ['--seed' => true]);

                    // Creamos la configuración
                    $settings = new Settings;
                    $settings->name = $request->input('title');
                    $settings->name_styled = $request->input('title');
                    $settings->slogan = $request->input('slogan');
                    $settings->site_email = $request->input('email');
                    $settings->description = $request->input('description');
                    $settings->save();

                    // Creamos el usuario administrador
                    $admin = new User;
                    $admin->name = $request->input('name');
                    $admin->email = $request->input('email');
                    $admin->password = \Hash::make($request->input('pass'));
                    $admin->save();

                    // Agregamos el rango

                    // Autenticamos al usuario
                    Auth::login($admin);

                    // Redirigimos al usuario
                    return redirect('/');

                } catch (Exception $e) {
                    return redirect()->back()->withErrors([$e])->withInput();
                }
                break;
            
            default:
                return redirect()->back();
                break;
        }
    }
}
