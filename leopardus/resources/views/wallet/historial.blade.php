@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'wallet-historial-fechas', 'name1' => 'primero', 'name2' =>
'segundo', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])


<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th>#</th>
							<th>Usuario</th>
							<th>Descripcion</th>
							{{-- <th>Tantechcoins</th> --}}
							{{-- <th>Cash</th> --}}
							<th>Monto</th>
							<th>Billetera</th>
							<th>Fecha</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($billetera as $bille)
						<tr>
							<td>{{ $bille->id }}</td>
							<td>{{ $bille->usuario }}</td>
							<td>{{ $bille->descripcion }}</td>
							{{-- <td>{{ $bille->puntos }}</td> --}}
							{{-- <td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->debito }}
								@else
								{{ $bille->debito }} {{$moneda->simbolo}}
								@endif
							</td> --}}
							<td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->credito }}
								@else
								{{ $bille->credito }} {{$moneda->simbolo}}
								@endif
							</td>
							<td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->balance }}
								@else
								{{ $bille->balance }} {{$moneda->simbolo}}
								@endif
							</td>
							<td>{{ date('d-m-Y', strtotime($bille->created_at)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection