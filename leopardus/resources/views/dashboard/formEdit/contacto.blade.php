{{-- <div class="col-md-12 text-right">
    <button type="button" class="btn btn-secondary mt-2 mb-2" onclick="activarContacto();">Edit</button>
</div> --}}
<div class="col-11">
<form action="{{ action($controler, ['data' => 'contacto']) }}" method="post">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    {{-- <legend>Contacto</legend> --}}
    <input name="id" type="hidden" value="{{$data['segundo']->ID}}">
    <div class="form-group" style="margin-bottom: 15px;">
        <label>Direción 1</label>
        <input name="dirección" type="text" placeholder="{{$data['segundo']->direccion}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->direccion)) ? $data['segundo']->direccion : old('dirección')}}" required>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Direción 2</label>
        <input name="direccion2" type="text" placeholder="{{$data['segundo']->direccion2}}"
            class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->direccion2)) ? $data['segundo']->direccion2 : old('direccion2')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Pais</label>
        <input name="pais" type="text" placeholder="{{$data['segundo']->pais}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->pais)) ? $data['segundo']->pais : old('pais')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Estado</label>
        <input name="estado" type="text" placeholder="{{$data['segundo']->estado}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->estado)) ? $data['segundo']->estado : old('estado')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Cuidad</label>
        <input name="ciudad" type="text" placeholder="{{$data['segundo']->ciudad}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->ciudad)) ? $data['segundo']->ciudad : old('ciudad')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Codigo postal</label>
        <input name="codigo" type="number" placeholder="{{$data['segundo']->codigo}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->codigo)) ? $data['segundo']->codigo : old('codigo')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Telefono Movil</label>
        <input name="phone" type="number" placeholder="{{$data['segundo']->phone}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->phone)) ? $data['segundo']->phone : old('phone')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Telefono Fijo</label>
        <input name="fijo" type="number" placeholder="{{$data['segundo']->fijo}}" class="form-control contacto b-blue"
            value="{{(!empty($data['segundo']->fijo)) ? $data['segundo']->fijo : old('fijo')}}">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="">Correo</label>
        <input name="user_email" type="email" placeholder="{{$data['principal']->user_email}}"
            class="form-control contacto b-blue" value="{{$data['principal']->user_email}}" required>
        <div class="botom1">
            <label for="">Confirmar Correo</label>
            <input name="user_email_confirmation" type="email" placeholder="{{$data['principal']->user_email}}"
                class="form-control contacto b-blue" value="{{$data['principal']->user_email}}" required>
        </div>
    </div>

    <div class="col-12 botom1 text-right">
        {{-- <button type="button" class="btn btn-danger" onclick="cancelarContacto();">Cancel</a> --}}
        <button type="submit" class="btn btn-info">Guardar Cambios</button>
    </div>
</form>


</div>
