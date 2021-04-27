@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'buscarnetworkorder', 'name1' => 'fecha1', 'name2' => 'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>Numero de Orden</th>
							<th>Usuario</th>
							<th>Fecha</th>
							<th>Concepto</th>
							<th>Total</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($compras as $compra)
						<tr class="text-center">
							<td>{{$compra->id}}</td>
							<td>{{$compra->usuario}}</td>
							<td>{{date('d-m-Y', strtotime($compra->created_at))}}</td>
							<td>{{$compra->concepto}}</td>
							<td>$ {{$compra->invertido}}</td>
							<td>
							@if ($compra->status == 0)
								Pendiente
							@elseif($compra->status == 1)
								Aprobada
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