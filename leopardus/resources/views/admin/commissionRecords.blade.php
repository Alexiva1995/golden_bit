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
	</script>

	@if (Session::has('msj'))
        <div class="alert alert-success">
            <strong>{{Session::get('msj')}}</strong>
        </div>
    @endif

	<table id="mytable" class="table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th><center>#</center></th>
				<th><center>User</center></th>
				<th><center>Commission</center></th>
				<th><center>Date</center></th>
				<th><center>Referral Email</center></th>
				<th><center>Commission Level</center></th>
				<th><center>Status</center></th>
				@if(Auth::user()->ID == 1)
					<th><center>Action</center></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@php
				$cont = 0;
			@endphp
			@foreach($comisiones as $comision)
				@php
					$cont++;
					$usuario = DB::table($settings->prefijo_wp.'users')
								->select('display_name')
								->where('id', '=', $comision->user_id)
								->first();
				@endphp

				<tr>
					<td><center>{{ $cont }}</center></td>
					<td><center>{{ $usuario->display_name }}</center></td>
					<td><center>$ {{ $comision->total }}</center></td>
					<td><center>{{ date('d-m-Y', strtotime($comision->date)) }}</center></td>
					<td><center>{{ $comision->referred_email }}</center></td>
					<td><center>{{ $comision->referred_level }}</center></td>
					<td><center>
						@if ($comision->status == 1)
							Aprobada
						@else
							Pendiente
						@endif
					</center></td>
						@if(Auth::user()->ID == 1)
							@if ($comision->status == 1)
								<td><center> <a href="{{route('comisiones.aprobar', [$comision->id])}}" class="btn btn-primary" disabled> <i class="fas fa-check"></i> </a> </center></td>
							@else
								<td><center> <a href="{{route('comisiones.aprobar', [$comision->id])}}" class="btn btn-primary"> <i class="fas fa-check"></i> </a> </center></td>
							@endif

						@endif
				</tr>

			@endforeach
		</tbody>
	</table>
@endsection
