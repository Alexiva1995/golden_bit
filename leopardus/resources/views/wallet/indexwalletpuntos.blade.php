@extends('layouts.dashboard')

@section('content')

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Puntos Binarios</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <h4 class="text-center">
                                        <strong>{{$wallet['total']}}</strong>
                                    </h4>
                                    <h6 class="text-center">
                                        Puntos Pagados
                                    </h6>
                                </div>
                                <div class="col-12 col-md-4">
                                    <h4 class="text-center">
                                        <strong>{{$wallet['izq']}}</strong>
                                    </h4>
                                    <h6 class="text-center">
                                        Puntos Pendientes Izquierdos
                                    </h6>
                                </div>
                                <div class="col-12 col-md-4">
                                    <h4 class="text-center">
                                        <strong>{{$wallet['der']}}</strong>
                                    </h4>
                                    <h6 class="text-center">
                                        Puntos Pendientes Derechos
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  
@endsection