<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Settings;
use App\User;
use App\Rol;
use App\SettingsEstructura;
use Modules\ReferralTree\Http\Controllers\ReferralTreeController;


use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer as BaconQrCodeWriter;

class ActualizarController extends Controller
{
    /**
     * Lleva la vista donde el usuario actualiza su perfil
     *
     * @return void
     */
    public function editProfile(){
        // TITLE
        view()->share('title', 'Editar Perfil');

        // DO MENU
        view()->share('do', collect(['name' => 'editProfile', 'text' => 'Editar Perfil']));
    
        $data = $this->infoUsuario(Auth::user()->ID);

        return view('dashboard.editProfile')->with(compact('data'));
    }

    /**
     * permite llenar la informacion del usuario en cuestion
     *
     * @param int $id - id de usuario
     * @return void
     */
    public function infoUsuario($id)
    {
        $user = User::find($id);
        if ($user->check_token_google == 0) {
            $user->update(['toke_google' => (new Google2FA)->generateSecretKey()]);
        }
        $data = [
            'principal' => $user,
            'segundo' => DB::table('user_campo')->where('ID', $user->ID)->get(),
            'rol' => Rol::find($user->rol_id),
            'referido' => (Auth::user()->rol_id != 0) ? User::find($user->referred_id)->only('display_name') : ['display_name' => 'Administrador'] ,
            'controler' => 'ActualizarController@updateProfile',
            'urlqr' => $this->createUserUrlQR($user)
        ];

        $data['segundo'] = $data['segundo'][0];
        return $data;
    }


    public function createUserUrlQR($user)
    {
        
        $renderer = new Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $bacon = new BaconQrCodeWriter($renderer);
    
        $data = $bacon->writeString(
            (new Google2FA)->getQRCodeUrl(
                config('app.name'),
                $user->user_email,
                $user->toke_google
            ), 'utf-8');
    
        return 'data:image/png;base64,' . base64_encode($data);
    }

    /**
     * Lleva a la vista donde el admin Actualiza el perfil de un usuario
     *
     * @param int $id
     * @return void
     */
    public function user_edit($id){
        // TITLE
        view()->share('title', 'Lista de Usuarios');

        // DO MENU
        view()->share('do', collect(['name' => 'editProfile', 'text' => 'Editar Perfil']));

        $data = $this->infoUsuario($id);

        return view('admin.userEdit')->with(compact('data'));
    }
    
    /**
     * Permite Actualizar la informacion de los usuario
     *
     * @param Request $request
     * @return view
     */
    public function updateProfile(Request $request){
        $settings = Settings::find(1);
        $settingEstructura = SettingsEstructura::find(1);
        $concepto = 'La sección '.$request->data.' ha sido actualizada ';
        $user = User::find($request->id);

        if ($request->data == 'general'){
            $validate = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'genero' => 'required',
                'edad' => 'required',
                'nameuser' => 'required'
            ]);
           if ($validate) {
                DB::table('user_campo')
                    ->where('ID', '=', $user->ID)
                    ->update([
                            'firstname' => $request['firstname'], 
                            'lastname' => $request['lastname'], 
                            'genero' => $request['genero'],
                            'edad' => $request['edad'],
                            'nameuser' => $request['nameuser']
                            ]);

                $user->display_name = $request['firstname'].' '.$request['lastname'];
                $user->birthdate = $request['edad'];
                $user->gender = $request['genero'];
                $user->user_nicename = $request['nameuser'];
                $user->user_login = $request['nameuser'];
                
                if (Auth::user()->rol_id == 0) {
                    $validate2 = $request->validate([
                        'id_position' => 'required',
                        'id_referred' => 'required'
                    ]);
                    
                    if ($validate2) {
                        if ($settingEstructura->tipoestructura != 'arbol') {
                            if ($user->position_id != $request['id_position']) {
                                $consulta=new ReferralTreeController;
                                $auspiciador = $consulta->getPosition($request['id_position'], $user->ladomatrix);
                                if ($auspiciador != $request['id_position']) {
                                    return redirect()->back()->with('msj2', 'The Positioning ID Supplied ('.$request['id_position'].') Has Its Locations Full, We recommend this Positioning ID ('.$auspiciador.') ');
                                }else{
                                    $user->position_id = $auspiciador;
                                }
                            }else{
                                $user->position_id = $request['id_position'];
                            }
                        }
                        $user->referred_id = $request['id_referred'];
                    }
                }
                $user->save();
           }
        }elseif ($request->data == 'contacto'){
            $validate = $request->validate([
                'clave' => 'confirmed',
                'dirección' => 'required',
                'codigo' => 'numeric',
                'phone' => 'numeric',
                'fijo' => 'numeric'
            ]);
            
            if ($validate) {
                if ($user->user_email != $request->user_email) {
                    $validate2 = $request->validate([
                        'user_email' => 'required|max:100|unique:'.$settings->prefijo_wp.'users|confirmed',
                    ]);
                    if ($validate2) {
                        $user->user_email = $request->user_email;
                    }
                }
                
                $user->save();
                
                DB::table('user_campo')
                    ->where('ID', '=', $user->ID)
                    ->update([
                        'direccion' => $request['dirección'], 
                        'direccion2' => $request['direccion2'], 
                        'pais' => $request['pais'],
                        'estado' => $request['estado'],
                        'ciudad' => $request['ciudad'],
                        'codigo' => $request['codigo'],
                        'phone' => $request['phone'],
                        'fijo' => $request['fijo'],
                        ]);
            }
        }elseif($request->data == 'password'){
            $validate = $request->validate([
                'clave' => 'confirmed',
                'code' => 'required'
            ]);

            if ((new Google2FA())->verifyKey(Auth::user()->toke_google, $request->code)) {
                $user->user_pass = md5($request->clave);
                $user->password = bcrypt($request->clave);
                $user->clave = encrypt($request->clave);
                $user->save();
            }else{
                return redirect()->back()->with('msj3', 'el codigo es incorrecto');
            }
            
        }elseif ($request->data == 'social'){
            DB::table('user_campo')
           ->where('ID', '=', $user->ID)
           ->update([
                    'facebook' => $request['facebook'], 
                    'twitter' => $request['twitter'], 
                    ]);
            
            
        }elseif ($request->data == 'avatar_arbol'){
            $user = User::find($request->id);
            $user->icono_activo = $request->icon_activo;
            $user->icono_inactivo = $request->icon_inactivo;
            $user->save();
            // $validate = $request->validate([
            //     'cuenta' => 'numeric',
            //     'pan' => 'numeric'
            // ]);
            // if ($validate) {
            //     DB::table('user_campo')
            //     ->where('ID', '=', $user->ID)
            //     ->update([
            //                 'banco' => $request['banco'], 
            //                 'Branch' => $request['Branch'], 
            //                 'titular' => $request['titular'], 
            //                 'cuenta' => $request['cuenta'], 
            //                 'ifsc' => $request['ifsc'], 
            //                 'pan' => $request['pan'], 
            //                 ]);
            // }
            
        }elseif ($request->data == 'pago'){
         
          DB::table('user_campo')
                ->where('ID', '=', $user->ID)
                ->update([
                            'paypal' => $request['paypal'], 
                            'blocktrail' => $request['blocktrail'], 
                            'blockchain' => $request['blockchain'], 
                            'bitgo' => $request['bitgo'], 
                            'pago' => $request['pago'], 
                            ]);   
        }
        elseif($request->data == '2fact'){
            $validate = $request->validate([
                'code' => 'required|numeric'
            ]);

            if ((new Google2FA())->verifyKey(Auth::user()->toke_google, $request->code)) {
                $user->check_token_google = 1;
                $user->save();
                $concepto = 'Su validacion 2fact configurada con exito';
            }else{
                return redirect()->back()->with('msj', 'el codigo es incorrecto');
            }
        }
      

        if (Auth::user()->rol_id != 0){
            return redirect('mioficina/admin/user/edit')->with('msj', $concepto);
        }else{
            return redirect()->back()->with('msj', $concepto.' del usuario '.$user->display_name);
        }

    }
    /**
     * Permite Actualizar la imagen del usuario
     *
     * @param Request $request
     * @param int $id -> ID del usuario
     * @return void
     */
    public function actualizar(Request $request, $id)
    {
        $validate = $request->validate([
            'avatar' => ['required', 'file', 'size:800', 'mimes:jpeg,png']
        ]);
       if ($validate) {
            $user = User::find($id);
        
            if ($request->file('avatar')) {
                $imagen = $request->file('avatar');
                $nombre_imagen = 'user_'.$id.'_'.time().'.'.$imagen->getClientOriginalExtension();
                $path = public_path() .'/avatar';
                // if ($user->avatar != 'avatar.png') {
                //     unlink($path.'/'.$user->avatar);
                // }
                
                $imagen->move($path,$nombre_imagen);
                $user->avatar = $nombre_imagen;
                $user->save();
                return redirect()->back()->with('msj', 'La imagen ha sido actualizada');
            }else{
                return redirect()->back()->with('msj', 'Hubo un problema con la imagen');
            }
       }
    }

}
