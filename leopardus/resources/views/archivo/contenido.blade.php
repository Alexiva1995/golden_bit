@extends('layouts.dashboard')

@section('content')
<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
      @if(Auth::user()->rol_id == '0')
    <legend>
    <h3 class="panel-title">News</h3>
    <a href="{{ route('archivo.noticias') }}" class="btn green btn-block mostrar hh" id="btn" >Ade New News</a>
    </legend>
    @endif
  </div>
 
<div class="panel-body">

    
    @foreach($contenido as $archi)
   <div class="col-sm-2">
       
          <img src="/mioficina/imagen/{{$archi->imagen}}" alt="" style="width: 150px; height:120px; box-shadow: 0 0px 2px rgba(0, 0, 0, 1); float: left;">
          </div>
          
          <div class="col-sm-10" style="float: left;"> 
          <h3 style="margin-bottom: -10px; margin-top:-3px;">{{$archi->titulo}}</h3>
          <br>
          <p style="margin: 0 0 10px; margin-top:-3px;">{!! $archi->contenido !!}</p>
           <p style="margin: 0 0 10px; margin-top:-3px;">{{$archi->created_at->diffForHumans()}}</p>
        
        @if(Auth::user()->rol_id == '0')
         <a href="{{ route('archivo.actualizar', $archi->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
           <a href="{{ route('archivo.eliminar', $archi->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
           @endif
           <hr>
     </div>
     
      @endforeach

        
    
</div>
</div>
   
    
@endsection




