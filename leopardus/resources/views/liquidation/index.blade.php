@extends('layouts.dashboard')

@section('content')


{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <form method="POST" action="{{ route('liquidation.filtro') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="control-label " style="text-align: center; margin-top:4px;" for="activo">
                            <input id="activo" class="form-control form-control-solid placeholder-no-fix" type="checkbox"
                            name="activo" value="1" /> Activos
                        </label>
                        
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="control-label " style="text-align: center; margin-top:4px;">Monto Mayor</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="number"
                            name="mayorque" style="background-color:f7f7f7;" />
                    </div>
                    <div class="col-12 text-center col-md-4" style="padding-left: 10px;">
                        <button class="btn btn-primary mt-2" type="submit" id="btn">Buscar</button>
                        @if ($filtro)
                        <a class="btn btn-danger mt-1" href="{{route('liquidacion')}}">Limpiar</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{route('liquidacion.generar')}}" method="post" id="form_liquidation">
                    {{ csrf_field() }}
                    <table id="mytable" class="table zero-configuration">
                        <thead>
                            <tr class="text-center">
                                <td>
                                    <button class="btn btn-info" id="select" type="button" onclick="selectAll()"
                                        style="z-index: 100">Todo</button>
                                    <button class="btn btn-info" id="deselect" type="button" onclick="deselectAll()"
                                        style="z-index: 100; display:none;">Todo</button>
                                    </th>
                                <th>ID Usuario</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Total Comision</th>
                                <th>Status</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comisiones as $comision)
                            <tr class="text-center">
                                <td>
                                    <input type="checkbox" name="listuser[]" id="" class="listuser custom-checkbox"
                                        value="{{$comision->user_id}}">
                                </td>
                                <td>{{$comision->user_id}}</td>
                                <td>{{$comision->usuario}}</td>
                                <td>{{$comision->email}}</td>
                                <td>$ {{number_format($comision->total, 2, ',', '.')}}</td>
                                <td>
                                    @if ($comision->status == 1)
                                    Activo
                                    @else
                                    Inactivo
                                    @endif
                                </td>
                                <td>
                                    <input type="hidden" id="url{{$comision->user_id}}"
                                        value="{{Route('liquidacion.detalles', $comision->user_id)}}">
                                    <button class="btn btn-info" type="button"
                                        onclick="detalles({{$comision->user_id}})">Detalles</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group mt-2 text-center">
                        <button class="btn btn-info" type="submit">Generar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal de detalles --}}
@include('liquidation.componentes.modalDetalle')

<script>
    function detalles(iduser) {
        let url = $('#url' + iduser).val();
        $.get(url, function (response) {
            let data = JSON.parse(response)
            $('#listComision').empty()
            $('#mytable2').DataTable().clear();
            $('#mytable2').DataTable().destroy();
            data.comisiones.forEach(element => {
                $('#listComision').append('<tr class="text-center">' +

                    '<td>' +
                    '<input type="checkbox" name="listcomisiones[]" id="" class="listuser2" value="' +
                    element.id + '">' +
                    '</td>' +
                    '<td>' + element.id + '</td>' +
                    '<td>' + element.date + '</td>' +
                    '<td>' + element.concepto + '</td>' +
                    '<td>' + element.idreferido + '</td>' +
                    '<td>' + element.referido + '</td>' +
                    '<td> $ ' + element.total2 + '</td>' +
                    '</tr>')
            });
            $('#mytable2').DataTable({
                dom: 'flBrtip',
                responsive: true,
            });
            $('#modaDetallesComision').html('Comisiones Pendiente del usuario ' + data.usuario)
            $('#totalComision').html('$ ' + data.totalPagar)
            $('#iduser').val(iduser)
            $('#modalDetalles').modal('show')
        })
    }

    function procesar(accion) {
        $('#action').val(accion)
        $('#form_comisiones').submit()
    }

    function selectAll() {
        $('.listuser').attr('checked', true)
        $('#select').fadeOut(100)
        $('#deselect').fadeIn(100)
    }

    function deselectAll() {
        $('.listuser').attr('checked', false)
        $('#select').fadeIn(100)
        $('#deselect').fadeOut(100)
    }

    function selectAllComisiones() {
        $('.listuser2').attr('checked', true)
        $('#select2').fadeOut(100)
        $('#deselect2').fadeIn(100)
    }

    function deselectAllComisiones() {
        $('.listuser2').attr('checked', false)
        $('#select2').fadeIn(100)
        $('#deselect2').fadeOut(100)
    }
</script>
@endsection