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
                        <tr>
                            <th>
                                <center>#</center>
                            </th>
                            <th>
                                <center>Usuario</center>
                            </th>
                            <th>
                                <center>Fecha</center>
                            </th>
                            <th>
                                <center>Descripción</center>
                            </th>
                            <th>
                                <center>Puntos Derecha</center>
                            </th>
                            <th>
                                <center>Puntos Izquierda</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wallets as $wallet)
                        <tr>
                            <td>
                                <center>{{$wallet->id}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->usuario}}</center>
                            </td>
                            <td>
                                <center>{{date('d-m-Y', strtotime($wallet->created_at))}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->descripcion}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->puntosD}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->puntosI}}</center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    @include('wallet/componentes/formRetiro', ['disponible' => 0, 'tipowallet' => 0])
    @include('wallet/componentes/formTransferencia')

    <script>
        function metodospago() {
            $('#correo').hide()
            $('#wallet').hide()
            $('#bancario').hide()
            let url = 'wallet/obtenermetodo/' + $('#metodopago').val()
            $.get(url, function (response) {
                let data = JSON.parse(response)
                $('#total').val(0)
                if (data.tipofeed == 1) {
                    $('#comision').val(data.feed * 100)
                    $('#lblcomision').text('Comision de Retiro en Porcentaje')
                    $('#comisionH').val(data.feed)
                    $('#tipo').val(data.tipofeed)
                    $('#monto_min').val(data.monto_min)
                } else {
                    $('#comision').val(data.feed)
                    $('#lblcomision').text('Comision de Retiro Fija')
                    $('#comisionH').val(data.feed)
                    $('#tipo').val(data.tipofeed)
                    $('#monto_min').val(data.monto_min)
                }
                if (data.correo == 1) {
                    $('#correo').show()
                }
                if (data.wallet == 1) {
                    $('#wallet').show()
                }
                if (data.bancario == 1) {
                    $('#bancario').show()
                }
                $('#retirar').removeAttr('disabled')
            })
        }

        function totalRetiro(valor) {
            let resul = 0
            if ($('#tipo').val() == 1) {
                let tmp = valor * $('#comisionH').val()
                resul = valor - tmp
            } else {
                resul = valor - $('#comisionH').val()
            }
            $('#total').val(resul)
        }
    </script>
    @endsection