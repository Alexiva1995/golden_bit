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

<!-- Button trigger modal -->
<div class="col-xs-12">

    <div class="col-xs-12 panel panel-default taq dih bubu">
        <div class="panel-heading pla">
            <legend>
                <h3 class="panel-title">Comision de Metodos de Pagos</h3>
                @if(!empty($comisiones[0]))
                <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModal2">
                    Editar
                </button>
                @endif
            </legend>
        </div>
        @if(empty($comisiones[0]))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>¡Nota: Para modificar primero realice el ajuste de comisiones!</strong> 
        </div>
        @endif
        <div class="panel-body">
            <div class="col-xs-12 ch">
                <h3>Comision Por Transferencia</h3>
                <h5>{{(!empty($comisiones[0])) ? $comisiones[0]->comisiontransf : ''}}</h5>
            </div>
        </div>
    </div>

    <div class="col-xs-12 panel panel-default taq dih bubu">
        <div class="panel-heading pla">
            <legend>
                <h3 class="panel-title">Metodos de Pagos</h3>
                <div>
                    <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModal">
                        Agregar Metodo
                    </button>
                </div>
            </legend>
        </div>


        <!-- listado -->
        @include('setting.componentes.tablaMetodoPago')

    </div>
</div>
<!-- Modal -->
@include('setting.componentes.modalMetodoPago')
@include('setting.componentes.modalEditMetodoPago')
@include('setting.componentes.modalComisionMetodoPago')

<script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            dom: 'flBrtip',
            responsive: true,
            buttons: [
                'csv', 'pdf', 'print', 'excel'
            ]
        });
    });

    function getForm(id) {
        let url = 'getmetodo/' + id
        $.get(url, function (response) {
            response = JSON.parse(response)
            $('#id').val(response.id)
            $('#nombre').val(response.nombre)
            $('#feed').val(response.feed)
            if (response.tipofeed == 0) {
                $('#feed').val(response.feed)
            } else {
                $('#feed').val(response.feed * 100)
            }
            $('#monto_min').val(response.monto_min)
            $('#tipofeed').val(response.tipofeed)
            $('#correo').val(response.correo)
            $('#wallet').val(response.wallet)
            $('#bancario').val(response.datosbancarios)
            $('#myModaledit').modal('show');
        })
    }

    function alertDelete(id) {
        $('#myModaldelete').modal('show');
        $('#delete').val(id)
    }

    function deleteForm() {
        let id = $('#delete').val()
        let url = 'deletemetodo/' + id
        $.get(url, function (response) {
            window.location.reload(3000)
        })
    }
</script>
@endsection