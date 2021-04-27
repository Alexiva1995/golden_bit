@extends('layouts.dashboard')

@section('content')
<script>
    function validarEdad() {
        var tmpedad = $('#edad').val()
        var hoy = new Date();
        var cumpleanos = new Date(tmpedad);

        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        if (edad < 18) {
            document.getElementById("btn").disabled = true;
            document.getElementById("errorEdad").style.display = 'block';
        } else {
            document.getElementById("btn").disabled = false;
            document.getElementById("errorEdad").style.display = 'none';
        }
    }
</script>
@php
$referred = null;
@endphp
@if ( request()->referred_id != null )
@php
$referred = DB::table($settings->prefijo_wp.'users')
->select('display_name')
->where('ID', '=', request()->referred_id)
->first();
@endphp
@endif
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            @if ($referred != null)
            Referido Por: <strong>{{  $referred->display_name }}</strong>
            @endif
        </h4>
    </div>
    <div class="card-content">
        <form class="card-body" method="POST" action="{{ route('autenticacion.save-register') }}">
            <div class="row">
                {{ csrf_field() }}
                {{-- alertas --}}
                <div class="col-12">
                    @include('dashboard.componentView.alert')
                </div>

                <div class="alert alert-danger" style="display: none;" id="errorEdad">
                    <span><strong>¡¡You must be of legal age to register!!</strong></span>
                </div>
                @foreach($campos as $campo)
                @if($campo->tipo == 'select')
                <div class="col-sm-6 col-xs-12 form-group">
                    <select class="form-control " name="{{$campo->nameinput}}"
                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                        <option value="" disabled selected>{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}
                        </option>
                        @foreach($valoresSelect as $valores)
                        @if ($valores['idselect'] == $campo->id)
                        <option value="{{$valores['valor']}}">{{$valores['valor']}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                @elseif($campo->tipo == 'number')
                <div class="col-sm-6 col-xs-12 form-group">
                    <label class="" for=""></label>
                    <input class="form-control " step="1" type="{{$campo->tipo}}"
                        placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                        name="{{$campo->nameinput}}" min="{{(!empty($campo->min)) ? $campo->min : ''}}"
                        max="{{(!empty($campo->max)) ? $campo->max : ''}}"
                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}" value="{{old($campo->nameinput)}}">
                </div>
                @else
                @if($campo->input_edad == 1)
                <div class="col-sm-6 col-xs-12 form-group">
                    <input class="form-control " type="{{$campo->tipo}}"
                        placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                        name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}" id="edad" onchange="validarEdad()">
                </div>
                @else
                <div class="col-sm-6 col-xs-12 form-group">
                    <input class="form-control "
                        placeholder="{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}"
                        type="{{$campo->tipo}}" name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                        minlength="{{(!empty($campo->min)) ? $campo->min : ''}}"
                        maxlength="{{(!empty($campo->max)) ? $campo->max : ''}}"
                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                </div>
                @endif
                @endif
                @endforeach
                <div class="col-12 col-md-6 form-group">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" placeholder="Email (*)"
                        type="text" autocomplete="off" name="user_email" required style="background-color:f7f7f7;"
                        oncopy="return false" onpaste="return false" />
                </div>
                <div class="col-12 col-md-6 form-group">
                    <input class="form-control form-control-solid placeholder-no-fix form-group"
                        placeholder="Email Confirmation (*)" type="text" autocomplete="off"
                        name="user_email_confirmation" required style="background-color:f7f7f7;" oncopy="return false"
                        onpaste="return false" />
                </div>
                <div class="col-12 col-md-6 form-group">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                        autocomplete="off" name="password" placeholder="Password (*)" required
                        style="background-color:f7f7f7;" oncopy="return false" onpaste="return false" />
                </div>
                <div class="col-12 col-md-6 form-group">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                        autocomplete="off" name="password_confirmation" placeholder="Password Confirmation (*)" required
                        style="background-color:f7f7f7;" oncopy="return false" onpaste="return false" />
                </div>
                <input type="hidden" name="ladomatrix" value="{{request()->lado}}">
                @if (request()->referred_id == null)
                <div class="col-xs-12 form-group">
                    <div class="alert alert-info">
                        <button class="close" data-close="alert"></button>
                        <span>
                            If you don't know what your Sponsor's ID is, please register the first User
                        </span>
                    </div>
                    <label class="control-label " style="text-align: center;">Sponsor ID</label>
                    <select name="referred_id" style="background-color:f7f7f7;"
                        class="form-control form-control-solid placeholder-no-fix form-group" required>
                        <option value="" disabled selected>Select a Sponsor User</option>
                        @foreach ($patrocinadores as $user)
                        <option value="{{$user->ID}}">{{$user->display_name}}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="referred_id" value="{{ request()->referred_id }}" />
                @endif
                @if (empty(request()->tipouser))
                <input type="hidden" name="tipouser" value="Normal" />
                @else
                <input type="hidden" name="tipouser" value="{{ request()->tipouser }}" />
                @endif
                <div class="col-12 form-group">
                    <fieldset class="checkbox">
                        <div class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" {{ old('terms') ? 'checked' : '' }} name="terms">
                            <span class="vs-checkbox">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span class="">
                                Acepta terminos y condiciones
                            </span>
                        </div>
                        <a href="{{asset('assets/GOLDEN_BIT_terminos_y_condiciones.pdf')}}" target="_blank"> Ver terminos y condiciones</a>
                    </fieldset>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <a href="{{url('/')}}" class="btn btn-outline-primary btn-inline mb-50">Cancelar</a>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <button type="submit" class="btn btn-primary btn-inline mb-50">Registrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>





@if( isset($settings->enable_auth_fb) && $settings->enable_auth_fb
|| isset($settings->enable_auth_tw) && $settings->enable_auth_tw
|| isset($settings->enable_auth_google) && $settings->enable_auth_google )
<h3>Registrate con tus redes sociales</h3>
@if( $settings->enable_auth_fb )
<a href="{{ route('social.oauth', 'facebook') }}"
    class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-facebook tooltips"
    data-original-title="Facebook" style="margin-right: 10px"></a>
@endif

@if( $settings->enable_auth_tw )
<a href="{{ route('social.oauth', 'twitter') }}"
    class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-green bg-hover-grey-salsa font-white bg-hover-white socicon-twitter tooltips"
    data-original-title="Twitter" style="margin-right: 10px"></a>
@endif
@if( $settings->enable_auth_google )
<a href="{{ route('social.oauth', 'google') }}"
    class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-google tooltips"
    data-original-title="Google" style="margin-right: 10px"></a>
@endif
@endif

@endsection