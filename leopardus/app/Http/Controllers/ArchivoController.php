<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon; use App\Archivo;use App\Contenido;

use App\Http\Controllers\NotificationController;

class ArchivoController extends Controller
{
	function __construct()
	{
        // TITLE
	     view()->share('title', 'Agregar Material');
	     Carbon::setLocale('es');
	}
	//gestion de material
	public function subir()
	{
	   return view('archivo.subir');  
	}
	
	 public function subida(Request $request)
    {
          $validatedData = $request->validate([
          'titulo' => 'required|max:190',
          'contenido' => 'required|max:190',
          'archivo' => 'required|mimes:jpg,jpeg,png,xls,xlsx,doc,docx,pdf'
          ]);
          
          if ($request->file('archivo')) {
               $file = $request->file('archivo');
               $name = 'archivo_'. time(). '.'.$file->getClientOriginalExtension();
               $path = public_path() . '/archivo';
               $file->move($path, $name);
          }
          $archivo = new Archivo();
          $archivo->titulo=$request->titulo;
          $archivo->contenido=$request->contenido;
          $archivo->archivo = $name;
          $archivo->save();
          return redirect()->route('archivo.ver');
    }
    
     public function ver()
    {
          view()->share('title', 'Descargar material');
          $archivo=Archivo::orderBy('id','DESC')->paginate(10);
          return view('archivo.ver')->with('archivo',$archivo); 
    }
    
     public function destruir($id)
    {
          $archivo = Archivo::find($id);
          $archivo->delete();
          return redirect()->route('archivo.ver');
    }
    
    	//gestion de noticias
    	public function noticias()
	{
	     view()->share('title', 'Administraddo de noticias');
	     return view('archivo.noticias');  
	}
	
	public function guardar(Request $request)
	{
	     $validatedData = $request->validate([
          'titulo' => 'required',
          'contenido' => 'required|max:1000',
          'imagen' => 'required|mimes:jpg,jpeg,png'
          ]);
       
          if ($request->file('imagen')) {
               $file = $request->file('imagen');
               $name = 'imagen_'. time(). '.'.$file->getClientOriginalExtension();
               $path = public_path() . '/imagen';
               $file->move($path, $name);
          }
          $contenido = new Contenido();
          $contenido->titulo=$request->titulo;
          $contenido->contenido=$request->contenido;
          $contenido->imagen = $name;
          $contenido->save();

          $users = User::all()->where('rol_id', '!=', '0');
          $notification = new NotificationController;
          foreach ($users as $user ) {
               $dataNotification = [
                    'iduser' => $user->ID,
                    'titulo' => 'New news',
                    'descripcion' => 'Titulo - '.$contenido->titulo,
                    'ruta' => route('archivo.contenido'),
                    'icono' => 'far fa-newspaper',
                    'id_producto' => 0,
               ];
               $notification->newNotification($dataNotification);
          }

          return redirect()->route('archivo.contenido');
	}
	
	 public function contenido()
    {
          view()->share('title', 'Administrador de noticias');
          $contenido=Contenido::orderBy('id','DESC')->paginate(10);
          $notification = new NotificationController;
          $notification->viewTicket(0, Auth::user()->ID);
          return view('archivo.contenido')->with('contenido',$contenido); 
    }
    
    public function eliminar($id)
    {
          $contenido = Contenido::find($id);
          $contenido->delete();
          return redirect()->route('archivo.contenido');
    }
    
    public function actualizar($id)
    {
     view()->share('title', 'Administrador de noticias');
          $contenido = Contenido::find($id);
          return view('archivo.actualizar')->with(compact('contenido'));
     }
    
     public function modificar(Request $request, $id)
     {
          $contenido = Contenido::find($id);
 
          $validatedData = $request->validate([
               'titulo' => 'max:190',
               'contenido' => 'max:1000',
               'imagen' => 'mimes:jpg,jpeg,png'
          ]);

          if ($request->file('imagen') != null) {
               if ($request->file('imagen')) {
                    $file = $request->file('imagen');
                    $name = 'imagen_'. time(). '.'.$file->getClientOriginalExtension();
                    $path = public_path() . '/imagen';
                    $file->move($path, $name);
                    $contenido->imagen = $name;
               }
               $contenido->titulo=$request->titulo;
               $contenido->contenido=$request->contenido;
               $contenido->save();           
               return redirect()->route('archivo.contenido');
          }else{
               $validatedData = $request->validate([
                    'titulo' => 'max:190',
                    'contenido' => 'max:1000',
               ]);
               $contenido->titulo=$request->titulo;
               $contenido->contenido=$request->contenido;
               $contenido->save();
               return redirect()->route('archivo.contenido');
          }
      }	
}