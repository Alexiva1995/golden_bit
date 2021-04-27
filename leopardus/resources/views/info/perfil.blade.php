@extends('layouts.dashboard')

@section('content')

{{-- alertas --}}
@include('dashboard.componentView.alert')


{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.nombre', 'name1' => 'user_nicename', 'type' => 'text', 'text' => 'Nombre del Usuario'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.usuario', 'name1' => 'id', 'type' => 'text', 'text' => 'ID del Usuario'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.lista', 'name1' => 'primer_id', 'name2' =>
'segundo_id', 'text1' => 'ID Desde', 'text2' => 'ID Hasta', 'type' => 'text'])

@endsection