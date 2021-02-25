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
                <input type="hidden" id="url" value="{{Route('liquidacion.detalles', Auth::user()->ID)}}">
                <form action="{{route('liquidacion.procesar.comision')}}" method="post" id="form_comisiones">
                    {{ csrf_field() }}
                    <input type="hidden" name="iduser" id="iduser" value="{{Auth::user()->ID}}">
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="wallet" id="wallet">
                    <table id="mytable2" class="table zero-configuration" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <td>
                                    <button class="btn btn-info" id="select2" type="button" onclick="selectAllComisiones()" style="z-index: 100">Todo</button>
                                    <button class="btn btn-info" id="deselect2" type="button" onclick="deselectAllComisiones()" style="z-index: 100; display:none;">Todo</button>
                                </th>
                                <th>ID Comision</th>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>ID Referido</th>
                                <th>Referido</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody id="listComision">
        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total Comision</th>
                                <th colspan="2" id="totalComision" class="text-right"></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-group mt-2 text-center">
                        <button type="button" onclick="revisar()" class="btn btn-info">Procesar Comisiones</button>
                        <button type="button" onclick="procesar('rechazar')" class="btn btn-danger">Rechazar Comisiones</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('liquidation.componentes.modalComision')

<script>
    function detalles() {
        let url = $('#url').val();
        $.get(url, function (response) {
            if (response != null) {
                let data = JSON.parse(response)
                $('#listComision').empty()
                // $('#mytable2').DataTable().clear();
                // $('#mytable2').DataTable().destroy();
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
                        '<td> $ ' + element.total2 + '<input type="hidden" id="'+ element.id +'" class="" value="' + element.total2 + '"> </td>' +
                        '</tr>')
                });
                $('#mytable2').DataTable({
                    dom: 'flBrtip',
                    responsive: true,
                });
                $('#modaDetallesComision').html('Comisiones Pendiente del usuario ' + data.usuario)
                $('#totalComision').html('$ ' + data.totalPagar)
                
            }
            // $('#modalDetalles').modal('show')
        })
    }

    
    setTimeout(() => {
        detalles()
    }, 1500);

    function revisar() {
        let totalS = 0;
        let totalR = 0;
        let feed = 0;
        let comisiones = $('.listuser2')
        for (let element of comisiones) {
            if (element.checked) {
                $monto = $('#'+element.value).val().replace(',', '.')
                totalS = (totalS + parseFloat($monto))
            }
        }

        feed = (totalS * 0.10)
        totalR = (totalS - feed)
        feed = new Intl.NumberFormat("en-IN").format((totalS * 0.10));

        $('#ts').html(totalS)
        $('#feed').html(feed)
        $('#tr').html(totalR)
        $('#modalComision').modal('show')
    }

    function procesar(accion) {
        $('#action').val(accion)
        $('#form_comisiones').submit()
    }

    function wallet(billetera) {
        $('#wallet').val(billetera)
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