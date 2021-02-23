<div class="modal fade" id="modalReversar" tabindex="-1" role="dialog" aria-labelledby="modaReversarComision">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="modaReversarComision"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="{{route('liquidacion.update')}}" method="post" id="form_comisiones">
                {{ csrf_field() }}
                <input type="hidden" name="iduser" class="iduser">
                <input type="hidden" name="liquidacion" class="liquidacion">
                <input type="hidden" name="action" value="reversar">
                <h5 class="usuario"></h5>
                <h5 class="billetera"></h5>
                <h5 class="monto"></h5>
                <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea name="comentario" class="form-control" required></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-danger">Reversar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
