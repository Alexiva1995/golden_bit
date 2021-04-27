<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Ticket; use App\Comentario;

use App\Http\Controllers\NotificationController;


class TicketController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Tickets');
		
	}
	
		function ticket(Request $request)
	{
        // TITLE
		view()->share('title', 'Tickets');
      
	return view('ticket.ticket');
	}
	
		function generarticket(Request $request)
	{
        // TITLE
		view()->share('title', 'Tickets');
		
		$validatedData = $request->validate([
		'titulo' => 'max:100',
        'comentario' => 'max:3000'
       ]);
		
        $ticket = new Ticket();
        $ticket->titulo=$request->titulo;
        $ticket->comentario=$request->comentario;
        $ticket->user_id = Auth::user()->ID;
        $ticket->admin= '1';
        $ticket->status= '0';
        $ticket->save();

        $dataNotification = [
          'iduser' => 1,
          'titulo' => 'Nuevo Ticket',
          'descripcion' => 'User '.Auth::user()->display_name,
          'ruta' => route('comentar', [$ticket->id]),
          'icono' => 'fas fa-ticket-alt',
          'id_producto' => $ticket->id,
        ];

        $notification = new NotificationController;
        $notification->newNotification($dataNotification);

        $ticket = DB::table('tickets')
        ->where('user_id', '=', Auth::user()->ID)
        ->get();
          
      
      return redirect()->action('TicketController@misticket');
	}
	
	
	function misticket()
	{
        // TITLE
      
		view()->share('title', 'My Tickets');
            
            $ticket = DB::table('tickets')
                            ->where('user_id', '=', Auth::user()->ID)
                            ->get();
        return view('ticket.misticket', compact('ticket'));
    
	}
	
    public function comentar($id)
    {
      $ticket = Ticket::find($id);
        
      $comentarios = DB::table('comentarios')->where('tickets_id', $id)->get();
      foreach ($comentarios as $comentario) {
        $tmp = User::find($comentario->user_id);
        $comentario->user = 'Usuario No Disponible';
        if (!empty($tmp)) {
          $comentario->user = $tmp->display_name;
        }
      }

      $tmp = User::find($ticket->user_id);
      $ticket->user = 'Usuario No Disponible';
      if (!empty($tmp)) {
        $ticket->user = $tmp->display_name;  
      }
      

      $ticket->comentarios = $comentarios;

      $notification = new NotificationController;
      $notification->viewTicket($ticket->id, Auth::user()->ID);
      return view('ticket.comentar', compact('ticket'));
    }
    
    	public function subir(Request $request)
    {

      $tique =($request->id);
  
      $validatedData = $request->validate([
        'comentario' => 'max:3000'
      ]);

      $comentario = new Comentario();
      $comentario->tickets_id =$tique;
      $comentario->user_id= Auth::user()->ID;
      $comentario->comentario=$request->comentario;
      $comentario->save();

      $ticket = Ticket::find($tique);
      $user = User::find($ticket->user_id);

      $idnotificacion = ($ticket->user_id != Auth::user()->ID) ? $ticket->user_id : 1 ;

      $dataNotification = [
        'iduser' => $idnotificacion,
        'titulo' => 'Ticket Respondido',
        'descripcion' => 'El usuario '.Auth::user()->display_name.' ha respondido el ticket '.$ticket->titulo,
        'ruta' => route('comentar', [$ticket->id]),
        'icono' => 'fas fa-comment-dots',
        'id_producto' => $ticket->id,
      ];

      $notification = new NotificationController;
      $notification->newNotification($dataNotification);
 
      return redirect()->back();
    }
    
    public function todosticket()
    {
 	$ticket = DB::table('tickets')
 	->orderBy('id', 'DESC')
 	->get();
        return view('ticket.todosticket')->with('ticket', $ticket);
    }
    
    public function ver($id)
    {
      $ticket = Ticket::find($id);
        
      $comentarios = DB::table('comentarios')->where('tickets_id', $id)->get();
      foreach ($comentarios as $comentario) {
        $tmp = User::find($comentario->user_id);
        $comentario->user = 'Usuario No Disponible';
        if (!empty($tmp)) {
          $comentario->user = $tmp->display_name;
        }
      }

      $tmp = User::find($ticket->user_id);
      $ticket->user = 'Usuario No Disponible';
      if (!empty($tmp)) {
        $ticket->user = $tmp->display_name;  
      }
      $ticket->comentarios = $comentarios;

      $notification = new NotificationController;
      $notification->viewTicket($ticket->id, Auth::user()->ID);

      return view('ticket.ver', compact('ticket'));
    }
    
     public function cerrar($id)
    {
         $tique =($id);

            DB::table('tickets')
                    ->where('id', '=', $tique)
                    ->update(['status' => 1 ]);
                    
            $ticket = DB::table('tickets')
            ->orderBy('id', 'DESC')
            ->get();
            
        return view('ticket.todosticket')->with('ticket', $ticket);
    }
    
}