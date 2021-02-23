@extends('layouts.dashboard')

@section('content')
@php
use Carbon\Carbon;
$fecha = Carbon::now();
$activo = false;
if ($fecha->dayOfWeek >= 1 && $fecha->dayOfWeek <= 2) { $activo=true; } 
@endphp 

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="mytable" class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Correo</th>
                                <th>Descripción</th>
                                <th>Comisión</th>
                                <th>Retiro</th>
                                <th>Fee</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wallets as $wallet)
                            <tr>
                                <td class="text-center">{{ $wallet->id }}</td>
                                <td class="text-center">{{date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                <td class="text-center">{{ $wallet->correo }}</td>
                                <td class="text-center">{{ $wallet->descripcion }}</td>
                                <td class="text-center"> 
                                    @if ($moneda->mostrar_a_d)
                                        {{$moneda->simbolo}} {{$wallet->debito}}
                                    @else
                                        {{$wallet->debito}} {{$moneda->simbolo}}
                                    @endif
                                </td>
                                <td class="text-center"> 
                                    @if ($moneda->mostrar_a_d)
                                        {{$moneda->simbolo}} {{$wallet->credito}}
                                    @else
                                        {{$wallet->credito}} {{$moneda->simbolo}}
                                    @endif
                                </td>
                                <td class="text-center"> 
                                    @if ($moneda->mostrar_a_d)
                                        {{$moneda->simbolo}} {{$wallet->descuento}}
                                    @else
                                        {{$wallet->descuento}} {{$moneda->simbolo}}
                                    @endif
                                </td>
                                <td class="text-center"> 
                                    @if ($moneda->mostrar_a_d)
                                        {{$moneda->simbolo}} {{$wallet->balance}}
                                    @else
                                        {{$wallet->balance}} {{$moneda->simbolo}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
        {{-- @if (Auth::user()->rol_id != 0)
        <div class="col-xs-12 col-sm-6">
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModalRetiro">Retiro</button>
        </div>
        @endif --}}
    </div>
</div>

@include('wallet/componentes/formRetiro', ['disponible' => Auth::user()->wallet_amount, 'tipowallet' => 1])
@include('wallet/componentes/formTransferencia')

@endsection