<div class="panel panel-default mostrar" style="display:none;">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración del Proceso de Rangos del Sistema </h3>
    </div>
    <div class="panel-body">
        <form class="" action="{{route('setting-save-rango')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="cantnivel" value="{{$cantnivel}}">
            <input type="hidden" name="idsetrol" value="{{(!empty($settingRol)) ? $settingRol->id : '' }}">
            <div class="form-group col-xs-12">
                <label for="">Cantidad de roles</label>
                <input class="form-control" type="number" name="cantrango" id="cantrango" required onchange="detalleRango()">
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Cantidad de Referidos Directos?</label>
                <select class="form-control" name="s_referidoD" id="s_referidoD" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Cantidad de Referidos?</label>
                <select class="form-control" name="s_referido" id="s_referido" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Cantidad de Referidos Activos?</label>
                <select class="form-control" name="s_referidoact" id="s_referidoact" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Puntos Personales?</label>
                <select class="form-control" name="s_personal" id="s_personal" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Puntos Grupales?</label>
                <select class="form-control" name="s_grupal" id="s_grupal" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12" style="display:none" id="vpuntos">
                <label for="">¿Valor de los puntos?</label>
                <input type="number" name="valorpuntos" class="form-control">
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Rango por Comisiones Obtenidas?</label>
                <select class="form-control" name="s_comisiones" id="s_comisiones" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Los Rangos Afectan los niveles?</label>
                <select class="form-control" name="s_nivel" id="s_nivel" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="">¿Los Rangos Reciben Bonos?</label>
                <select class="form-control" name="s_bono" id="s_bono" onchange="detalleRango()">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="col-xs-12" id="rango"></div>
            <div class="form-group col-xs-12">
                <button type="submit" class="btn btn-primary btn-block"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggle() {
        $('.mostrar').toggle('slow')
    }

    function detalleRango() {
        $('#rango').empty()
        let cantRango = (parseInt($('#cantrango').val()) + 1)
        let cantNivel = (parseInt($('#cantnivel').val()) + 1)
        let sReferidos = $('#s_referido').val()
        let sReferidosD = $('#s_referidoD').val()
        let sReferidosAct = $('#s_referidoact').val()
        let sTotalPuntos = $('#s_personal').val()
        let sTotalPuntosGrupales = $('#s_grupal').val()
        let sTotalComisiones = $('#s_comisiones').val()
        let sBono = $('#s_bono').val()
        let sNivel = $("#s_nivel").val()
        let divrango = ''
        if (sTotalPuntos == '1' || sTotalPuntosGrupales == '1') {
            $('#vpuntos').show()
        } else {
            $('#vpuntos').hide()
        }
        for (let i = 1; i < cantRango; i++) {
            divrango = divrango + '<div class="form-group col-xs-12">' +
                '<h5>Rango ' + i + '</h5>' +
                '<div class="col-xs-12">' +
                '<label for="">Nombre Rango ' + i + '</label>' +
                '<input class="form-control" type="text" name="nombrerango' + i + '" required>' +
                '</div>'
            if (sReferidosD == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Cantidad Referidos Directos</label>' +
                    '<input class="form-control" type="number" name="cantrefed' + i + '" required>' +
                    '</div>'
            }
            if (sReferidos == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Cantidad Referidos</label>' +
                    '<input class="form-control" type="number" name="cantrefe' + i + '" required>' +
                    '</div>'
            }
            if (sReferidosAct == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Cantidad Referido Activo</label>' +
                    '<input class="form-control" type="number" name="cantrefeact' + i + '" required>' +
                    '</div>'
            }
            if (sTotalPuntos == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Total Puntos Personales</label>' +
                    '<input class="form-control" type="number" name="totalpunto' + i + '" required>' +
                    '</div>'
            }
            if (sTotalPuntosGrupales == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Total Puntos Grupales</label>' +
                    '<input class="form-control" type="number" name="totalpuntoG' + i + '" required>' +
                    '</div>'
            }
            if (sTotalComisiones == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Total Comisiones</label>' +
                    '<input class="form-control" type="number" name="totalcomi' + i + '" required>' +
                    '</div>'
            }
            if (sNivel == '1') {
                let tmp = ""
                for (let i = 1; i < cantNivel; i++) {
                    tmp = tmp + '<option value="' + i + '">Nivel ' + i + '</option>'
                }
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Nivel que Afecta</label>' +
                    '<select class="form-control" name="nivelafec' + i + '" required>' +
                    '<option value="" selected disabled>Seleccione una opción</option>' +
                    '<option value="0">No Aplica</option>' +
                    tmp +
                    '</select>' +
                    '</div>'
            }
            if (sBono == '1') {
                divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                    '<label for="">Bono Recibido</label>' +
                    '<input class="form-control" type="number" name="totalbono' + i + '" required>' +
                    '</div>'
            }
            let tmp = ""
            for (let i = 1; i < cantRango; i++) {
                tmp = tmp + '<option value="' + i + '">Rango ' + i + '</option>'
            }
            divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
                '<label for="">Rango Previo Nesesario</label>' +
                '<select class="form-control" name="rangoprevio' + i + '" required>' +
                '<option value="" selected disabled>Seleccione una opción</option>' +
                '<option value="0">No Aplica</option>' +
                tmp +
                '</select>' +
                '</div>'
            divrango = divrango + '<div class="col-sm-4 col-xs-12">' +
            '<label for="">Permite Cobrar Comisiones</label>' +
            '<select class="form-control" name="p_cobrar_comision' + i + '" required>' +
            '<option value="" selected disabled>Seleccione una opción</option>' +
            '<option value="0">No</option>' +
            '<option value="1">SI</option>' +
            '</select>' +
            '</div>'
            divrango = divrango + '</div>'
        }
        $('#rango').append(divrango)
    }
</script>