@extends('layouts.dashboard')

@section('content')
	<script>
		$(document).ready( function () {
			$('#mytable').DataTable( {
			    dom: 'flBrtip',
					responsive: true,
			    buttons: [
					'csv', 'pdf', 'print', 'excel'
			    ]
			} );
		});
	</script>

	<table id="mytable" class="table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th><center>Referral Email</center></th>
				<th><center>Referral Level</center></th>
				<th><center>Total Commission</center></th>
				<th><center>Commission Date</center></th>
				<th><center>Status</center></th>
			</tr>
		</thead>
		<tbody>
			@foreach($comisiones as $comision)
				<tr>
					<td><center>{{ $comision->referred_email }}</center></td>
					<td><center>{{ $comision->referred_level }}</center></td>
					<td><center>$ {{ $comision->total }}</center></td>
					<td><center>{{ date('d-m-Y', strtotime($comision->date)) }}</center></td>
					<td>@if ($comision->status == '0')
							<center>Pending</center>
						@else
							<center>Approved</center>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
