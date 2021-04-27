@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="color">
							<th class="center">#</th>
							<th class="center">Fecha</th>
							<th class="center">Titulo</th>
							<th class="center">ID Usuario</th>
							<th class="center">Nombre Usuario</th>
							<th class="center">Estado</th>
							<th class="center">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ticket as $tic)
						@php
						$nombre = 'Usuario Eliminado';
						$buscar = DB::table($settings->prefijo_wp.'users')
						->where('ID', '=', $tic->user_id)
						->first();
						if (!empty($buscar)) {
							$nombre = $buscar->display_name;
						}
						@endphp
						<tr>
							<td class="center">{{ $tic->id }}</td>
							<td class="center">{{ date('d-m-Y', strtotime($tic->created_at)) }}</td>
							<td class="center">{{ $tic->titulo }}</td>
							<td class="center">{{ $tic->user_id }}</td>
							<td class="center">{{$nombre}}</td>
							@if($tic->status == 0)
							<td class="center abi"> <span>Abierto</span></td>
							@else
							<td class="center cer"> <span>Cerrado</span> </td>
							@endif
							<td>

								@if(Auth::user()->rol_id != 0)
								<a href="{{ route('ver', $tic->id) }}" class="btn btn-info">Ver</a>
								@endif

								@if($tic->status == 0 && Auth::user()->rol_id == 0)
								<a href="{{ route('comentar', $tic->id) }}" class="btn btn-info">Comentar</a>

								<a href="{{ route('cerrar', $tic->id) }}" class="btn btn-danger">Cerrar</a>
								@endif

								@if($tic->status == 1 && Auth::user()->rol_id == 0)
								<a href="{{ route('ver', $tic->id) }}" class="btn btn-info">Ver</a>
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