@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@if (Auth::user()->ID == 1)
@include('dashboard.componentView.formSearchSimple', ['route' => 'admin.directo', 'name1' => 'id', 'type' => 'number',
'text' => 'ID del Usuario'])
@if (Session::has('msj2'))
<div class="col-md-12">
	<div class="alert alert-warning">
		<button class="close" data-close="alert"></button>
		<span>
			{{Session::get('msj2')}}
		</span>
	</div>
</div>
@endif
@else
@include('dashboard.componentView.formSearch', ['route' => 'buscardirectos', 'name1' => 'fecha1', 'name2' => 'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])
@endif

<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Inversion Total</th>
							<th>Estado</th>
							<th>Ingreso</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($referidosDirectos as $referido)
						<tr class="text-center">
							<td>{{ $referido->ID }}</td>
							<td>{{ $referido->display_name }}</td>
							<td>{{ $referido->user_email }}</td>
							<td>$ {{ $referido->inversion }}</td>
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