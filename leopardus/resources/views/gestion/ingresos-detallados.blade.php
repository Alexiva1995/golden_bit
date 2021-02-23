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
							<th class="center">Nombre del Usuario</th>
							<th class="center">Nivel</th>
							<th class="center">Descripcion</th>
							<th class="center">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($comision as $comi)

						@php
						$falta = DB::table($settings->prefijo_wp.'users')
						->where('user_email', '=', $comi->referred_email)
						->first();
						@endphp

						<tr>
							<td class="center">{{ $comi->id }}</td>
							<td class="center">{{ (!empty($falta)) ? $falta->display_name : 'Usuario no Disponible' }}
							</td>
							<td class="center">{{ $comi->referred_level }}</td>
							<td class="center">{{ $comi->concepto }}</td>
							<td class="center">{{ $comi->total }}</td>

						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection