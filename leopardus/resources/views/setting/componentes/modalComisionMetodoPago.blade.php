<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Comisiones de Metodo de Pago</h4>
        </div>
        <div class="modal-body">
          <form class="" action="{{route ('setting-comision-pago')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="">Comision Por Transferencia</label>
              <input type="number" name="transferencia" value="{{ old('transferencia') }}" min="1" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
  