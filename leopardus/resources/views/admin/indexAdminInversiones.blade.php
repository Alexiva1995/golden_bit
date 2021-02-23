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
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Invertido</th>
                            <th>Progreso</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inversiones as $inversion)
                        <tr class="text-center">
                            <td>{{$inversion->id}}</td>
                            <td>{{$inversion->usuario}}</td>
                            <td>{{$inversion->correo}}</td>
                            <td>$ {{$inversion->precio}}</td>
                            <td>{{($inversion->progreso * 2)}} %</td>
                            <td>
                                @if ($inversion->progreso == 100)
                                    Completada
                                @else
                                    Activa
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