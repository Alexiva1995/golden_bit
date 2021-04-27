@extends('layouts.dashboard')

@section('content')

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

@php
$balancen = 0;
$cont = 0;
$totalCompra = 0;
$totalComision = 0;
@endphp

{{-- <script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            dom: 'flBrtip',
            responsive: true,
            buttons: [
                'csv',
                'excel',
                {
                    extend: 'pdfHtml5',
                    footer: true
                },
                'print',
            ],
        });
    });
</script> --}}

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <form method="POST" action="{{ route('info.comisioncompra.fechas') }}">
                <div class="row">
                    {{ csrf_field() }}

                    <div class="col-12 col-sm-6 col-md-5 form-group">
                        <label class="control-label " style="text-align: center; margin-top:4px;">Date From</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="date" autocomplete="off"
                            name="primero" required style="background-color:f7f7f7;" />

                    </div>

                    <div class="col-12 col-sm-6 col-md-5 form-group">
                        <label class="control-label " style="text-align: center; margin-top:4px;">Date To</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="date" autocomplete="off"
                            name="segundo" required style="background-color:f7f7f7;" />
                    </div>
                    <input type="hidden" name="balance" value="{{$balance}}">
                    <input type="hidden" name="tipo" value="{{$tipo}}">

                    <div class="col-12 col-md-2 text-center form-group">
                        <button class="btn btn-primary mt-2" type="submit" id="btn">Search</button>
                    </div>
                    <div class="form-group col-12">
                        @empty(!$fechas)
                        <a class="btn btn-primary" href="{{route('info.comisioncompra', [$balance, $tipo])}}">See
                            All</a>
                        @endempty
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        @empty(!$fechas)
        <div class="card-title">
            <h5><b>Balance report in the date range</b></h5>
            <h5>From: {{date('d-m-Y', strtotime($fechas->primero))}} To:
                {{date('d-m-Y', strtotime($fechas->segundo))}}</h5>
        </div>
        @endempty
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>
                                <center>ID</center>
                            </th>
                            <th>
                                <center>User</center>
                            </th>
                            <th>
                                <center>Concept</center>
                            </th>
                            @if ($balance != 'puntos')
                            @if ($tipo == 'ingreso' || $tipo == 'todo')
                            <th>
                                <center>Purchases</center>
                            </th>
                            @endif
                            @endif
                            @if ($tipo == 'egreso' || $tipo == 'todo')
                            <th>
                                <center>Commission</center>
                            </th>
                            @endif
                            <th>
                                <center>Balance</center>
                            </th>
                            <th>
                                <center>Date</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datos as $comisi)
                        @php
                        if ($tipo == 'ingreso') {
                        $balancen = ($balancen + $comisi['totalcompra']);
                        $totalCompra += $comisi['totalcompra'];
                        }elseif ($tipo == 'egreso'){
                        $balancen = ($balancen + $comisi['totalcomision']);
                        $totalComision += $comisi['totalcomision'];
                        }
                        if ($tipo == 'todo') {
                        $balancen = ($balancen + $comisi['totalcompra']);
                        $balancen = ($balancen - $comisi['totalcomision']);
                        }
                        $cont++;
                        @endphp
                        <tr>
                            <td>
                                <center>{{ $cont }}</center>
                            </td>
                            <td>
                                <center>{{ $comisi['nombre'] }}</center>
                            </td>
                            <td>
                                <center>{{ $comisi['descripcion'] }}</center>
                            </td>
                            @if ($balance != 'puntos')
                            @if ($tipo == 'ingreso' || $tipo == 'todo')
                            <td class="text-center">
                                $ {{ $comisi['totalcompra'] }}
                            </td>
                            @endif
                            @endif
                            @if ($tipo == 'egreso' || $tipo == 'todo')
                            <td class="text-center">
                                $ {{ $comisi['totalcomision'] }}
                            </td>
                            @endif
                            <td class="text-center">
                                $ {{ $balancen }}
                            </td>
                            <td class="text-center">
                                {{ date('Y-m-d', strtotime($comisi['fecha']))}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot> --}}
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Total {{$tipo}}</td>
                            <td colspan="{{($tipo == 'todo') ? '4' : '3'}}" class="text-right">
                                @if ($tipo == 'ingreso')
                                {{$totalCompra}}
                                @elseif($tipo == 'egreso')
                                {{$totalComision}}
                                @endif
                                @if ($tipo == 'todo')
                                {{$balancen}}
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection