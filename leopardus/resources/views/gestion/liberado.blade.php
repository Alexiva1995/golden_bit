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
							<th class="center">Monto</th>
							<th class="center">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pago as $pa)
						<tr>
							<td class="center">{{ $pa->id }}</td>
							<td class="center">{{date('d-m-Y', strtotime($pa->created_at)) }}</td>
							<td class="center">{{ $pa->monto }}</td>
							@if( $pa->estado == 1)
							<td class="center">Aceptado</td>
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