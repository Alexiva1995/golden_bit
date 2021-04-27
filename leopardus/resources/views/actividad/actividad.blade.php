@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

<style>
	.color {
		background-color: #e5e5e5;
	}

	.center {
		text-align: center;
	}
</style>

<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="color">
							<th class="center">#</th>
							<th class="center">Date</th>
							<th class="center">User name</th>
							<th class="center">IP Address</th>
							<th class="center">Activity</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($sesion as $sesi)


						<tr>
							<td class="center">{{ $sesi->id }}</td>
							<td class="center">{{ $sesi->fecha }}</td>
							<td class="center">{{ $sesi->display_name }}</td>
							<td class="center">{{ $sesi->ip }}</td>
							<td class="center">{{ $sesi->actividad }}</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	@endsection