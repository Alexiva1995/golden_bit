@extends('layouts.landing')

@section('content')
{{-- Navegacion --}}
@include('landing.component.navegacion')
{{-- Navegacion --}}

{{-- Header --}}
@include('landing.component.heroHeader')
{{-- Header --}}

{{-- Precios --}}
@include('landing.component.sectionPricing')
{{-- Precios --}}

{{-- Presentacion --}}
@include('landing.component.sectionFeature')
{{-- Presentacion --}}

{{-- Faq --}}
@include('landing.component.sectionFaq')
{{-- Faq --}}

{{-- Footer --}}
@include('landing.component.footer')
{{-- Footer --}}

@endsection