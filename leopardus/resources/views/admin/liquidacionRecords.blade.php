@extends('layouts.dashboard')
@section('content')
    @if(isset($total))
        @if(Auth::user()->rol_id==5)
            <a href="{{url('admin/generarliquidaciones')}}" class="btn btn-primary">Generate Settlements</a>

            @if($total>0)
                <a href="{{url('admin/liquidar_todo')}}" class="btn btn-success">Approve all settlements</a>
    		@endif
        @endif

        </script>
        @if(Session::has('flash_message'))
            <div class="alert alert-success" style="margin-top: 10px;">
                <button class="close" data-close="alert"></button>
                <span>
                   {{Session::get('flash_message')}}
                </span>
            </div>
        @endif

    @endif

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

	@if (Session::has('msj'))
        <div class="alert alert-success">
            <strong>{{Session::get('msj')}}</strong>
        </div>
    @endif

    <div style="margin-top: 20px;">
        	<table id="mytable" class="table table-bordered table-hover table-responsive" >
		<thead>
			<tr>
				<th><center>#</center></th>
				<th><center>User</center></th>
				<th><center>Date</center></th>
				<th><center>Total Commission</center></th>
				<th><center>Statu</center></th>
				@if(!isset($total))
				    <th><center>Settlement Date</center></th>

				@endif
			</tr>
		</thead>

		<tbody>
			@foreach($liquidaciones as $liquidacion)
				<tr>
					<td><center>{{ $liquidacion->id }}</center></td>
					<td><center>{{ $liquidacion->usuario }}</center></td>
                    <td><center>{{ date('d-m-Y', strtotime($liquidacion->created_at)) }}</center></td>
					<td><center>$ {{ $liquidacion->totalcomision }}</center></td>
					<td>@if ($liquidacion->estado == '0')
							<center>On Hold</center>
						@elseif ($liquidacion->estado == '2')
							<center>Cancel</center>
						@else
						    <center>Approve</center>
						@endif
					</td>
					<td>
					    @if(!isset($total))
				            <center>@if ($liquidacion->estado != '0'){{ date('d-m-Y', strtotime($liquidacion->updated_at)) }}@else-@endif</center>

					    @endif
					</td>
				</tr>

			@endforeach

		</tbody>

	</table>

    </div>



@endsection
