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
							<th class="text-center">Rango</th>
							<th class="text-center">Nombre Completo</th>
							<th class="text-center">Nombre de Usuario</th>
						</tr>
					</thead>
					<tbody>
						@foreach($rango as $usua)



						@php
						$referido = DB::table($settings->prefijo_wp.'users')
						->select('user_nicename')
						->where('ID', '=', $usua->referred_id)
						->get();

						$faltante = DB::table('user_campo')
						->where('ID', '=', $usua->ID)
						->get();


						$roles = DB::table('roles')
						->get();
						@endphp

						<tr>
							<td class="text-center">{{ $usua->ID }}</td>
							@foreach($roles as $rol)

							@if($rol->id == $usua->rol_id)
							<td class="text-center">{{$rol->name}}</td>
							@endif
							@endforeach

							@foreach($faltante as $falta)
							<td class="text-center">{{$falta->firstname}} {{$falta->lastname}}</td>
							@endforeach

							<td class="text-center">{{ $usua->user_nicename }}</td>
						</tr>



						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection