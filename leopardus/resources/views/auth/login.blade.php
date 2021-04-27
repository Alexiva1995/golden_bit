@extends('layouts.login')

@section('content')
    <section class="row flexbox-container">
        <img height="100" src="{{asset('assets/imgLanding/foto-logo.png')}}">
        <div class="col-12 d-flex justify-content-center">
            <div class="card bg-authentication rounded-0 mb-0">
                <div class="row m-0" style="background-color: white;">
                    <div class="col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2">
                            <div class="card-header pb-1">
                                <div class="card-title inicio">
                                    <h4 class="mb-0" style="color: #00000F; font-weight: bold;">Iniciar Sesión</h4>
                                </div>
                                <div class="card-title recuperar" style="display:none;">
                                    <h4 class="mb-0" style="color: #00000F; font-weight: bold;">Recuperar tu clave</h4>
                                </div>

                            </div><p class="px-2" style="color: #00184E;">Bienvenido de nuevo, inicie sesión en su cuenta.</p>

                            {{-- alertas --}}
                            @include('dashboard.componentView.alert')

                            <div class="card-content">
                                <div class="card-body pt-1">
                                    {{-- registro --}}
                                    <form class="login-form inicio" method="POST" action="{{ route('autenticacion-login') }}">
                                        {{ csrf_field() }}
                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="user-name" placeholder="Ingresa tu nombre de usuario"
                                                required value="{{ old('user_email') }}" name="user_email">
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                            <label for="user-name">Nombre de Usuario</label>
                                        </fieldset>

                                        <fieldset class="form-label-group position-relative has-icon-left">
                                            <input type="password" class="form-control" id="user-password"
                                                placeholder="Ingresa tu contraseña" required name="password">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                            <label for="user-password">Clave</label>
                                        </fieldset>
                                        <div class="form-group d-flex justify-content-between align-items-center">
                                            <div class="text-left">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="" style="font-size: 12px; color: #00184E; font-weight: bold;">Recordar</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="text-right">
                                                <a class="card-link" onclick="toggle()" href="javascript:;" style="font-size: 12px; color: #00184E; font-weight: bold;">
                                                    ¿Olvidaste tu Contraseña?
                                                </a>
                                            </div>
                                        </div><br>

                                        <button type="submit" class="btn" style="display: block; background-color: #C8AD77; color: white; font-weight: bold; width: 100%;">INGRESAR</button>

                                        <div style="padding: 30px 0 0 0;" class="text-center">¿No tienes una cuenta? <a href="{{route('autenticacion.new-register')}}" style="font-size: 12px; color: #00184E; font-weight: bold;">Regístrate</a></div>
                                    </form>
                                    {{-- reset password --}}
                                    <form class="forget-form recuperar" action="{{route('autenticacion.clave')}}"
                                        method="post" style="display:none;">
                                        {{ csrf_field() }}
                                        <div class="form-label-group">
                                            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email">
                                            <label for="inputEmail">Ingresa tu </label>
                                        </div>

                                        <div style="padding: 30px 0 0 0;">
                                            <button type="submit" class="btn" style="display: block; background-color: #C8AD77; color: white; width: 100%;">Recuperar Clave</button>
                                        </div>

                                        <div style="padding: 30px 0 0 0;" class="text-center"><a href="javascript:;" onclick="toggle()" style="font-size: 12px; color: #00184E; font-weight: bold;">Regresar al Login</a></div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="login-footer">
                                <div class="divider">
                                    <div class="divider-text">OR</div>
                                </div>
                                <div class="footer-btn d-inline">
                                    <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                    <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                                    <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">
    function toggle() {
        $('.inicio').toggle('slow')
        $('.recuperar').toggle('slow')
    }
</script>
@endsection