@extends('layouts.dashboard')

@section('content')

<div class="card">
   <div class="card-content">
      <div class="card-body">
         <form method="POST" action="{{ route('info.todos') }}">
            {{ csrf_field() }}
            <div class="col-12 form-group">
               <label class="control-label " style="text-align: center;">Mostrar todos los reportes</label>
               <button class="btn btn-primary" type="submit">Ver</button>
            </div>
         </form>
      </div>
   </div>
</div>

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', ['route' => 'info.repor-fecha', 'name1' => 'primero', 'name2' =>
'segundo', 'text1' => 'Fecha Desde', 'text1' => 'Fecha Hasta', 'type' => 'date'])

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearchSimple', ['route' => 'info.nombre-bus', 'name1' => 'nombre', 'type' =>
'text', 'text' => 'Buscar Usuario'])

@endsection