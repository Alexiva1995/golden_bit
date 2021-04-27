@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
      @if(Auth::user()->rol_id == '0')
    <legend>
    <h3 class="panel-title">Files</h3>
    <a href="{{ route('archivo.subir') }}" class="btn green btn-block mostrar hh" id="btn" >Add New Material</a>
    </legend>
    @endif
  </div>
 
<div class="panel-body">
     
    
    
    @foreach($archivo as $archi)
   <div class="col-sm-2">
       
          <img src="{{asset('assets/img/descarga.png')}}" alt="" style="width: 120px; box-shadow: 0 0px 2px rgba(0, 0, 0, 1); float: left;">
          </div>
          
          <div class="col-sm-10" style="float: left;"> 
          <h3 style="margin-bottom: 0; margin-top:-3px;">{{$archi->titulo}}</h3>
          <br>
          <p style="margin: 0 0 10px; margin-top:-3px;">{!! $archi->contenido !!}</p>
           <p style="margin: 0 0 10px; margin-top:-3px;">{{$archi->created_at->diffForHumans()}}</p>
        
          <a href="/mioficina/archivo/{{$archi->archivo}}" download="{{$archi->archivo}}" class="btn btn-info"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
          @if(Auth::user()->rol_id == '0')
           <a href="{{ route('archivo.destruir', $archi->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
           @endif
           <hr>
     </div>
     
      @endforeach

        
    
</div>
</div>
   
    
@endsection


