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
                            <th>Hash</th>
                            <th>Valor USD</th>
                            <th>Billetera</th>
                            <th>Tipo Liquidacion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liquidaciones as $liquidacion)
                        <tr class="text-center">
                            <td>{{$liquidacion->id}}</td>
                            <td>{{$liquidacion->iduser}}</td>
                            <td>{{$liquidacion->usuario}}</td>
                            <td>{{$liquidacion->email}}</td>
                            <td>{{$liquidacion->hash}}</td>
                            <td>{{$liquidacion->total}}</td>
                            <td>{{$liquidacion->wallet_used}}</td>
                            <td>{{$liquidacion->type_liquidation}}</td>
                            <td>
                                @if ($liquidacion->status == 0)
                                    Pendiente
                                @elseif($liquidacion->status == 1)
                                    Liquidada
                                @elseif($liquidacion->status == 2)
                                    Reversada
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection