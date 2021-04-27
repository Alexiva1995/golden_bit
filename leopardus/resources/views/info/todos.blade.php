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
							<th class="center">Nombre</th>
							<th class="center">Correo</th>
							<th class="center">monto</th>
							<th class="center">Fecha</th>
							<th class="center">Metodo</th>
							<th class="center">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pago as $pa)

						@php
						$faltante = DB::table($settings->prefijo_wp.'users')
						->where('ID', '=', $pa->iduser)
						->get();
						@endphp

						<tr>
							<td class="center">{{ $pa->id }}</td>
							<td class="center">{{ $pa->username }}</td>
							<td class="center">{{ $pa->email }}</td>
							<td class="center">{{ $pa->monto }}</td>
							<td class="center">{{ $pa->fechapago }}</td>
							<td class="center">{{ $pa->metodo }}</td>
							<td class="center">
								@if ($pa->estado == 1)
								Aprobado
								@elseif ($pa->estado == 0)
								En Espera
								@endif
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection