@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'price-filtro', 'name1' => 'desde', 'name2' =>
'hasta', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

@if (Session::has('msj'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<strong>{{Session::get('msj')}}</strong>
</div>
@endif
@if (Session::has('msj2'))
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<strong>{{Session::get('msj2')}}</strong>
</div>
@endif

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
								<center>Descuento</center>
							</th>
							<th>
								<center>Total</center>
							</th>
							<th>
								<center>Fecha</center>
							</th>
							<th>
								<center>Estado</center>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pagos as $pago)
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
								<center>
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{$pago->descuento}}
									@else
									{{$pago->descuento}} {{$moneda->simbolo}}
									@endif
								</center>
							</td>
							<td>
								<center>
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{($pago->monto + $pago->descuento)}}
									@else
									{{($pago->monto + $pago->descuento)}} {{$moneda->simbolo}}
									@endif
								</center>
							</td>
							<td>
								<center>{{$pago->fechapago}}</center>
							</td>
							<td>
								<center>
									@if ($pago->estado == 1)
									Aprobado
									@elseif ($pago->estado == 2)
									Rechazado
									@endif
								</center>
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