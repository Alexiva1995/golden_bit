@extends('layouts.dashboard')

@section('content')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.mostrar-comisiones', 'name1' => 'primero', 'name2' =>
'segundo', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

@endsection