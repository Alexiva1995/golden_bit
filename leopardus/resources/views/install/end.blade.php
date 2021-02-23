@extends('layouts.dashboard2')

@section('content')
<div class="panel panel-default mostrar">
    <div class="panel-heading pla">
        <h2>Resumen de la instalacion</h2>
    </div>
    <div class="panel-body">
        <h3>Nombre de Sistema: <strong>{{$inicio->name}}</strong></h3>
        <h3>Correo del Sistema: <strong>{{$inicio->site_email}}</strong></h3>
        <h3>Edad minima para entrar al Sistema: <strong>{{$inicio->edad_minino}}</strong></h3>
        <h3>Nombre del Admistrador: <strong>{{$user->display_name}}</strong></h3>
        <h3>Login del Administrador: <strong>{{$user->user_email}}</strong></h3>
        <h3>Clave del Administrador: <strong>{{$inicio->slogan}}</strong></h3>
        <hr>
        <a href="{{url('login')}}" class="btn btn-primary btn-block">Finalizar</a>
    </div>
</div>
@endsection