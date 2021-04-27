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
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr class="text-center">
                            <th>ID Liquidacion</th>
                            <th>ID Usuario</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Monto Bruto</th>
                            <th>Feed</th>
                            <th>Valor USD</th>
                            <th>Billetera</th>
                            <th>Tipo Liquidacion</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liquidaciones as $liquidacion)
                        <tr class="text-center">
                            <td>{{$liquidacion->id}}</td>
                            <td>{{$liquidacion->iduser}}</td>
                            <td>{{$liquidacion->usuario}}</td>
                            <td>{{$liquidacion->email}}</td>
                            <td>{{$liquidacion->monto_bruto}}</td>
                            <td>{{$liquidacion->feed}}</td>
                            <td>{{$liquidacion->total}}</td>
                            <td>{{$liquidacion->wallet_used}}</td>
                            <td>{{$liquidacion->type_liquidation}}</td>
                            <td>
                                <button class="btn btn-info" onclick="aprobar('{{json_encode($liquidacion)}}')">Aprobar</button>
                                <button class="btn btn-danger" onclick="reversar('{{json_encode($liquidacion)}}')">Reversar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('liquidation.componentes.modalReversar')
@include('liquidation.componentes.modalAprobar')

<script>
    function reversar(liquidacion) {
        liquidacion = JSON.parse(liquidacion)
        $('.iduser').val(liquidacion.iduser)
        $('.liquidacion').val(liquidacion.id)
        $('.usuario').html('Usuario: '+ liquidacion.usuario)
        $('.billetera').html('Billetera: '+ liquidacion.wallet_used)
        $('.monto').html('Monto: $ '+ liquidacion.total)
        $('#modaReversarComision').html('Reversar la Liquidacion del usuario '+liquidacion.usuario)

        $('#modalReversar').modal('show')
    }

    function aprobar(liquidacion) {
        liquidacion = JSON.parse(liquidacion)
        $('.iduser').val(liquidacion.iduser)
        $('.liquidacion').val(liquidacion.id)
        $('.usuario').html('Usuario: '+ liquidacion.usuario)
        $('.billetera').html('Billetera: '+ liquidacion.wallet_used)
        $('.monto').html('Monto: $ '+ liquidacion.total)
        $('#modaAprobarComision').html('Aprobar la Liquidacion del usuario '+liquidacion.usuario)

        $('#modalAprobar').modal('show')
    }
</script>
@endsection