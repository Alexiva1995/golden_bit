@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')

<div class="card">
  <div class="card-header">
    <legend>
      <h3 class="card-title">Crear Ticket</h3>
    </legend>
  </div>
  <div class="card-content">
    <div class="panel-body">
      <form method="post" action="{{ route('generarticket') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-12 form-group">
          <label class="control-label " style="text-align: center; margin-top:4px;">Titulo del ticket</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" name="titulo"
            required style="background-color:f7f7f7;" />
        </div>

        <div class="col-12 form-group">
          <label class="control-label " style="text-align: center; margin-top:4px;">Comentario</label>
          <textarea class="form-control form-control-solid placeholder-no-fix" type="textarea" autocomplete="off"
            name="comentario" required style="background-color:f7f7f7;">
                  </textarea>
        </div>
        <div class="col-12 form-group">
          <div class="row">
            <div class="col-sm-6" style="padding-left: 10px;">
              <a href="{{ route('misticket') }}" class="btn btn-danger btn-block" id="btn">Cancelar</a>
            </div>
            <div class="col-sm-6" style="padding-left: 10px;">
              <button class="btn btn-info btn-block" type="submit" id="btn">Aceptar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('custom_js')
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('comentario');
</script>
@endpush