@extends('layouts.dashboard')

@section('content')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.fecha', 'name1' => 'fecha', 'type' => 'date', 'text' => 'Fecha'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.mostrar-activo', 'name1' => 'primer_id', 'name2' =>
'segundo_id', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

@endsection