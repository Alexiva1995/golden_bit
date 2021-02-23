@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'buscardirectos', 'name1' => 'fecha1', 'name2' => 'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])


<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Paquete</th>
							<th>Estado</th>
							<th>Ingreso</th>
						</tr>
					</thead>
					<tbody>
						@php
						$cont = 0;
						$paquete = null;
						$nombre = 'Sin Paquete';
						@endphp
						@foreach ($referidosDirectos as $referido)
						@php
						$paquete = json_decode($referido->paquete);
						if (!empty($paquete)) {
							$nombre = $paquete->nombre;
						}
						$cont++;
						// $rol = DB::table('roles')->where('ID', $referido->rol_id)->select('name')->get()[0];
						@endphp
						<tr>
							<td>{{ $referido->ID }}</td>
							<td>{{ $referido->display_name }}</td>
							<td>{{ $referido->user_email }}</td>
							<td>{{ $nombre }}</td>
							@if ($referido->status == '0')
							<td>Inactive</td>
							@else
							<td>Active</td>
							@endif
							<td>{{ date('d-m-Y', strtotime($referido->created_at)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection