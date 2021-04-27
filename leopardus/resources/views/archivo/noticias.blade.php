@extends('layouts.dashboard')

@section('content')

<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>

<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
    <h3 class="panel-title">Add News</h3>
    </legend>
  </div>
 
<div class="panel-body"> 
     
     
              
    <form method="POST" action="{{ route('archivo.guardar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
             @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
             <div class="col-sm-12">
           
               <label class="control-label " style="text-align: center; margin-top:4px;">Title</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" name="titulo" required style="background-color:f7f7f7;"/>
           
            </div>
            
            <div class="col-sm-12">
           
               <label class="control-label " style="text-align: center; margin-top:4px;">Content</label>
                <textarea class="form-control form-control-solid placeholder-no-fix" type="textarea" autocomplete="off" name="contenido" required style="background-color:f7f7f7;"> 
                </textarea>
           
            </div>
            
            
            <div class="col-sm-4">
                <label class="control-label " style="text-align: center; margin-top:4px;">Select an Imagen</label>
                <input type="file" name="imagen">
            </div>
            
             <div class="col-sm-12" style="margin-top:5px;">
              <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" name="nada" value="(Allowed files are: jpg | jpeg | png )" required style="color: #ff0000" readonly/>
            </div>
            <div class="col-sm-12" >
          <div class="col-sm-6" style="padding-left: 10px;">
            <button class="btn green btn-block" type="submit" id="btn" style="margin-bottom: 5px; margin-top: 8px;">Ok</button>
               </div>
               <div class="col-sm-6" style="padding-left: 10px;">
               <a href="{{ route('archivo.contenido') }}" class="btn btn-danger btn-block" id="btn" style="margin-bottom: 5px; margin-top: 8px;">Back</a>
                </div>
                </div>

               
             
            
            </form>
    </div>
     </div>
     
      <script>
        CKEDITOR.replace( 'contenido' );
</script>
@endsection
