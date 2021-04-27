@extends('layouts.dashboard')

@section('content')
<style>
  .texto-central{
    text-align: center;
  }
  .var{
    margin: 0 10px;
    color: brown;
    border-bottom: 2px solid;
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
      <h3 class="panel-title">Información de las Plantilla de correos </h3>
      <button class="btn green btn-block mostrar hh" onclick="toggle()">Editar</button>
      <button class="btn green btn-block mostrar hh" data-toggle="modal" data-target="#myModalAdmin">Probar Plantillas</button>
    </legend>
  </div>
  <div class="panel-body">
    <div class="col-sm-3 col-xs-12 ch">
      <h3>Titulo de la Plantilla de Bienvenida</h3>
      <h5>{{(!empty($plantillaB->titulo)) ? $plantillaB->titulo : ''}}</h5>
    </div>
    <div class="col-sm-8 col-xs-12 ch">
      <h3>Contenido de la Plantilla de Bienvenida</h3>
      <h5>{!!(!empty($plantillaB->contenido)) ? $plantillaB->contenido : ''!!}</h5>
    </div>
    <div class="col-sm-3 col-xs-12 ch">
      <h3>Titulo de la plantilla de Pago</h3>
      <h5>{{(!empty($plantillaP->titulo)) ? $plantillaP->titulo : ''}}</h5>
    </div>
    <div class="col-sm-8 col-xs-12 ch">
      <h3>Contenido de la Plantilla de Pago</h3>
      <h5>{!!(!empty($plantillaP->contenido)) ? $plantillaP->contenido : ''!!}</h5>
    </div>

  </div>
</div>

{{-- Formulario --}}
@include('setting.componentes.formPlantilla')
{{-- modal prueba --}}
@include('setting.componentes.modalPrueba')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
  $(document).ready(function () {
    setTimeout(() => {
      $('.summernote').summernote(
      {
        toolbar:[
        [ 'style', [ 'style' ] ], 
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ], 
        [ 'fontname', [ 'fontname' ] ], 
        [ 'fontsize', [ 'fontsize' ] ], 
        [ 'color', [ 'color' ] ], 
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ], 
        [ 'table', [ 'table' ] ], 
        [ 'insert', [ 'link'] ], 
      ]
      }
    );
    }, 5000);
  })
  function toggle() {
    $('.mostrar').toggle('slow')
  }
</script>
@endsection