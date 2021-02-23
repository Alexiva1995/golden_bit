@extends('layouts.dashboard2')

@section('content')
<div class="col-sm-7 col-sm-offset-2">
    <form action="{{route('install-save-step2')}}" method="POST">
        {{ csrf_field() }}

        <legend>
            <h1>Segundo paso de instalación</h1>
        </legend>
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
        <div class="form-group">
            <label for="">Nombre del Sistema</label>
            <input type="text" required name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Contraseña del sistema</label>
            <input type="password" required name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Correo electronico, para mandar los correos</label>
            <input type="email" required name="correoservidor" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Contraseña del correo</label>
            <input type="text" required name="password_correo" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Configuracion smtp o servidor de correo</label>
            <input type="text" required name="smtp" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Prefijo de las tablas de Wordpress</label>
            <input type="text" required name="prefijo" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Edad Minimo para ingresar el sistema</label>
            <input type="number" required name="edad" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn green col-sm-12">Guardar</button>
        </div>
    </form>
</div>
@endsection