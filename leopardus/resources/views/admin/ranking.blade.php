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
							<th>#</th>
							<th>ID</th>
							<th>Fullname</th>
							<th>User</th>
							<th>Current balance</th>
							<th>Total Profit</th>
						</tr>
					</thead>

					<tbody>
						@php
						$n=0;
						@endphp
						@foreach ($rankingComisiones as $comision)
						@php
						$n++;
						@endphp
						<tr>
							<td>{{$n}}</td>
							<td>{{$comision['usuario1']}}</td>
							<td>{{$comision['usuario2']}} {{$comision['usuario3']}}</td>
							<td>{{$comision['usuario']}}</td>
							<td>{{$comision['usuario4']}}</td>
							<td>{{$comision['total']}}</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection