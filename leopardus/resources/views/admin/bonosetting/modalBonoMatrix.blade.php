<!-- Modal Nuevo Registro -->
<div class="modal fade" id="bonomatrix" tabindex="-1" role="dialog" aria-labelledby="bonomatrixLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="bonomatrixLabel">Configuracion Bono Directo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if (empty($bonomatrix))
                    <form action="{{route('bonosetting.store')}}" method="post">
                        {{ csrf_field() }}
                @else
                <form action="{{route('bonosetting.update', $bonomatrix->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <h5 class="text-center">
                    <strong>Nota:</strong>
                    El Monto Aqui colocado, sera el cobrado por el usuario
                </h5>
                    <input type="hidden" name="type_bono" value="matrix">
                    @for ($i = 1; $i < 11; $i++)
                    <div class="form-group">
                        <label for="">Nivel {{$i}}</label>
                        <input type="number" name="bm_nivel{{$i}}" class="form-control" step="any" value="{{(!empty($bonomatrix)) ? $bonomatrix->settings_bono->$i : 0}}" required>
                    </div>
                    @endfor
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