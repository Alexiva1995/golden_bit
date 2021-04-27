@extends('layouts.dashboard')

@section('content')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'admin.vista', 'name1' => 'user_email', 'type' =>
'text', 'text' => 'Buscar Usuario'])
@endsection