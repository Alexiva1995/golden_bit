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
							<th class="text-center">Nombre Usuario</th>
							<th class="text-center">Descripcion</th>
							<th class="text-center">Descuento</th>
							<th class="text-center">Debito</th>
							<th class="text-center">Credito</th>
							<th class="text-center">Total Liquidado</th>
							<th class="text-center">Balance</th>
							<th class="text-center">Fecha</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($liquidacion as $liquida)
						<tr>
							<td class="text-center">{{ $liquida->id }}</td>
							<td class="text-center">{{ $liquida->usuario }}</td>
							<td class="text-center">{{ $liquida->descripcion }}</td>
							<td class="text-center">{{ $liquida->descuento }}</td>
							<td class="text-center">{{ $liquida->debito }}</td>
							<td class="text-center">{{ $liquida->credito }}</td>
							<td class="text-center">{{ ($liquida->descuento + $liquida->debito) }}</td>
							<td class="text-center">{{ $liquida->balance }}</td>
							<td class="text-center">{{ date('d-m-Y', strtotime($liquida->created_at))}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection