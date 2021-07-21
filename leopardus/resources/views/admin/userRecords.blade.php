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
							@if ($tipo == 'delete')
							<th class="text-center">
								Patrocinador
							</th>
							@endif
							<th class="text-center">
								Estatus
							</th>
							<th class="text-center">
								Paquete
							</th>
							<th class="text-center">
								Accion
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datos as $usuario)
						<tr>
							<td class="text-center">
								{{ $usuario['ID'] }}
							</td>
							<td class="text-center">
								{{ $usuario['display_name'] }}
							</td>
							<td class="text-center">
								{{ $usuario['user_email'] }}
							</td>
							@if ($tipo == 'delete')
							<td class="text-center">
								{{ $usuario['patrocinador'] }}
							</td>
							@endif
							<td class="text-center">

								@if ($usuario['status'] == 1)
								Activo
								@elseif($usuario['status'] == 2)
								Eliminado
								@else
								Inactivo
								@endif

							</td>
							<td class="text-center">
								{{ $usuario['paquete'] }}
							</td>
							<td class="text-center">
								{{-- <a class="btn btn-info" href="{{ route('admin.useredit', $usuario['ID']) }}">
									<i class="fa fa-edit"></i></a> --}}

								@if ($tipo == 'delete')
									@if($usuario['ID'] != 1 )
									<button class="btn btn-danger" value="{{$usuario['ID']}}"
										onclick="eliminarProducto(this.value)">
										<i class="fa fa-trash"></i>
									</button>
									@endif
								@elseif($tipo == 'refondeo')
								<button class="btn btn-primary" value="{{$usuario['ID']}}"
										onclick="refondear(this.value)">
										Refondear
									</button>
								@else
									<a class="btn btn-info" href="{{route('admin.change.paquete', [$usuario['ID'], $usuario['cambiar']])}}">
										<i class="feather icon-refresh-cw"></i> -> {{($usuario['cambiar'] == 0)? 'Standar' : 'Gold'}}</a>
								@endif
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
				<h4 class="modal-title" id="myModalLabel">Borrar usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin.userdelete') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="userdelete" id="userdelete">
					<div class="form-group">
						<label for="">Ingrese la clave del Administrador para poder borrar</label>
						<input type="password" class="form-control" name="clave">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-danger">Borrar</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalRefondeo" tabindex="-1" role="dialog" aria-labelledby="myModalRefondeoLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalRefondeoLabel">Refondear Usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin.userrefondear') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="userrefondear" id="userrefondear">
					<div class="form-group">
						<label for="">Ingrese la cantidad a refondear</label>
						<input type="number" class="form-control" name="inversion">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">Refondear</button>
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
	function eliminarProducto(idproducto) {
		$('#userdelete').val(idproducto)
		$('#myModal').modal('show')
	}

	function refondear(idproducto) {
		$('#userrefondear').val(idproducto)
		$('#myModalRefondeo').modal('show')
	}
</script>
@endsection