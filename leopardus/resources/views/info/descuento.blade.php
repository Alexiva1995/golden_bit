@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')


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
                                <center>Descripcion</center>
                            </th>
                            <th>
                                <center>Descuento</center>
                            </th>
                            <th>
                                <center>Fecha</center>
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
                                <center>{{$pago->usuario}}</center>
                            </td>
                            <td>
                                <center>{{$pago->descripcion}}</center>
                            </td>
                            <td>
                                <center>{{$pago->descuento}}</center>
                            </td>
                            <td>
                                <center>{{date('d-m-Y', strtotime($pago->created_at))}}</center>
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