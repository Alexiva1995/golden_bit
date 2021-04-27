@extends('layouts.login')

@section('content')
{{-- @php
    if(!request()->secure())
    {
        header('location: https://greenviewmds.com/mioficina/login');
        // redirect()->secure(request()->getPathInfo(),301);
    }
@endphp --}}
{{-- <script>
    function enviar() {
        document.formulario.submit()
    }
</script> --}}

{{-- <div class="user-login-5" style="">
    <div class="row bs-reset">

        <div class="col-md-12 login-container bs-reset mt-login-5-bsfix">
            <div class="page-logo">
                <a href="{{ url('/') }}">
<img src="{{asset('assets/imgLanding/logo-10.svg')}}" alt="logo" class="logo-default" height="170" />
</a>
</div>
<div class="login-content">
    <form class="login-form" method="POST" action="{{ route('autenticacion-login') }}" id="inicio" name="formulario">
        {{ csrf_field() }}
        @if($errors->any())
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>
                <ul class="no-margin">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
        <br>
        @endif

        @if (Session::has('msj2'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span>
                {{Session::get('msj2')}}
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

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span><i>Complete all fields first</i>.</span>
        </div>

        <div class="row litform" style="margin-bottom: 5px">

            <div class="input-alt">
                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text"
                    autocomplete="off" value="{{ old('user_email') }}" placeholder="User" name="user_email" required
                    style="margin-bottom: 5px;" onkeypress="if (event.keyCode == 13) enviar()" />
            </div>
            <div class="input-alt">
                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                    autocomplete="off" placeholder="Password" name="password" required style="margin-bottom: 5px;"
                    onkeypress="if (event.keyCode == 13) enviar()" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 text-center dabi">
                <div class="col-sm-6 col-xs-6 ">
                    <div class="custom-control form-control-lg custom-checkbox new-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6 brt"><a href="javascript:;" id="forget-password" class="forget-password"
                        onclick="toggle()">forgot password?</a> </div>
            </div>
            <div class=" col-xs-12 text-right">
                <div class="forgot-password">
                    <a href="javascript:;" id="forget-password" class="forget-password"></a>
                </div>
            </div>
            <div class="col-xs-12 text-center">
                <button class="btn btn-alt btn-alt-gray" type="submit">Login</button>
            </div>
        </div>
    </form>
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{route('autenticacion.clave')}}" method="post" style="display:none;"
        id="recuperar">
        {{ csrf_field() }}
        <div class="input-alt">
            <input class="form-control placeholder-no-fix " type="text" autocomplete="off" placeholder="Email"
                name="email" /> </div>
        <div class="form-actions col-xs-12">
            <div class="col-xs-6">
                <button type="button" id="back-btn" class="btn btn-alt btn-alt-gray-outline"
                    onclick="toggle()">Back</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" class="btn btn-alt btn-alt-gray">Send</button>
            </div>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->

</div>
</div>
</div>
</div>
<div class="login-footer">
    <div class="row bs-reset">
        <div class="col-xs-12 bs-reset">
            <div class="login-copyright text-center text-muted">
                <p> ECRIPTO FX </p>
            </div>
        </div>
    </div>
</div>
--}}

<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    {{-- <img src="{{asset('assets/imgLanding/logo-10.svg')}}" alt="branding logo" width="250"> --}}
                    <img src="{{asset('assets/imgLanding/logo2.png')}}" alt="branding logo" width="250">
                    {{-- <img src="{{asset('app-assets/images/pages/login.png')}}" alt="branding logo"> --}}
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title recuperar" >
                                <h4 class="mb-0">Validacion de 2FACT</h4>
                            </div>
                        </div>
                        {{-- alertas --}}
                        @include('dashboard.componentView.alert')

                        {{-- <p class="px-2">Welcome back, please login to your account.</p> --}}
                        <div class="card-content">
                            <div class="card-body pt-1">
                                {{-- reset password --}}
                                <form class="forget-form recuperar" action="{{route('autenticacion.2fact')}}"
                                    method="post">
                                    {{ csrf_field() }}
                                    <div class="form-label-group">
                                        <input type="text" id="inputEmail" name="code" class="form-control" placeholder="Code 2fact">
                                        <label for="inputEmail">Code 2fact</label>
                                    </div>

                                    <div class="float-md-right d-block mb-1 col-12">
                                        <button type="submit" class="btn btn-primary btn-block px-75">Validar Código</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection