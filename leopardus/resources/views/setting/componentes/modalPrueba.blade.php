<div class="modal fade" id="myModalAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Probar Plantillas de Correo</h4>
            </div>
            <div class="modal-body">
                <form class="" action="{{route('setting-probar-plantilla')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Plantilla a Probar (*)</label>
                        <select class="form-control" name="idplantilla">
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="1">Plantilla de Bienvenida</option>
                            <option value="2">Plantilla de Pago</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Correo que recibira la plantilla</label>
                        <input type="email" name="correod" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Variable Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Variable Correo</label>
                        <input type="email" name="correop" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Variable Clave</label>
                        <input type="text" name="clave" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Probar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>