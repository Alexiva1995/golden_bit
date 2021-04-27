@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'price-filtro', 'name1' => 'desde', 'name2' =>
'hasta', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

{{-- alertas --}}
@include('dashboard.componentView.alert')

{{-- fecha --}}
@if (!empty($fechas['desde']) && !empty($fechas['desde']))
<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-12 col-md-6">
					<label>Date From</label>
					<h5>{{ date('d-m-Y', strtotime($fechas['desde'])) }}</h5>
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Date To</label>
					<h5>{{date('d-m-Y', strtotime($fechas['hasta']))}}</h5>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@php
$total = 0;
@endphp
<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th>
								<center>#</center>
							</th>
							<th>
								<center>Usuario</center>
							</th>
							<th>
								<center>Correo</center>
							</th>
							<th>
								<center>Monto</center>
							</th>
							<th>
								<center>Fecha</center>
							</th>
							<th>
								<center>Wallet de Retiro</center>
							</th>
							<th>
								<center>Metodo</center>
							</th>
							<th>
								<center>Tipo de Metodo</center>
							</th>
							<th>
								<center>Estado</center>
							</th>
							<th>
								<center>Accion</center>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pagos as $pago)
						@php
						$total = ($total + $pago->monto);
						@endphp
						<tr>
							<td>
								<center>{{$pago->id}}</center>
							</td>
							<td>
								<center>{{$pago->username}}</center>
							</td>
							<td>
								<center>{{$pago->email}}</center>
							</td>
							<td>
								<center>
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{$pago->monto}}
									@else
									{{$pago->monto}} {{$moneda->simbolo}}
									@endif
								</center>
							</td>
							<td>
								<center>{{$pago->fechasoli}}</center>
							</td>
							<td>
								<center>
									@if ($pago->tipowallet == 0)
									Point
									@elseif($pago->tipowallet == 1)
									Cash
									@else
									Tantech
									@endif
								</center>
							</td>
							<td>
								<center>{{$pago->metodo}}</center>
							</td>
							<td>
								<center>{{$pago->tipopago}}</center>
							</td>
							<td>
								<center>
									@if ($pago->estado == 0)
									Pendiente
									@endif
								</center>
							</td>
							<td>
								<center>
									<a class="btn btn-info" href="{{route('price-aprobar', [$pago->id])}}"><i
											class="fas fa-check"></i></a>
									<a class="btn btn-danger" href="{{route('price-rechazar', [$pago->id])}}"><i
											class="fas fa-ban"></i></a>
								</center>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<td colspan="3"> Total:</td>
						<td colspan="5"> {{$total}}</td>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection