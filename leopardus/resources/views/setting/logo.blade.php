@extends('layouts.dashboard')

@section('content')
<style>
  .texto-central{
    text-align: center;
  }
</style>
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>

@endif


{{-- información --}}
<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Información del Sistema</h3>
    </legend>
  </div>
  <div class="panel-body">
    <div class="col-sm-12 col-xs-12">
      <h3 class="texto-central">Nombre del Sistema</h3>
      <input class="form-control" disabled placeholder="{{$settings->name}}">
    </div>
    <div class="col-sm-12 col-xs-12">
      <h3 class="texto-central">Edad Minima Para Ingresar al sistema</h3>
      <input class="form-control" disabled placeholder="{{$settings->edad_minino}}">
    </div>
    <div class="col-sm-12 col-xs-12">
      <h3 class="texto-central">Licencia del Sistema</h3>
      <input class="form-control" disabled placeholder="{{$settings->licencia}}">
    </div>
    <div class="col-sm-12 col-xs-12">
      <h3 class="texto-central">Fecha de Vencimiento de la Licencia</h3>
      <input class="form-control" disabled placeholder="{{date('d-m-Y', strtotime($settings->fecha_vencimiento))}}">
    </div>
    <div class="col-sm-6 col-xs-12">
      <div class="fav">
        <h3 class="texto-central">Logo del Sistema</h3>
        <h5 class="texto-central">
          <img src="{{asset('assets/img/logo-light.png')}}" height="80" alt="">
        </h5>
      </div>
    </div>
    <div class="col-sm-6 col-xs-12">
      <div class="fav">
        <h3 class="texto-central">Favicon del Sistema</h3>
        <h5 class="texto-central">
          <img src="{{asset('favicon.ico')}}" alt="" height="50">
        </h5>
      </div>
    </div>

  </div>
  <button class="btn green btn-block mostrar" onclick="toggle()">Editar</button>
  <button class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
</div>
{{-- formularios --}}
<div class="panel panel-default mostrar row" style="display:none;">
  <div class="panel-body  col-sm-12 ">
    <form class="" action="{{route('setting-save-name')}}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="">Nombre del Sistema</label>
        <input type="text" class="form-control" name="namesystem" value="{{$settings->name}}" required>
      </div>
      <div class="form-group">
        <label for="">Edad Minima para entrar al sistema</label>
        <input type="text" class="form-control" name="edad_minima" value="{{$settings->edad_minino}}" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
        </button>
      </div>
    </form>
  </div>
</div>
<div class="panel panel-default mostrar row" style="display:none;">
  <div class="panel-body col-sm-6">
    <form class="" action="{{route('setting-save-logo')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="">Logo Sistema</label>
        <input type="file" class="form-control" name="logo" value="" accept="image/x-png" required>
      </div>
      <div class="form-group sisi">
        <button type="submit" class="btn btn-primary"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
        </button>
      </div>
    </form>
  </div>
  <div class="panel-body col-sm-6">
    <form class="" action="{{route('setting-save-favicon')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="">Favicon Sistema</label>
        <input type="file" class="form-control" name="favicon" accept="image/x-icon" value="" required>
      </div required>
      <div class="form-group sisi">
        <button type="submit" class="btn btn-primary"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
        </button>
      </div>
    </form>
  </div>
</div>
<script>
  function toggle() {
    $('.mostrar').toggle('slow')
  }
</script>
@endsection