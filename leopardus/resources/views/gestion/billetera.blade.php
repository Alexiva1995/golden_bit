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
							<th class="center">#</th>
							<th class="center">Fecha</th>
							<th class="center">Descripcion</th>
							<th class="center">Descuento</th>
							<th class="center">Debito</th>
							<th class="center">Credito</th>
							<th class="center">Balance</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($billetera as $bille)

						<tr>
							<td class="center">{{ $bille->id }}</td>
							<td class="center">{{date('d-m-Y', strtotime($bille->created_at)) }}</td>
							<td class="center">{{ $bille->descripcion }}</td>
							<td class="center">{{ $bille->descuento }}</td>
							<td class="center">{{ $bille->debito }}</td>
							<td class="center">{{ $bille->credito }}</td>
							<td class="center">{{ $bille->balance }}</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection