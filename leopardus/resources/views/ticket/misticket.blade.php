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
							{{-- <th class="center">Soporte</th> --}}
							<th class="center">Estado</th>
							<th class="center">Opcion</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ticket as $tic)

						<tr>
							<td class="center">{{ $tic->id }}</td>
							<td class="center">{{ date('d-m-Y', strtotime($tic->created_at)) }}</td>
							<td class="center">{{ $tic->titulo }}</td>
							@if($tic->status == 0)
							<td class="center">Abierto</td>
							@else
							<td class="center">Cerrado</td>
							@endif
							@if($tic->status == 0)
							<td><a href="{{ route('comentar', $tic->id) }}" class="btn btn-info">Comentar</a></td>
							@else
							<td><a href="{{ route('ver', $tic->id) }}" class="btn btn-info">Ver</a></td>
							@endif
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection