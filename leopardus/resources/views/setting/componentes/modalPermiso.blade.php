<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Permisos del Usuario {{(!empty($permiso[0]['nameuser'])) ? $permiso[0]['nameuser'] : $user->display_name}}</h4>
</div>
<div class="modal-body">
    <form class="formulario" action="{{route('setting-save-permisos')}}" method="post">
        {{ csrf_field() }}
        <legend>Listado de Permisos</legend>
        <input type="hidden" name="id" value="{{(!empty($permiso[0]['id'])) ? $permiso[0]['id'] : ''}}">
        <input type="hidden" name="iduser" value="{{$user->ID}}">
        <input type="hidden" name="nameuser" value="{{$user->display_name}}">
        {{-- <div class="row"> --}}
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input  type="checkbox" name="nuevo_registro" id="c1" value="1" {{($permiso[0]['nuevo_registro'] == 1) ? 'checked' : '' }}>
                <label for="c1">Nuevo Registro</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="red_usuario" id="c2" value="1" {{($permiso[0]['red_usuario'] == 1) ? 'checked' : '' }}>
                <label for="c2">Red de Usuarios</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="vision_usuario" id="c3" value="1" {{($permiso[0]['vision_usuario'] == 1) ? 'checked' : '' }}>
                <label for="c3">Vision de Usuarios</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="billetera" id="c4" value="1" {{($permiso[0]['billetera'] == 1) ? 'checked' : '' }}>
                <label for="c4">Billetera</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="pago" id="c5" value="1" {{($permiso[0]['pago'] == 1) ? 'checked' : '' }}>
                <label for="c5">Pago</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="informes" id="c6" value="1" {{($permiso[0]['informes'] == 1) ? 'checked' : '' }}>
                <label for="c6">Informes</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="tickets" id="c7" value="1" {{($permiso[0]['tickets'] == 1) ? 'checked' : '' }}>
                <label for="c7">Tickets</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="buzon" id="c8" value="1" {{($permiso[0]['buzon'] == 1) ? 'checked' : '' }}>
                <label for="c8">Buzon</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="ranking" id="c9" value="1" {{($permiso[0]['ranking'] == 1) ? 'checked' : '' }}>
                <label for="c9">Rankings</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="historial_actividades" id="c10" value="1" {{($permiso[0]['historial_actividades'] == 1) ? 'checked' : '' }}>
                <label for="c10">Historial de Actividades</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="email_marketing" id="c11" value="1" {{($permiso[0]['email_marketing'] == 1) ? 'checked' : '' }}>
                <label for="c11">Email Marketing</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="administrar_redes" id="c12" value="1" {{($permiso[0]['administrar_redes'] == 1) ? 'checked' : '' }}>
                <label for="c12">Administrar Redes</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="soporte" id="c13" value="1" {{($permiso[0]['soporte'] == 1) ? 'checked' : '' }}>
                <label for="c13">Soporte</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="ajuste" id="c14" value="1" {{($permiso[0]['ajuste'] == 1) ? 'checked' : '' }}>
                <label for="c14">Ajustes</label>
            </div>
            <div class="form-group col-xs-12 col-sm-6 checkbox">
                <input type="checkbox" name="herramienta" id="c15" value="1" {{($permiso[0]['herramienta'] == 1) ? 'checked' : '' }}>
                <label for="c15">Herramientas</label>
            </div>
        {{-- </div> --}}
        @if ($user->ID != 1)
        <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Actualizar Permisos</button>
            </div>
        @endif
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>