@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'gestion.gestion', 'name1' => 'user_nicename', 'type'
=> 'text', 'text' => 'Name User'])

@endsection