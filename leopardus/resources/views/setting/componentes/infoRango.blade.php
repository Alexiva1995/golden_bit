<style>
    .texto-central {
        text-align: center;
    }
</style>
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>
<hr>
@endif
<button class="btn btn-primary btn-block mostrar" onclick="toggle()">Editar</button>
<button class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
<hr>
<div class="panel panel-default mostrar">
    <div class="panel-heading">
        <h3 class="panel-title">Información de los Rangos del Sistema </h3>
    </div>
    <div class="panel-body">
        @empty(!$settingRol)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Cantidad de Roles</label>
            <input class="form-control" readonly value="{{$settingRol->rangos}}">
        </div>
        @if ($settingRol->referidosd == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Referidos Directos</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if ($settingRol->referidos == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Referidos</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->referidosact == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Referidos Activos</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->compras == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Puntos Personales</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->grupal == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Puntos Grupales</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->valorpuntos > 0)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Valor de los Puntos</label>
            <input class="form-control" readonly value="{{$settingRol->valorpuntos}}">
        </div>
        @endif
        @if($settingRol->comisiones == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Rango por Comisiones </label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->niveles == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Afecta niveles</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        @if($settingRol->bonos == 1)
        <div class="col-sm-4 col-xs-12">
            <label class="texto-central">Recibes Bono</label>
            <input class="form-control" readonly value="SI">
        </div>
        @endif
        <div class="col-xs-12">
            <h3>Rangos</h3>
        </div>
        @foreach ($rangos as $rango)
        <div class="col-xs-12">
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Nombre Rango</label>
                <input class="form-control" readonly value="{{$rango->name}}">
            </div>
            @if ($settingRol->referidosd == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Cantidad de Referidos Directos</label>
                <input class="form-control" readonly value="{{$rango->referidos}}">
            </div>
            @endif
            @if ($settingRol->referidos == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Cantidad de Referidos </label>
                <input class="form-control" readonly value="{{$rango->referidos}}">
            </div>
            @endif
            @if($settingRol->referidosact == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Cantidad de Referidos Activos</label>
                <input class="form-control" readonly value="{{$rango->refeact}}">
            </div>
            @endif
            @if($settingRol->compras == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Total por Puntos Personales</label>
                <input class="form-control" readonly value="{{$rango->compras}}">
            </div>
            @endif
            @if($settingRol->grupal == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Total por Puntos Grupales</label>
                <input class="form-control" readonly value="{{$rango->grupal}}">
            </div>
            @endif
            @if($settingRol->comisiones == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Total por Comisiones </label>
                <input class="form-control" readonly value="{{$rango->comisiones}}">
            </div>
            @endif
            @if($settingRol->niveles == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Nivel Afectado</label>
                <input class="form-control" readonly value="{{$rango->niveles}}">
            </div>
            @endif
            @if($settingRol->bonos == 1)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Total de Bono</label>
                <input class="form-control" readonly value="{{$rango->bonos}}">
            </div>
            @endif
            @foreach ($rangos as $rango2)
            @if ($rango2->id == $rango->rolprevio && $rango->rolprevio != 0)
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Rango Previo</label>
                <input class="form-control" readonly value="{{$rango2->name}}">
            </div>
            @endif
            @endforeach
            <div class="col-sm-4 col-xs-12">
                <label class="texto-central">Permite Cobrar Comision</label>
                <input class="form-control" readonly value="{{($rango->acepta_comision == 1) ? 'SI':'NO'}}">
            </div>
            <hr class="col-xs-12">
        </div>
        @endforeach
        @endempty
    </div>
</div>