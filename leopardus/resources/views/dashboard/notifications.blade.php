@extends('layouts.dashboard')

@section('content')
	<div class="col-md-2"></div>   
	<div class="col-md-8">
		<ul class="list-group">
			@foreach ($notificaciones as $notificacion)
				<li class="list-group-item">
					<span class="badge">{{ date('d-m-Y', strtotime($notificacion->date)) }}</span>
					<span class="label label-sm label-icon {{ $notificacion->label }}">
						<i class="{{ $notificacion->icon }}"></i>
					</span>
					@if ($notificacion->status == 1)
						<a href="{{ url($notificacion->route) }}" style="color:#151515;">{{ $notificacion->description }}</a>
					@else
						<a href="{{ url($notificacion->route) }}">{{ $notificacion->description }}</a>
					@endif
				</li>
			@endforeach 	
		</ul>
	</div>  
@endsection