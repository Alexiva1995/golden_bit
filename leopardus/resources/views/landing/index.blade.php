@extends('layouts.landing')

@section('content')
{{-- @php
    if(!request()->secure())
    {
        header('location: https://comunidadlevelup.com/');
        // redirect()->secure(request()->getPathInfo(),301);
    }
@endphp --}}

@include('landing.component.faq')
@endif
@endsection