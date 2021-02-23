@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.pagosusuario', 'name1' => 'iduser', 'type' => 'text', 'text' => 'Buscar Usuario'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.buscar', 'name1' => 'primero', 'name2' =>
'segundo', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

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
                                <center>Correo</center>
                            </th>
                            <th>
                                <center>Monto</center>
                            </th>
                            <th>
                                <center>Fecha</center>
                            </th>
                            <th>
                                <center>Estado</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                            <td>
                                <center>{{$pago->id}}</center>
                            </td>
                            <td>
                                <center>{{$pago->username}}</center>
                            </td>
                            <td>
                                <center>{{$pago->email}}</center>
                            </td>
                            <td>
                                <center>{{$pago->monto}}</center>
                            </td>
                            <td>
                                <center>{{$pago->fechapago}}</center>
                            </td>
                            <td>
                                <center>
                                    @if ($pago->estado == 1)
                                    Aprobado
                                    @elseif ($pago->estado == 0)
                                    En Espera
                                    @endif
                                </center>
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