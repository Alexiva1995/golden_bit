@extends('layouts.login')

@section('content')
{{-- <div class="user-login-5" style="">
    <div class="row bs-reset">
        <div class="col-md-12 login-container bs-reset mt-login-5-bsfix">
            <div class="page-logo">
                <a href="{{ url('/') }}">
<img src="{{ asset('assets/img/logo-light.png') }}" alt="logo" class="logo-default" /> </a>
</div>
</div>
</div>
</div> --}}

@extends('layouts.login')

@section('content')
{{-- @php
    if(!request()->secure())
    {
        header('location: https://greenviewmds.com/mioficina/login');
        // redirect()->secure(request()->getPathInfo(),301);
    }
@endphp --}}


<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="{{asset('assets/imgLanding/logo2.png')}}" alt="branding logo" width="300">
                    {{-- <img src="{{asset('app-assets/images/pages/login.png')}}" alt="branding logo"> --}}
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title inicio">
                                <h4 class="mb-0">
                                    Nueva Clave
                                </h4>
                            </div>
                        </div>
                        {{-- alertas --}}
                        @include('dashboard.componentView.alert')

                        {{-- <p class="px-2">Welcome back, please login to your account.</p> --}}
                        <div class="card-content">
                            <div class="card-body pt-1">
                                {{-- reset password --}}
                                <form class="forget-form" action="{{ route('autenticacion-new-clave') }}" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="iduser" value="{{$iduser}}">
                                    <div class="form-label-group">
                                        <label for="">Nueva Clave</label>
                                        <input class="form-control" type="password" autocomplete="off"
                                            placeholder="Nueva clave" name="password" required>
                                    </div>
                                    <div class="form-label-group">
                                        <label for="">Confirmar Clave</label>
                                        <input class="form-control" type="password" autocomplete="off"
                                            placeholder="Confimar nueva clave" name="password_confirmation" required>
                                    </div>

                                    <div class="float-md-right d-block mb-1 col-12">
                                        <button type="submit" class="btn btn-primary btn-block px-75">
                                            Actualizar
                                        </button>
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