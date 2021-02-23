<!-- Modal Nuevo Registro -->
<div class="modal fade" id="bonodirecto" tabindex="-1" role="dialog" aria-labelledby="bonodirectoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="bonodirectoLabel">Configuracion Bono Directo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                @if (empty($bonodirecto))
                    <form action="{{route('bonosetting.store')}}" method="post">
                        {{ csrf_field() }}
                @else
                <form action="{{route('bonosetting.update', $bonodirecto->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                @endif
                    <h5 class="text-center">
                        <strong>Nota:</strong>
                        Colocar todos los valores enteros, el sistema los dividira por 100, para obtener el porcentaje
                        <br>
                        <small>Ejemplo si coloca 15, el sistema lo pondra como 0,15 y asi sucesivamente</small>
                    </h5>
                    <input type="hidden" name="type_bono" value="directo">
                    <div class="form-group">
                        <label for="">Bronce</label>
                        <input type="number" name="bd_bronce" class="form-control" required value="{{(!empty($bonodirecto)) ? ($bonodirecto->settings_bono->bronce * 100) : 0}}">
                    </div>
                    <div class="form-group">
                        <label for="">Plata</label>
                        <input type="number" name="bd_plata" class="form-control" required value="{{(!empty($bonodirecto)) ? ($bonodirecto->settings_bono->plata * 100) : 0}}">
                    </div>
                    <div class="form-group">
                        <label for="">Oro</label>
                        <input type="number" name="bd_oro" class="form-control" required value="{{(!empty($bonodirecto)) ? ($bonodirecto->settings_bono->oro * 100) : 0}}">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>