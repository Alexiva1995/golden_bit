<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Campo</h4>
      </div>
      <div class="modal-body">
        <form class="" action="{{route ('setting-update-metodo')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Nombre (*)</label>
            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
          </div>
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/x-png/jpg">
          </div>
          <div class="form-group">
            <label for="">Feed (*)</label>
            <input id="feed" type="number" name="feed" value="{{ old('feed') }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">tipo de feed (*)</label>
            <select id="tipofeed" class="form-control" name="tipofeed" value="{{old('tipofeed')}}">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="0">Monto Fijo</option>
              <option value="1">Porcentaje</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">¿El Pago sera por Correo?</label>
            <select id="correo" class="form-control" name="correo">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">¿El Pago sera por Wallet?</label>
            <select id="wallet" class="form-control" name="wallet">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">¿ El Pago sera por Datos Bancarios?</label>
            <select id="bancario" class="form-control" name="bancario">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="form-group">
              <label for="">Monto minimo que puede se retirar</label>
              <input type="number" step="any" name="monto_min" id="monto_min" class="form-control">
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


<div class="modal fade" id="myModaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Metodo de Pago</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="delete">
        <h2>
          Esta Seguro que quieres Elimina este Metodo de Pago
        </h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="deleteForm()">Borrar</button>
      </div>
    </div>
  </div>
</div>