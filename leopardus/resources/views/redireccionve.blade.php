@extends('layouts.dashboard')

@section('content')
    <script>
        $(document).ready(function() {
            if (document.getElementById("primeravez").value == false){
                document.getElementById("1").style.display = 'block'; 
                //document.loginform.submit();
            }else{
                document.getElementById("2").style.display = 'block';
            }
        });
    </script>
    
    <input type="hidden" id="primeravez" value="{{ $primeravez }}" >
    
    @if (Session::has('msj'))
        <div class="alert alert-danger">
            <strong>{{Session::get('msj')}}</strong>
        </div>
    @endif
    
    <div class="col-md-3"></div>
    <div class="col-md-6" id="1" style="display: none;">
        <center><h4>Iniciando sesión en la Venta </h4>
        <form name="loginform" id="loginform" action="https://emprende.network/privado/wp-login.php" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="log" id="user_login" aria-describedby="login_error" class="input" value="{{ Auth::user()->user_email }}" size="20" /></label>
            <input type="hidden" name="pwd" id="user_pass" aria-describedby="login_error" class="input" @if (Auth::user()->clave != null) value="{{ decrypt(Auth::user()->clave) }}" @endif size="20" /></label>
            <input name="rememberme" type="hidden" id="rememberme" value="forever"  /> 
            <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary btn-large" value="Conectar" />
            <input type="hidden" name="redirect_to" value="https://emprende.network/privado/affiliate-portal/" />
            <input type="hidden" name="testcookie" value="1" />
        </form></center>
    </div>
    <div class="col-md-6" id="2" style="display: none;">
        <center>
            <form action="{{ route('admin.guardar-clave') }}" method="POST">
                {{ csrf_field() }}
                <label><strong>Por favor, ingrese su contraseña...</strong></label>
                <input class="form-control" type="password" name="clave" id="clave" /><br />
                <input type="submit" class="btn btn-success" value="Verificar">
            </form>
        </center>
    </div>
    <div class="col-md-3"></div>
@endsection
