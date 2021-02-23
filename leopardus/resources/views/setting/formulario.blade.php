@extends('layouts.dashboard')

@section('content')
<!-- errores -->
@if ($errors->any())
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
<hr>
@endif
<!-- alertas -->
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>
<hr>
@endif
{{-- Terminos y Condiciones --}}
<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Terminos y Condiciones </h3>
      <button class="btn green btn-block mostrar hh" onclick="toggle()">Editar</button>
    </legend>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <a class="btn btn-primary btn-block" target="_blank" href="{{asset('assets/terminosycondiciones.pdf')}}">Descargar Terminos y Condiciones</a>
    </div>
  </div>
</div>
{{-- formulario termino y Condiciones --}}
<div class="panel panel-default mostrar" style="display:none;">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Configuracion de Terminos y Condiciones </h3>
    </legend>
  </div>
  <div class="panel-body">
    <form class="" action="{{route('setting-terminos')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group col-xs-12 ptr">
        <label for="">Terminos y Condiciones</label>
        <input class="form-control" type="file" name="terminos" accept="application/pdf" required>
      </div>
      <div class="form-group col-sm-12 ji">
        <div class="form-group col-sm-6">
          <button class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
        </div>
        <div class="form-group col-sm-6">
          <button type="submit" class="btn green btn-block"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span></button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Button trigger modal -->
<div class="col-xs-12">

  <div class="col-xs-12 panel panel-default taq dih bubu">
    <div class="panel-heading pla">
      <legend>
        <h3 class="panel-title">Formulario de Registro</h3>
        <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModal">
          Agregar Campo
        </button>
      </legend>
    </div>
    <!-- listado -->
    @include('setting.componentes.tablaFormulario')

  </div>
</div>
<!-- Modal -->
@include('setting.componentes.modalFormulario')
<!-- Modal Edit y Delete -->
@include('setting.componentes.modalEditFormulario')





<script type="text/javascript">
  $(document).ready(function () {
    $("#multi").tagsinput('items')
    $('#mytable').DataTable({
      dom: 'flBrtip',
      responsive: true,
      buttons: [
        'csv', 'pdf', 'print', 'excel'
      ]
    });
  })

  function toggle() {
    $('.mostrar').toggle('slow')
  }

  function mostrar() {
    if ($('#tipo').val() == 'select') {
      $('.ocultar').show(100)
      $('.mostrar').hide(100)
      $('.fecha').hide(100)
    } else if ($('#tipo').val() == 'datetime' || $('#tipo').val() == 'date') {
      $('.fecha').show(100)
      $('.ocultar').hide(100)
      $('.mostrar').hide(100)
    } else {
      $('.mostrar').show(100)
      $('.ocultar').hide(100)
      $('.fecha').hide(100)
    }
  }

  function getForm(id) {
    let url = 'getform/' + id
    $.get(url, function (response) {
      response = JSON.parse(response)
      $('#id').val(response.id)
      $('#label').val(response.label)
      $('#requerido').val(response.requerido)
       $('#unico').val(response.unico)
      $('#min').val(response.min)
      $('#max').val(response.max)
      $('#myModaledit').modal('show');
    })
  }

  function alertDelete(id) {
    $('#myModaldelete').modal('show');
    $('#delete').val(id)
  }

  function deleteForm() {
    let id = $('#delete').val()
    let url = 'deleteform/' + id
    $.get(url, function (response) {
      window.location.reload(3000)
    })
  }
</script>
@endsection