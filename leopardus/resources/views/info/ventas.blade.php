@extends('layouts.dashboard')

@section('content')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.informe_fecha', 'name1' => 'fecha', 'type' =>
'date', 'text' => 'Fecha'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.informe_ventas', 'name1' => 'fecha1', 'name2' =>
'fecha2', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

@endsection