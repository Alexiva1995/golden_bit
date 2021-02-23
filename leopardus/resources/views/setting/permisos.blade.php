@extends('layouts.dashboard')

@section('content')
<style>
  .texto-central{
    text-align: center;
  }

  .formulario .checkbox label {
    display: inline-block;
    cursor: pointer;
    color: #000000;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .checkbox label:hover {
      background: rgba(000, 000, 000, 0.2); }

    .formulario .checkbox label:before {
      content: "";
      display: inline-block;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #000000; }

  .formulario .checkbox label:before {
    border-radius: 3px; }
  .formulario .checkbox input[type="checkbox"] {
    display: none; }
    .formulario .checkbox input[type="checkbox"]:checked + label:before {
      display: none; }
    .formulario .checkbox input[type="checkbox"]:checked + label {
      background: #000000;
      color: #white;
      padding: 5px 15px; }
</style>
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
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>

@endif
{{-- informacion --}}
<div class="col-xs-12">

  <div class="col-xs-12 panel panel-default taq dih bubu">
    <div class="panel-heading pla">
      <legend>
        <h3 class="panel-title">Permisos del Admin</h3>
        <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModalAdmin">
          Agregar Admin
        </button>
      </legend>
    </div>
    <!-- listado -->
    @include('setting.componentes.tablaPermiso')

  </div>
</div>
{{-- modal admin --}}
@include('setting.componentes.formAdmin')

{{-- modal permiso --}}
<div class="modal fade" id="Modalpermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">

    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#mytable').DataTable({
      dom: 'flBrtip',
      responsive: true,
      buttons: [
        'csv', 'pdf', 'print'
      ]
    });
  })

  function modal_permiso(ID) {
    let url = '{{url("admin/settings/getpermisos")}}/' + ID
    $.get(url, function (response) {
      $('#modal-content').html(response)
      $('#Modalpermiso').modal('show')
    })
  }
</script>
@endsection