@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')

<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th class="text-center">
								ID
							</th>
							<th class="text-center">
								Usuario
							</th>
							<th class="text-center">
								Correo
							</th>
							<th class="text-center">
								Telefono
							</th>
							<th class="text-center">
								Referido por
							</th>
							<th class="text-center">
								Estatus
							</th>
							<th class="text-center">
								Accion
							</th>
						</tr>
					</thead>
					<tbody>
						@php
						$cont = "";
						@endphp
						@foreach($users as $user)
						<tr>
							<td class="text-center">
								{{ $user->ID }}
							</td>
							<td class="text-center">
								{{ $user->display_name }}
							</td>
							<td class="text-center">
								{{ $user->user_email }}
							</td>
							<td class="text-center">
								{{ $user->phone }}
							</td>
							<td class="text-center">
								{{ $user->nombre_referido }}
							</td>

							<td class="text-center">

								@if ($user->status == 1)
								Activo
								@else
								Inactivo
								@endif

							</td>
							<td class="text-center">
								{{-- @if($user->ID != 1) --}}
								<button class="btn btn-info" value="{{$user->ID}}"
									onclick="activarUser(this.value)">
									Activar <i class="fa fa-check"></i>
								</button>
								{{-- @endif --}}

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Asignar Producto y activar usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin.userinactive') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="iduser" id="userdelete">
					<div class="form-group">
						<label for="">Seleciones un Producto para la activacion</label>
						<select name="paquete" id="" class="form-control">
                            <option value="" selected disabled>Selecione un Producto</option>
                            @foreach ($product as $item)
                            <option value="{{$item->ID}}">{{$item->post_title}}</option>
                            @endforeach
                        </select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info">Activar</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
	function activarUser(idproducto) {
		$('#userdelete').val(idproducto)
		$('#myModal').modal('show')
	}
</script>
@endsection