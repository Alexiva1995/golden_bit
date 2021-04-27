@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'buscarnetwork', 'name1' => 'fecha1', 'name2' =>
'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

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
							<th>Estato</th>
							<th>Auspiciador</th>
							<th>Nivel de Referido</th>
							<th>Ingreso</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($allReferido as $referido)
						@php
						$paquete = null;
						$nombre = 'Sin Paquete';
						if ($referido['status'] == 1) {
							$paquete = json_decode($referido['paquete']);
							if (!empty($paquete)) {
								$nombre = $paquete->nombre;
							}
						}
						@endphp
						@if(date('d-m-Y', strtotime($referido['fecha'])) >= $primero && date('d-m-Y',
						strtotime($referido['fecha'])) <= $segundo) <tr>
							<td>{{ $referido['ID'] }}</td>
							<td>{{ $referido['nombre'] }}</td>
							<td>{{ $referido['email'] }}</td>
							<td>{{ $nombre }}</td>
							@if ($referido['status'] == '0')
							<td>Inactive</td>
							@else
							<td>Active</td>
							@endif
							<td>
								{{$referido['patrocinador']}}
							</td>
							<td>
								@if($referido['nivel'] == 1)
								1
								@else
								{{$referido['nivel']}}
								@endif
							</td>
							<td>{{ date('d-m-Y', strtotime($referido['fecha'])) }}</td>
							</tr>
							@endif
							@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection