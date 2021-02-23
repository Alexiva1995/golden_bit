@extends('layouts.dashboard')

@section('content')
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>
@endif

<!-- informacion -->
<div class="panel panel-default mostrar">
    <div class="panel-heading pla">
        <legend>
            <h3 class="panel-title">Información de la Moneda Principal del Sistema </h3>
            <button class="btn green btn-block mostrar hh" onclick="toggle()">Agregar</button>

        </legend>
    </div>
    <div class="panel-body">
        <div class="col-sm-4 col-xs-12 ch">
            <h3>Moneda Principal</h3>
            <h5>
                @empty(!$monedap)
                @if ($monedap->principal)
                {{$monedap->nombre}}
                @endif
                @endempty
            </h5>
        </div>
        <div class="col-sm-4 col-xs-12 ch">
            <h3>Simbolo de la moneda</h3>
            <h5>
                @empty(!$monedap)
                @if ($monedap->principal)
                {{$monedap->simbolo}}
                @endif
                @endempty
            </h5>
        </div>
        <div class="col-sm-4 col-xs-12 ch kl">
            <h3>Montrar antes o despues del monto</h3>
            <h5>
                @empty(!$monedap)
                @if ($monedap->principal)
                @if ($monedap->mostrar_a_d == 0)
                Despues
                @else
                Antes
                @endif
                @endif
                @endempty
            </h5>
        </div>

        {{-- tablas --}}

        <div class="col-xs-12">
            <hr>
        </div>
        <table id="mytable" class="table table-bordered table-hover table-responsive pli">
            <thead>
                <tr>
                    <th>
                        <center>ID </center>
                    </th>
                    <th>
                        <center>Nombre </center>
                    </th>
                    <th>
                        <center>Simbolo </center>
                    </th>
                    <th>
                        <center>Mostrar</center>
                    </th>
                    <th>
                        <center>Principal</center>
                    </th>
                    <th>
                        <center>Acciones</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                @empty(!$monedas)
                @foreach($monedas as $moneda)
                <tr>
                    <td>
                        <center>{{ $moneda->id }}</center>
                    </td>
                    <td>
                        <center>{{ $moneda->nombre }}</center>
                    </td>
                    <td>
                        <center>{{ $moneda->simbolo }}</center>
                    </td>
                    <td>
                        <center>
                            @if ($moneda->mostrar_a_d == 0)
                            Despues del monto
                            @else
                            Antes del monto
                            @endif
                        </center>
                    </td>
                    <td>
                        <a href="{{route('setting-update-moneda-principal', ['id' => $moneda->id, 'estado' => ($moneda->principal == 1) ? 0 : 1])}}"
                            name="button" class="btn {{ ($moneda->principal == 1) ? 'btn-danger' : 'btn-primary' }}">{{
                            ($moneda->principal == 1) ? 'No Ser Principal' : 'Ser Principal' }}</a>
                    </td>
                    <td>
                        <center>
                            {{-- <button value="{{$pago->id}}" class="btn btn-primary" onclick="getForm(this.value)">
                                <i class="fa fa-edit"></i> </button> --}}
                            <a class="btn btn-danger" href="{{route('setting-delete-moneda', ['id' => $moneda->id])}}">
                                <i class="fa fa-trash"></i> </a>
                        </center>
                    </td>
                </tr>
                @endforeach
                @endempty
            </tbody>
        </table>
    </div>
</div>

{{-- formulario --}}

<div class="panel panel-default mostrar" style="display:none;">
    <div class="panel-heading pla">
        <legend>
            <h3 class="panel-title">Configuración de Estructura del Sistema </h3>
        </legend>
    </div>
    <div class="panel-body">
        <form class="" action="{{route('setting-save-monedas')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group col-sm-12 ptr">
                <label for="">Nombre de la Moneda</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12 ptr">
                <label for="">Simbolo de la Moneda</label>
                <input type="text" class="form-control" name="simbolo" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12 ptr">
                <label for="">Mostrar Antes o Despues del Monto</label>
                <select class="form-control" name="mostrar" required>
                    <option value="" selected disabled>Seleccione una Opción</option>
                    <option value="1">Antes</option>
                    <option value="0">Depues</option>
                </select>
            </div>
            <div class="form-group col-sm-12 ji">
                <div class="form-group col-sm-6">
                    <button class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
                </div>
                <div class="form-group col-sm-6"> <button type="submit" class="btn green btn-block"> Guardar <span
                            class="glyphicon glyphicon-floppy-disk"></span></div>

                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function toggle() {
        $('.mostrar').toggle('slow')
    }
</script>
@endsection