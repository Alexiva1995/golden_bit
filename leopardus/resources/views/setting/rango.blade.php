@extends('layouts.dashboard')

@section('content')
{{-- información --}}
@include('setting.componentes.infoRango');
{{-- formularios --}}
@include('setting.componentes.formRango');
@endsection