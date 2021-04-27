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
                    <thead class="info">
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th class="text-center">
                                Usuario
                            </th>
                            <th class="text-center">
                                ID Compra
                            </th>
                            <th class="text-center">
                                Total Compra
                            </th>
                            <th class="text-center">
                                Disponible Billetera
                            </th>
                            <th class="text-center">
                                Fecha Compra
                            </th>
                            <th class="text-center">
                                Estado Coinpayment
                            </th>
                            <th class="text-center">
                                Estado
                            </th>
                            <th class="text-center">
                                Accion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cont = 0;
                        @endphp
                        @foreach($solicitudes as $solicitud)
                        @php
                        $cont++;
                        @endphp
                        <tr>
                            <td class="text-center">
                                {{ $cont }}
                            </td>
                            <td class="text-center">
                                {{ $solicitud['usuario'] }}
                            </td>
                            <td class="text-center">
                                {{ $solicitud['idcompra'] }}
                            </td>
                            <td class="text-center">
                                
                                    @if ($moneda->mostrar_a_d)
                                    {{$moneda->simbolo}} {{ $solicitud['total'] }}
                                    @else
                                    {{ $solicitud['total'] }} {{$moneda->simbolo}}
                                    @endif
                                
                            </td>
                            <td class="text-center">
                                
                                    @if ($moneda->mostrar_a_d)
                                    {{$moneda->simbolo}} {{ $solicitud['billetera'] }}
                                    @else
                                    {{ $solicitud['billetera'] }} {{$moneda->simbolo}}
                                    @endif
                                
                            </td>
                            <td class="text-center">
                                {{ date('d-m-Y', strtotime($solicitud['fecha'])) }}
                            </td>
                            <td class="text-center">
                                {{$solicitud['coinpayment']}}
                            </td>
                            <td class="text-center">
                                {{$solicitud['estado']}}
                            </td>
                            <td class="text-center">
                                
                                    @if($solicitud['estado'] == 'En Espera')
                                    <a href="{{route('tienda-accion-solicitud', ['id' => $solicitud['idcompra'], 'estado' => 'wc-completed'])}}"
                                        class="btn btn-primary">Aprobar</a>
                                    <a href="{{route('tienda-accion-solicitud', ['id' => $solicitud['idcompra'], 'estado' => 'wc-cancelled'])}}"
                                        class="btn btn-danger">Rechazar</a>
                                    @else
                                    <a href="{{route('tienda-accion-solicitud', ['id' => $solicitud['idcompra'], 'estado' => 'wc-completed'])}}"
                                        class="btn btn-primary" disabled>Aprobar</a>
                                    <a href="{{route('tienda-accion-solicitud', ['id' => $solicitud['idcompra'], 'estado' => 'wc-cancelled'])}}"
                                        class="btn btn-danger" disabled>Rechazar</a>
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