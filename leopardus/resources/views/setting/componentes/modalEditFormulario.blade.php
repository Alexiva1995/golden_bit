<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Campo</h4>
      </div>
      <div class="modal-body">
        <form class="" action="{{route ('setting-update-form')}}" method="post">  
          {{ csrf_field() }} 
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="">Informacion del Label (Ej: este label) (*)</label>
            <input id="label" type="text" name="label" value="{{ old('label') }}" class="form-control" required autocomplete="Sr.">
          </div>
          <div class="form-group">
            <label for="">Campo Requerido</label>
            <select id="requerido" class="form-control" name="requerido">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="">Campo Unico</label>
            <select id="unico" class="form-control" name="unico">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          
          <div class="form-group mostrar">
            <label for="">Valor Minimo Permitido</label>
            <input id="min" type="number" class="form-control" name="min" value="{{ old('min') }}">
          </div>
          <div class="form-group mostrar">
            <label for="">Valor Maximo Permitido</label>
            <input id="max" type="number" class="form-control" name="max" value="{{ old('max') }}">
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
          <h4 class="modal-title" id="myModalLabel">Eliminar Campo</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="delete">
          <h2>
            Nota: Al eliminar este campo se borrara tambien la informacion de la base de datos
          </h2>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" onclick="deleteForm()">Borrar</button>
        </div>
      </div>
    </div>
  </div> 
