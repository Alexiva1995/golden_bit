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
							<th class="text-center">#</th>
							<th class="text-center">Nombre de Usuario</th>
							<th class="text-center">Concepto</th>
							<th class="text-center">Monto</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lista as $usua)



						@php

						$faltante = DB::table($settings->prefijo_wp.'users')
						->where('ID', '=', $usua->user_id)
						->get();
						@endphp


						<tr>
							<td class="text-center">{{ $usua->id }}</td>
							@foreach($faltante as $falta)
							<td class="text-center">{{ $falta->user_nicename }}</td>
							@endforeach
							<td class="text-center">{{ $usua->concepto }}</td>
							<td class="text-center">{{ $usua->total }}</td>

						</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection