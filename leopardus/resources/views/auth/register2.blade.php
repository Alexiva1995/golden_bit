@extends('layouts.login')

@section('content')
<script>
    function validarEdad(edad) {
        var hoy = new Date();
        var cumpleanos = new Date(edad);

        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        if (edad < {
                {
                    $settings - > edad_minino
                }
            }) {
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

<section class="row flexbox-container">
    <img height="100" class="m-2" src="{{asset('assets/imgLanding/foto-logo.png')}}" alt="branding logo">
    <div class="col-12 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0" style="background-color: white;">
                <div class="col-12 p-0">
                    <div class="card rounded-0 mb-0 p-2">
                        <div class="card-header pt-50 pb-1">
                            <div class="card-title">
                                <h4 class="mb-0" style="color: #00000F; font-weight: bold;">Nuevo Usuario</h4>
                            </div>
                        </div>
                        @if ($referred != null)
                        <p class="px-2">Referido de : <strong>{{ $referred->display_name }}</strong> </p>
                        @endif

                        {{-- alertas --}}
                        <div class="col-12">
                            @include('dashboard.componentView.alert')
                        </div>

                        {{-- <p >Fill the below form to create a new account.</p> --}}
                        <div class="card-content">
                            <div class="card-body pt-0">

                                <form method="POST" action="{{ route('autenticacion.save-register') }}">
                                    {{ csrf_field() }}

                                    @foreach($campos as $campo)
                                    @if($campo->tipo == 'select')
                                    <div class="form-label-group input-alt">

                                        <select class="form-control " name="{{$campo->nameinput}}"
                                            required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                            <option value="" disabled selected>{{$campo->label}}
                                                {{($campo->requerido == 1) ? '(*)' : ''}}</option>
                                            @foreach($valoresSelect as $valores)
                                            @if ($valores['idselect'] == $campo->id)
                                            <option value="{{$valores['valor']}}">{{$valores['valor']}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif($campo->tipo == 'number')
                                    <div class="form-label-group input-alt">
                                        <label class="" for=""></label>
                                        <input class="form-control " step="1" type="{{$campo->tipo}}"
                                            placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                                            name="{{$campo->nameinput}}"
                                            min="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                            max="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                            required="{{($campo->requerido == 1) ? 'true' : 'false'}}"
                                            value="{{old($campo->nameinput)}}">
                                    </div>
                                    @else
                                    @if($campo->input_edad == 1)
                                    <div class="form-label-group input-alt">

                                        <input class="form-control " type="{{$campo->tipo}}"
                                            placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                                            name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                                            onblur="validarEdad(this.value)"
                                            required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                    </div>
                                    @else
                                    <div class="form-label-group input-alt">

                                        <input class="form-control "
                                            placeholder="{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}"
                                            type="{{$campo->tipo}}" name="{{$campo->nameinput}}"
                                            value="{{old($campo->nameinput)}}"
                                            minlength="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                            maxlength="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                            required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach


                                    <div class="form-label-group input-alt">


                                        <input
                                            class="form-control form-control-solid placeholder-no-fix form-label-group"
                                            placeholder="Correo (*)" type="text" autocomplete="off" name="user_email"
                                            required style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>



                                    <div class="form-label-group input-alt">

                                        <input
                                            class="form-control form-control-solid placeholder-no-fix form-label-group"
                                            placeholder="Confirmacion de Correo (*)" type="text" autocomplete="off"
                                            name="user_email_confirmation" required style="background-color:f7f7f7;"
                                            oncopy="return false" onpaste="return false" />
                                    </div>


                                    <div class="form-label-group input-alt">

                                        <input
                                            class="form-control form-control-solid placeholder-no-fix form-label-group"
                                            type="password" autocomplete="off" name="password"
                                            placeholder="Clave (*)" required style="background-color:f7f7f7;"
                                            oncopy="return false" onpaste="return false" />
                                    </div>

                                    <div class="form-label-group input-alt">

                                        <input
                                            class="form-control form-control-solid placeholder-no-fix form-label-group"
                                            type="password" autocomplete="off" name="password_confirmation"
                                            placeholder="Confirmacion de Clave (*)" required
                                            style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>

                                    <input type="hidden" name="ladomatrix" value="{{request()->lado}}">

                                    @if (request()->referred_id == null)
                                    {{-- <div class="col-xs-12 form-label-group input-alt">
            <div class="alert alert-info">
                <button class="close" data-close="alert"></button>
                <span>
                    If you don't know what your Sponsor's ID is, please register the first User
                </span>
            </div>
            <label class="control-label " style="text-align: center;">Sponsor ID</label>
            <select name="referred_id" style="background-color:f7f7f7;"
                class="form-control form-control-solid placeholder-no-fix form-label-group" required>
                <option value="" disabled selected>Select a Sponsor User</option>
                @foreach ($patrocinadores as $user)
                <option value="{{$user->ID}}">{{$user->display_name}}</option>
                                    @endforeach
                                    </select>
                            </div> --}}
                            <input type="hidden" name="referred_id" value="" />
                            @else
                            <input type="hidden" name="referred_id" value="{{ request()->referred_id }}" />
                            @endif

                            @if (empty(request()->tipouser))
                            <input type="hidden" name="tipouser" value="Normal" />
                            @else
                            <input type="hidden" name="tipouser" value="{{ request()->tipouser }}" />
                            @endif

                            <div class="form-group row">
                                <div class="col-12">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" {{ old('terms') ? 'checked' : '' }} name="terms">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="" style="font-size: 12px; color: #00184E; font-weight: bold;">
                                                Acepto los términos y condiciones
                                            </span>
                                        </div>
                                        <a href="{{asset('assets/GOLDEN_BIT_terminos_y_condiciones.pdf')}}" target="_blank">Ver Terminos y Condiciones</a>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn" style="display: block; background-color: #C8AD77; color: white; font-weight: bold; width: 100%;">REGISTRAME</button>

                            <div style="padding: 30px 0 0 0;" class="text-center">¿Ya tienes una cuenta? <a href="{{route('login')}}" style="font-size: 12px; color: #00184E; font-weight: bold;">Inicia Sesión</a></div>


                                {{-- <div class="col-sm-12 col-xs-12 form-label-group">

                                <div class="rem-password">
                                    <label class="rememberme mt-checkbox mt-checkbox-outline new-checkbox">
                                        <input type="checkbox" id="terms" name="terms"
                                            {{ old('terms') ? 'checked' : '' }} />
                                I have read, I accept the terms and conditions
                                <span></span>
                                <a href="{{asset('assets/terminosycondiciones.pdf')}}" download> Download Terms
                                    and Conditions</a>
                                </label>
                        </div>
                        <div class="form-actions col-12" style="margin-bottom:30px; text-align: center;">

                            <div class="col-xs-6">
                                <a class="btn btn-alt btn-alt-gray-outline" href="{{route('login')}}">Cancel</a>
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-alt btn-alt-gray" type="submit" id="btn">Register
                                    me</button>
                            </div>
                        </div>
                    </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

@endsection