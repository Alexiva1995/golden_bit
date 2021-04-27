@extends('layouts.dashboard')

@section('content')
<style>
    .nav-vertical .nav.nav-tabs .nav-item .nav-link.active::after{
        left: 90% !important;
        background: #02E9FE !important;
    }
    .nav.nav-tabs .nav-item .nav-link.active{
        color: #000000 !important;
    }
    .nav-vertical .nav.nav-tabs.nav-left ~ .tab-content .tab-pane{
        overflow-y: initial !important;
    }
</style>
<script>
    function activarPersonal() {
        $('.personal').attr('disabled', false)
        $('#botom').show('slow')
    }

    function cancelarPersonal() {
        $('.personal').attr('disabled', true)
        $('#botom').hide('slow')
    }

    function activarContacto() {
        $('.contacto').attr('disabled', false)
        $('.botom1').show('slow')
    }

    function cancelarContacto() {
        $('.contacto').attr('disabled', true)
        $('.botom1').hide('slow')
    }

    function activarSocial() {
        $('.social').attr('disabled', false)
        $('#botom2').show('slow')
    }

    function cancelarSocial() {
        $('.social').attr('disabled', true)
        $('#botom2').hide('slow')
    }

    function activarBanco() {
        $('.banco').attr('disabled', false)
        $('#botom3').show('slow')
    }

    function cancelarBanco() {
        $('.banco').attr('disabled', true)
        $('#botom3').hide('slow')
    }

    function activarPago() {
        $('.pago').attr('disabled', false)
        $('#botom4').show('slow')
    }

    function cancelarPago() {
        $('.pago').attr('disabled', true)
        $('#botom4').hide('slow')
    }
</script>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('msj'))
<div class="alert alert-success">
    <strong>¡Felicitaciones!</strong> {{Session::get('msj')}}
</div>
@endif

@if (Session::has('msj2'))
<div class="alert alert-success">
    <button class="close" data-close="alert"></button>
    <span>
        {{Session::get('msj2')}}
    </span>
</div>
@endif

@if (Session::has('msj4'))
<div class="alert alert-info">
    <button class="close" data-close="alert"></button>
    <span>
        {{Session::get('msj4')}}
    </span>
</div>
@endif

@if (Session::has('msj3'))
<div class="alert alert-danger">
    <button class="close" data-close="alert"></button>
    <span>
        {{Session::get('msj3')}}
    </span>
</div>
@endif

{{-- resumen --}}
@include('dashboard.formEdit.resumen')

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="nav-vertical">
                <ul class="nav nav-tabs nav-left flex-column" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-tab1" data-toggle="tab"
                            aria-controls="personal" href="#personal" role="tab"
                            aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contacto-tab2" data-toggle="tab"
                            aria-controls="contacto" href="#contacto" role="tab"
                            aria-selected="false">Contacto</a>
                    </li>
                </ul>
                <!-- Aquí es informacion personal -->

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="row">
                            @include('dashboard.formEdit.personal', ['controler' => $data['controler']])
                        </div>
                    </div>
                    <!-- termina informacion personal -->
                    <!-- Empieza Pagos -->
                    <div class="tab-pane fade" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                        {{-- @include('dashboard.formEdit.pago', ['controler' => $data['controler']]) --}}
                        <div class="row">
                            @include('dashboard.formEdit.contacto', ['controler' => $data['controler']])
                        </div>
                    </div>
                    <!-- Termina Pago -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection