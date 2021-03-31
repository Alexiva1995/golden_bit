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
                @foreach ($wallets as $wallet)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{($wallet->status == 1)? 'Puntos Pagados' : 'Puntos Pendientes'}}</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-text">Puntos Derechos: <strong>{{ $wallet->der }}</strong></h5>
                                <h5 class="card-text">Puntos Izquierdos: <strong>{{$wallet->izq }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Puntos Pendientes</h4>
                            </div>
                            <div class="card-body">
                                @if ($wallet->status == 0)
                                    <h5 class="card-text">Puntos Derechos: <strong>{{($wallet->status == 0)? $wallet->der : 0}}</strong></h5>
                                    <h5 class="card-text">Puntos Izquierdos: <strong>{{($wallet->status == 0)? $wallet->izq : 0}}</strong></h5>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
</div>

  
@endsection