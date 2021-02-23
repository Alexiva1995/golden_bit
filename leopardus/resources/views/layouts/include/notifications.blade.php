@php
$notificaciones = [];
$notificaciones = DB::table('notificaciones')
->where([
['iduser', '=', Auth::user()->ID],
['vista', '=', 0]
])->get();
@endphp

<style>
	.dropdown-notification .dropdown-menu-header{
		background: #00646d !important;
	}
	.dropdown-notification .dropdown-menu.dropdown-menu-right::before{
		background: #00646d !important;
		border-color: #00646d !important;
	}
</style>


<li class="dropdown dropdown-notification nav-item">
	<a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
		<i class="ficon feather icon-bell" style="color: black;"></i>
		@if (count($notificaciones) != 0)
		<span class="badge badge-pill badge-primary badge-up"> {{ count($notificaciones) }} </span>
		@endif
	</a>
	<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
		<li class="dropdown-menu-header">
			<div class="dropdown-header m-0 p-2">
				<h3 class="white">{{ count($notificaciones) }}</h3>
				<span class="notification-title">Notificaciones</span>
			</div>
		</li>
		<li class="scrollable-container media-list">
			@foreach ($notificaciones as $notificacion)
			<a class="d-flex justify-content-between" href="{{$notificacion->ruta}}">
				<div class="media d-flex align-items-start">
					<div class="media-left">
						{{-- <i class="feather icon-plus-square font-medium-5 primary"></i> --}}
						<i class="{{ $notificacion->icono }}"></i>
					</div>
					<div class="media-body">
						<h6 class="primary media-heading">
							{{ $notificacion->titulo }}
						</h6>
						<small class="notification-text"> 
							{{ $notificacion->descripcion }}
						</small>
					</div>
					<small>
						<time class="media-meta" datetime="{{ $notificacion->created_at }}"></time>
					</small>
				</div>
			</a>
			@endforeach
		</li>
		{{-- <li class="dropdown-menu-footer">
			<a class="dropdown-item p-1 text-center" href="javascript:void(0)">
				Read all notifications
			</a>
		</li> --}}
	</ul>
</li>
