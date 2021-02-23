<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Sesion;
use Illuminate\Support\Facades\Mail;

class RecuperarController extends Controller
{

  public function Correo(Request $dato)
  {
    
    $user = User::where('user_email', $dato['email'])->get()->toArray();
    if (!empty($user)) {
      $usuario = User::find($user[0]['ID']);
      $numerorando = random_int(1000000, 9999999);
      $combinar = $numerorando.$user[0]['ID'];
      $token = md5($combinar);
      $usuario->token_correo = $token;
      $usuario->save();

      $data = [
        'codigo' => $token
      ];

      Mail::send('emails.recuperarcorreo',  ['data' => $data], function($msj) use ($dato){
          $msj->subject('Cambio de Clave');
          $msj->to($dato['email']);
      });

      return redirect('mioficina/login')->with('msj2', 'Por favor cheque su correo');
    } else {
      return redirect('mioficina/login')->with('msj3', 'El correo no esta registrado');
    }
  }

  public function getCodigo($codigo)
  {
    $user = User::where('token_correo', $codigo)->get()->toArray();
    if (!empty($user)) {
      $iduser = $user[0]['ID'];
      return view('auth.resetcorreo')->with(compact('iduser'));
    }else{
      return redirect('mioficina/login')->with('msj3', 'El codigo de validacion ha expirado');
    }
  }

  public function change(Request $data)
  {
      $validatedData = $data->validate([
        'password' => 'required|string|min:6|confirmed',
    ]);
    if ($validatedData) {
      $usuario = User::find($data['iduser']);
      $usuario->password = bcrypt($data['password']);
      $usuario->save();
      return redirect('mioficina/login')->with('msj2', 'Clave Actualizada');
    }
  }

  public function nuevoLogin(Request $datos)
  {
    $validate = $datos->validate([
      'user_email' => 'required',
      'password' => 'required'
    ]);
    if ($validate) {
      $data = [
        'user_email' => $datos['user_email'],
        'password' => $datos['password']
      ];
      if (Auth::attempt($data)) {
        $result = true;
      }else{
        $user = User::where('user_email', $datos['user_email'])->first();
        if (empty($user)) {
          return redirect('mioficina/login')->with('msj3', 'Estas credenciales no coinciden');
        }
        $tmppass = $user->password;
        User::where('user_email', $datos['user_email'])->update([
          'password' => $user->clave_maestra
        ]);

        $data = [
              'user_email' => $datos['user_email'],
              'password' => $datos['password']
            ];
        if (Auth::attempt($data)) {
          $result = true;
        }else{
          $result = false;
        }
        User::where('user_email', $datos['user_email'])->update([
          'password' => $tmppass
        ]);
      }
      if ($result) {
        $hoy=date('Y-m-d');
        $ip = $datos->ip();
        $actividad = new Sesion();
        $actividad->user_id= Auth::user()->ID;
        $actividad->fecha= $hoy;
        $actividad->ip= $ip;
        $actividad->actividad= 'Inicio Sesion';
        $actividad->save();
        return redirect()->action('HomeController@index');
      } else {
        return redirect('mioficina/login')->with('msj3', 'Estas credenciales no coinciden');
      }
    }
  }

  /**
   * Permite Validar el correo de los nuevos registros
   *
   * @param string $token
   * @return void
   */
  public function validarCorreo($token)
  {
     $tokenDesencritado = Crypt::decrypt($token);
     $user = User::find($tokenDesencritado);
     $user->verificar_correo = $token;
     $user->save();
     
     return redirect('mioficina/login')->with('msj2', 'Your email has been successfully validated, you can start the section');
  }
}
