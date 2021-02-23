@extends('layouts.dashboard')

@section('content')
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

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                
                <li class="nav-item ">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Informacion Personal</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Informacion de Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Perfiles Sociales</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" id="pagos-tab" data-toggle="tab" href="#pagos" role="tab" aria-controls="pagos"
                        aria-selected="false">Pagos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bancaria-tab" data-toggle="tab" href="#bancaria" role="tab"
                        aria-controls="bancaria" aria-selected="false">Verificacion de Segundo Factor</a>
                </li>
            </ul>
            <!-- Aquí es informacion personal -->

            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                     <div class="row">
                    @include('dashboard.formEdit.personal', ['controler' => $data['controler']])
                    <br>
                    @include('dashboard.formEdit.contacto', ['controler' => $data['controler']])
                    <br>
                   
                </div>
                 </div>
                <!-- termina informacion personal -->

                <!-- Empieza informacion de Contacto -->
                {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('dashboard.formEdit.contacto', ['controler' => $data['controler']])
                </div> --}}
                <!-- Termina informacion de Contacto -->

                <!-- Empieza PErfil Social -->
                {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @include('dashboard.formEdit.social', ['controler' => $data['controler']])
                </div> --}}
                <!-- Termina Perfil Social -->

                <!-- Empieza Informaion Bancaria -->
                <div class="tab-pane fade" id="bancaria" role="tabpanel" aria-labelledby="bancaria-tab">
                    @include('dashboard.formEdit.2fact', ['controler' => $data['controler']])
                </div>
                <!-- Termina Informaion Bancaria -->

                <!-- Empieza Pagos -->
                <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="pagos-tab">
                    @include('dashboard.formEdit.pago', ['controler' => $data['controler']])
                </div>
            </div>
            <!-- Termina Pago -->
        </div>
    </div>
</div>


@endsection