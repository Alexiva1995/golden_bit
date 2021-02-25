@extends('layouts.dashboard')

@section('content')

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
    <div class="card-content">
        <a href="{{route('wallet-invesiones')}}" class="btn bnt-primary">
            Regresar 
        </a>
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Concepto</th>
                            <th>Porcentage</th>
                            <th>Ganado</th>
                            <th>Retirado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                        <tr class="text-center">
                            <td>{{$detalle->id}}</td>
                            <td>{{$detalle->concepto}}</td>
                            <td>{{$detalle->porcentaje}} %</td>
                            <td>$ {{$detalle->debito}}</td>
                            <td>$ {{($detalle->retirado)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection