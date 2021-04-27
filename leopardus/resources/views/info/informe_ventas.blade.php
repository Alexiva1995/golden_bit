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
						<tr>
							<th class="text-center">N° de Orden</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Concepto</th>
							<th class="text-center">Total</th>
							<th class="text-center">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($compras as $orden)
						<tr>
							<td class="text-center">
								{{$orden['idcompra']}}
							</td>
							<td class="text-center">
								{{$orden['fecha_orden']}}
							</td>
							<td class="text-center">
								{{$orden['item']}}
							</td>
							<td class="text-center">
								{{$orden['total_orden']}}
							</td>
							<td class="text-center">
								{{$orden['estado_orden']}}
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