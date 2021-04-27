@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

@if (Auth::user()->ID == 1)
@include('dashboard.componentView.formSearchSimple', ['route' => 'admin.network', 'name1' => 'id', 'type' => 'number',
'text' => 'ID del Usuario'])
@if (Session::has('msj2'))
<div class="col-md-12">
	<div class="alert alert-warning">
		<button class="close" data-close="alert"></button>
		<span>
			{{Session::get('msj2')}}
		</span>
	</div>
</div>
@endif
@else

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'buscarnetwork', 'name1' => 'fecha1', 'name2' => 'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

{{-- <div class="card">
    <div class="card-content">
        <div class="card-body">
            <form method="POST" action="{{route('buscarnetworknivel')}}">
                <div class="row">
                    {{ csrf_field() }}
                <div class="col-12 col-sm-6 col-md-10">
                    <label class="control-label " style="text-align: center; margin-top:4px;">Nivel a Filtrar</label>
                    <select name="nivel" class="form-control">
						<option value="" disabled selected>Selecione una opcion</option>
						<option value="1">Nivel 1</option>
						<option value="2">Nivel 2</option>
						<option value="3">Nivel 3</option>
						<option value="4">Nivel 4</option>
						<option value="0">todos</option>
					</select>
                </div>
                <div class="col-12 text-center col-md-2" style="padding-left: 10px;">
                    <button class="btn btn-primary mt-2" type="submit" id="btn">Buscar</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endif

<div class="card">
	<div class="card-header">
        <h4 class="card-title">Registro de Red</h4>
    </div>
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Inversion Total</th>
							<th>Estato</th>
							<th>Nivel Matriz</th>
							<th>Ingreso</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($allReferido as $referido)
						<tr class="text-center">
							<td>{{ $referido['ID'] }}</td>
							<td>{{ $referido->display_name }}</td>
							<td>{{ $referido->user_email }}</td>
							<td>$ {{ $referido->inversion }}</td>
							@if ($referido['status'] == '0')
							<td>Inactive</td>
							@else
							<td>Active</td>
							@endif
							<td>
								@if($referido['nivel'] == 1)
								1
								@else
								{{$referido['nivel']}}
								@endif
							</td>
							<td>{{ date('d-m-Y', strtotime($referido->created_at)) }}</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection