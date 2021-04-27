@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')


<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="color">
							<th class="center">#</th>
							<th class="center">Nombre Completo</th>
							<th class="center">Nombre</th>
							<th class="center">Dia de Ingreso</th>
							<th class="center">Correo</th>
							<th class="center">Pais</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($referidos as $refe)

						@php
						$faltante = DB::table('user_campo')
						->where('ID', '=', $refe->ID)
						->get();
						@endphp

						<tr>
							<td class="center">{{ $refe->ID }}</td>
							@foreach($faltante as $falta)
							<td class="center">{{ $falta->firstname }} {{ $falta->lastname }}</td>
							@endforeach
							<td class="center">{{ $refe->user_nicename }}</td>
							<td class="center">{{ date('d-m-Y', strtotime($refe->created_at)) }}</td>
							<td class="center">{{ $refe->user_email }}</td>
							@foreach($faltante as $falta)
							<td class="center">{{ $falta->pais }}</td>
							@endforeach
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection