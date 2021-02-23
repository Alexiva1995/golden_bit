@extends('layouts.dashboard')

@section('content')

<div class="card">
  <div class="card-content">
    <div class="card-body">
      <form method="POST" action="{{ route('info.mostrar-rango') }}">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-12 col-md-10">
            <label class="control-label " style="text-align: center; margin-top:4px;">Seleccione un Rango</label>
            <select class="form-control form-control-solid placeholder-no-fix form-group" name="rango" required
              style="background-color:f7f7f7;" />
            <option value="" selected disabled>Seleccion Un Rango</option>
            @foreach($rangos as $rango)
            <option value="{{$rango->id}}">{{$rango->name}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-12 col-md-2">
            <button class="btn btn-primary mt-2" type="submit" id="btn">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection