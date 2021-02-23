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
                                <center>Tantech</center>
                            </th>
                            <th>
                                <center>Retiro Tantech</center>
                            </th>
                            <th>
                                <center>Tantech Totales</center>
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
                                <center>{{$wallet->puntos}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->creditocoin}}</center>
                            </td>
                            <td>
                                <center>{{$wallet->tantechcoin}}</center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (Auth::user()->rol_id != 0)
        <div class="col-xs-12 col-sm-6">
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModalRetiro">Retiro</button>
        </div>
        @endif
    </div>
</div>

@include('wallet/componentes/formRetiro', ['disponible' => Auth::user()->coin_amount, 'tipowallet' => 2])
@include('wallet/componentes/formTransferencia')

<script>
    function metodospago() {
        $('#correo').hide()
        $('#wallet').hide()
        $('#bancario').hide()
        let url = 'obtenermetodo/' + $('#metodopago').val()
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
            $('#retirar').show()
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