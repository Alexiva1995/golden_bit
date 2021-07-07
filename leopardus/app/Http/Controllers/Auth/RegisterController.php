<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Crypt;
use PragmaRX\Google2FA\Google2FA;
use App\User; use App\Settings; 
use Carbon\Carbon;

use App\Formulario;
use App\Http\Controllers\InversionController;
use App\OpcionesSelect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SettingCorreo;

use Modules\ReferralTree\Http\Controllers\ReferralTreeController;




class RegisterController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        view()->share('title', 'Nuevo Registro');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $settings = Settings::first();
        return Validator::make($data, [
            'user_email' => 'required|string|email|max:100|unique:'.$settings->prefijo_wp.'users|confirmed',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function creater(Request $data)
    {
            // Veririca si un usuario solo se guardo en la tabla principal y lo borra para el registro
            $verificarUser = User::where('user_email', $data['user_email'])->get()->toArray();
            if (!empty($verificarUser)) {
                $verificarUser2 = DB::table('user_campo')->where('ID', $verificarUser[0]['ID'])->get()->toArray();
                if (empty($verificarUser2)) {
                    $borrar = User::find($verificarUser[0]['ID']);
                    $borrar->delete();
                }
            }
            // Permite validar los campos dinamicos
            $settings = Settings::first();
            $campos = Formulario::where('estado', 1)->get();
            foreach($campos as $campo){
                if($campo->unico ==1){
                    $validatedData = $data->validate([
                        $campo->nameinput => 'unique:user_campo',
                        // $campo->nameinput => 'unique:'.$settings->prefijo_wp.'users'
                    ]);   
                }
            }
            // Permite validar los campos estaticos
            $validatedData = $data->validate([
                'user_email' => 'required|string|email|max:100|unique:'.$settings->prefijo_wp.'users|confirmed',
                'password' => 'required|string|min:6|confirmed',
                'terms' => 'required'
            ]);
        try {
            // Obtenemos las configuraciones por defecto
            $settings = Settings::first();
            // $settingEstructura = SettingsEstructura::find(1);
            // Usuario referido por defecto.
            // 0: NONE.
            $user_id_default = $settings->referred_id_default;
            // Obtenemos el referido.
            $referido = 2;
            if(isset($data['referred_id'])){
                if (empty($data['referred_id'])) {
                    $data['referred_id'] = 1;
                }
                if ($this->VerificarUser($data['referred_id'])) {
                    return redirect()->back()->withInput()->with('msj2', 'El ID ('.$data['referred_id'].') del usuario no esta registrado, Intente con otro ID');
                }
                $referido =  $data['referred_id'];
                $data['ladomatrix'] = User::find($referido)->only('ladoregistrar')['ladoregistrar'];
            }
            // $vericarAdmin = User::where('referred_id', $referido)->get()->count('ID');
            // if ($referido == 1 && $vericarAdmin >= 1) {
            //     return redirect()->back()->withInput()->with('msj2', 'El Admin no puede tener referidos');
            // }
            $posicion = 0;
            // Permite verificar si el ID posicionamiento suministrado es valido
            // if (empty($data['position_id'])) {
            //     if ($settingEstructura->tipoestructura != 'arbol') {
            //         $consulta=new ReferralTreeController;
            //         $auspiciador = $consulta->getPosition($referido);
            //         $posicion = $auspiciador;
            //     }else{
            //         $posicion = $referido;
            //     }
            // } else {
            //     if ($this->VerificarUser($data['position_id'])) {
            //         return redirect()->back()->withInput()->with('msj2', 'El Usuario con el ID Posicionamiento Suministrado ('.$data['position_id'].') No Se Encuentra Registrado, Pruebe Con Otro');
            //     }
            //     if ($settingEstructura->tipoestructura != 'arbol') {
            //         $consulta=new ReferralTreeController;
            //         $auspiciador = $consulta->getPosition($data['position_id']);
            //         if ($auspiciador != $data['position_id']) {
            //             return redirect()->back()->withInput()->with('msj2', 'El ID Posicionamiento Suministrado ('.$data['position_id'].') Tiene Sus Lugares LLeno, le Recomendamos este ID Posicionamiento ('.$auspiciador.') ');
            //         }
            //     }
            //     $posicion = $data['position_id'];
            // }
            if ($data['ladomatrix'] == 'I') {
                $consulta=new ReferralTreeController;
                $resultado = $consulta->getPosition($referido, $data['ladomatrix']);
                $posicion = $resultado;
                // $data['ladomatrix'] = $resultado['lado'];
            }else{
                $consulta=new ReferralTreeController;
                $resultado = $consulta->getPosition($referido, $data['ladomatrix']);
                $posicion = $resultado;
                // $data['ladomatrix'] = $resultado['lado'];
            }
            $paquete = [
                'nombre' => 'Gold',
                'fecha' => Carbon::now()->addMonth()->format('Y-m-d'),
                'code' => 1
            ];
            $user = User::create([
                'user_email' => $data['user_email'],
                'user_status' => '0',
                'user_registered' => Carbon::now(),
                'user_pass' => md5($data['password']),
                'password' => bcrypt($data['password']),
                'clave' => encrypt($data['password']),
                'referred_id' => $referido,
                'sponsor_id' => $posicion,
                'position_id' => $posicion,
                'ladomatrix' => $data['ladomatrix'],
                'tipouser' => $data['tipouser'],
                'status' => '0',
                'paquete' => json_encode($paquete),
            ]);
            
            if (!empty($data['inversion'])) {
                $this->agregarInversion($data['inversion'], $user->ID);
            }


            $this->insertarCampoUser($user->ID, $data);

            // inserta en usermeta
            $this->insertUserMeta($user);
            //********************************
            $nombrecompleto = $data['firstname'].' '.$data['lastname'];
            $plantilla = SettingCorreo::find(1);
            if (!empty($plantilla->contenido)) {
                $token = Crypt::encrypt($user->ID);
                $rutacorreo = route('autenticacion-validar-correo', $token);
                $mensaje = str_replace('@nombre', ' '.$nombrecompleto.' ', $plantilla->contenido);
                $mensaje = str_replace('@clave', ' '.$data['password'].' ', $mensaje);
                $mensaje = str_replace('@correo', ' '.$data['user_email'].' ', $mensaje);
                $mensaje = str_replace('@usuario', ' '.$data['nameuser'].' ', $mensaje);
                $mensaje = str_replace('@idpatrocinio', ' '.$referido.' ', $mensaje);
                if (env('DB_USERNAME') != 'root') {
                    Mail::send('emails.plantilla',  ['data' => $mensaje, 'ruta' => ''], function($msj) use ($plantilla, $data){
                        $msj->subject('Bienvenido a Goldenbit');
                        $msj->to($data['user_email']);
                    });
                    $userreferido = User::find($referido);
                    // Mail::send('emails.directos', [], function($msj) use ($userreferido){
                    //     $msj->subject('Nuevo Referido Directo');
                    //     $msj->to($userreferido->user_email);
                    // });
                }
            }else{
                $deleteuser = User::find($user->ID);
                DB::table('user_campo')->where('ID', $user->ID)->delete();
                $deleteuser->delete();
                return redirect()->back()->withInput()->with('msj2', 'El Registro no fue valido, la configuracion del correo no esta configurada, consulte con su administrador');
            }
            // $redirect = 'autentication/register?referred_id='.$referido;
            // $tmp = explode('mioficina', request()->root());
            // $redirect = $tmp[0].'tienda';
            Auth::guard()->login($user);
            return redirect()->action('HomeController@index')->with('msj', 'Se Registrado Exitosamente');
        } catch (\Throwable $th) {
            \Log::error('Registrar -> '.$th);
            // dd($th);
            return redirect()->back()->withInput()->with('msj2', 'El Registro no fue valido, hubo un error en el proceso de registro, contacte con el adminitrador');
        }

    }


    /**
     * Permite Obtener una id aleatoria
     *
     * @return void
     */
    public function IdRamdon()
    {
        $allUsersCount = User::where('ID', '!=', 1)->select('ID')->get();
        $IDs = [];
        foreach ($allUsersCount as $id) {
            $IDs [] = $id->ID;
        };
        $positionID = random_int(1, count($IDs));
        if (count($IDs) == $positionID) {
            $positionID = $positionID -1;
        }
        return $IDs[$positionID];
    }



    /**

     * Guarda la informacion de los usuario 

     * 

     * Permite Guardar la informacion de lo usuario de los campos nuevos creados

     * 

     * @access private

     * @param int $userid - id usuarios, array $data - informacion del usuario

     */

    private function insertarCampoUser($userid, $data)

    {

        $formulario = Formulario::where('estado', 1)->get();

        $arraytpm [] = ['ID' => $userid];

        $arrayuser = [];

        foreach ($formulario as $campo) {

            $arraytpm [] = [

                ''.$campo->nameinput.'' => $data[$campo->nameinput]

            ];

        }

        

        $arrayuser = $arraytpm[0];

        for ($i= 1 ; $i < count($arraytpm); $i++) { 

            $arrayuser = array_merge($arrayuser,$arraytpm[$i]);

        }

        DB::table('user_campo')->insert($arrayuser);

    }

    /**

     * crea el nuevo formulario con los campos dinamicos

     * 

     * @access public

     * @return {view}

     */

    public function newRegister()

    {

        $settings = Settings::first();

        $campos = Formulario::where('estado', 1)->get();

        $valoresSelect = [];

        foreach ($campos as $campo) {

            array_push($valoresSelect, OpcionesSelect::find($campo['id']));

        }

        $patrocinadores = User::where('ID', '!=', 1)->orderBy('id')->get();
        if (!empty(Auth::user()->ID)){
            return view('auth.register')->with(compact('campos', 'valoresSelect', 'settings', 'patrocinadores'));
        }else{
            return view('auth.register2')->with(compact('campos', 'valoresSelect', 'settings', 'patrocinadores'));
        }
    }



    /**

     * Guarda la informacion de los usuario en la tabla de wordpress

     * 

     * @access private

     * @param array $data informacion de los usuarios

     */

    private function insertUserMeta($data)

    {

        $settings = Settings::first();

        DB::table($settings->prefijo_wp.'usermeta')->insert([

            ['user_id' => $data->ID, 'meta_key' => 'nickname', 'meta_value' => $data->user_email],

            ['user_id' => $data->ID, 'meta_key' => 'first_name', 'meta_value' => $data->display_name],

            ['user_id' => $data->ID, 'meta_key' => 'last_name', 'meta_value' => $data->display_name],

            ['user_id' => $data->ID, 'meta_key' => $settings->prefijo_wp.'capabilities', 'meta_value' => 'a:1:{s:10:"subscriber";b:1;}'],

            ['user_id' => $data->ID, 'meta_key' => 'billing_first_name', 'meta_value' => $data->display_name],

            ['user_id' => $data->ID, 'meta_key' => 'billing_last_name', 'meta_value' => $data->display_name],

            ['user_id' => $data->ID, 'meta_key' => 'billing_email', 'meta_value' => $data->user_email],

            ['user_id' => $data->ID, 'meta_key' => 'billing_phone', 'meta_value' => $data->phone],

        ]);

    }

    /**
     * Permite agregar y procesar una inversion a un usuario 
     *
     * @param float $inversion
     * @param integer $iduser
     * @return void
     */
    public function agregarInversion($inversion, $iduser)
    {
        $inversionController = new InversionController();
        
        $idOrden = $inversionController->saveOrden($inversion, 0);

        $txn_id = base64_encode('Admin-'.Carbon::now()->format('Ymd-His'));

        DB::table('coinpayment_transactions')->insert([
            'txn_id' => $txn_id,
            'address' => 'Manual',
            'status' => 100,
            'idorden' => $idOrden,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now()
        ]);

        DB::table('orden_inversiones')->where('id', $idOrden)->update([
            'iduser' => $iduser,
            'idtrasancion' => $txn_id
        ]);
        
        $inversionController->ActivarManualesCompras();
    }

    /**

     * Permite Verificar si los usuarios o id suministrado existen

     *

     * @param int $id

     * @return bolean

     */

    public function VerificarUser($id)

    {

        $resul = true;

        $user = User::where('ID', $id)->get()->toArray();

        if (!empty($user)) {

            $resul = false;

        }

        return $resul;

    }

    public function fact2()
    {
        return view('auth.2fact');
    }

    public function validar2fact(Request $request)
    {
        if ((new Google2FA())->verifyKey(Auth::user()->toke_google, $request->code)) {
            return redirect('mioficina/admin');
        }else{
            return redirect()->back()->with('msj2', 'codigo incorreto');
        }
    }

}

