@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('setting-save-tantech')}}" method="POST">
                        <legend>Cambiar valor del bono binario</legend>
                        <p>Nota: Colocar el valor en entero, el sistema se encarga de ponerlo en porcentaje</p>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-12 col-sm-9">
                                <label for="basicInput">Valor Binario</label>
                                <input type="text" class="form-control" name="newvalor" placeholder="{{$settings->valortantech}}" value="{{$settings->valortantech}}">
                            </div>
                            <div class="col-12 col-sm-3 text-center mt-2">
                                <button type="submit" class="btn btn-primary">Cambiar valor binario</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="col-12">
                    <form action="{{route('setting-save-porcent')}}" method="POST">
                        <legend>Cambiar el valor del bono unilevel de referido</legend>
                        <p>Nota: Colocar el valor en entero, el sistema se encarga de ponerlo en porcentaje</p>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-12 col-sm-3">
                                <label for="basicInput">Valor nivel 1</label>
                                <input type="text" class="form-control" name="nivel1" placeholder="{{$settings->valor_niveles->nivel1}}" value="{{$settings->valor_niveles->nivel1}}">
                            </div>
                            <div class="form-group col-12 col-sm-3">
                                <label for="basicInput">Valor nivel 2</label>
                                <input type="text" class="form-control" name="nivel2" placeholder="{{$settings->valor_niveles->nivel2}}" value="{{$settings->valor_niveles->nivel2}}">
                            </div>
                            <div class="form-group col-12 col-sm-3">
                                <label for="basicInput">Valor nivel 3</label>
                                <input type="text" class="form-control" name="nivel3" placeholder="{{$settings->valor_niveles->nivel3}}" value="{{$settings->valor_niveles->nivel3}}">
                            </div>
                            <div class="form-group col-12 col-sm-3">
                                <label for="basicInput">Valor nivel 4</label>
                                <input type="text" class="form-control" name="nivel4" placeholder="{{$settings->valor_niveles->nivel4}}" value="{{$settings->valor_niveles->nivel4}}">
                            </div>
                            <div class="col-12 text-center mt-2">
                                <button type="submit" class="btn btn-primary">Cambiar valor de los niveles</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection