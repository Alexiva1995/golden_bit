@extends('layouts.dashboard')

@section('content')
<script>
		$(document).ready( function () {
			$('#mytable').DataTable( {
			    dom: 'flBrtip',
					responsive: true,
			    buttons: [
					'csv', 'pdf', 'print', 'excel'
			    ]
			} );
		});
		$('#sandbox-container input').datepicker({
});
	</script>
        
    <div class="col-xs-12" style="margin-top:20px;">
    <div class="col-xs-12 panel panel-default">
        <div class="col-xs-12 panel-body bubu" style="padding: 10px;">
            <table id="mytable" class="table table-bordered table-hover table-responsive">
        		<thead>
        			<tr>
        				<th><center>#</center></th>
        				<th><center>Usuario</center></th>
        				<th><center>Correo</center></th>
        				<th><center>Monto</center></th>
        				<th><center>Metodo</center></th>
        				<th><center>Fecha</center></th>
        				<th><center>Estado</center></th>
        			</tr>
        		</thead>
        		<tbody>
        		    @foreach($pagos as $pago)
            		    <tr>
            		        <td><center>{{$pago->id}}</center></td>
            		        <td><center>{{$pago->username}}</center></td>
            		        <td><center>{{$pago->email}}</center></td>
							<td><center>
								@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{$pago->monto}}
								@else
									{{$pago->monto}} {{$moneda->simbolo}}
								@endif
							</center></td>
            		        <td><center>{{$pago->metodo}}</center></td>
            		        <td><center>{{$pago->fechapago}}</center></td>
            		        <td><center>
            		            @if ($pago->estado == 1)
            		                Aprobado
            		            @elseif ($pago->estado == 2)
            		                Rechazado
            		            @endif
            		        </center></td>
            		    </tr>
            		 @endforeach
        		</tbody>
    	    </table>
        </div>
    </div></div>
@endsection


