<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Campo</h4>
      </div>
      <div class="modal-body">
        <form class="" action="{{route ('setting-save-form')}}" method="post"> 
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Informacion del Label (Ej: este label) (*)</label>
            <input type="text" name="label" value="{{ old('label') }}" class="form-control" required autocomplete="honorific-prefix:'Sr.'">
          </div>
          <div class="form-group">
            <label for="">Nombre del Campo (*)</label>
            <input type="text" name="nameinput" value="{{ old('nameinput') }}" class="form-control" required>
            <p class="help-block">Nota: Este campo no puede tener espacio, pero si puede tener _, ya que este campo va a crear un campo en la tabla de la bd donde guadara la informacion.</p>
          </div>
          <div class="form-group">
            <label for="">Campo Requerido</label>
            <select class="form-control" name="requerido">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="">Campo Unico</label>
            <select class="form-control" name="unico">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="">Tipo de Campo (*)</label>
            <select class="form-control" name="tipo_campo" id="tipo" onchange="mostrar()" required>
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="text">Texto</option>
              <option value="email">Correo</option>
              <option value="select">Selector (Ej: este Campo)</option>
              <option value="url">Dirección Web</option>
              <option value="date">Fecha</option>
              <option value="datetime">Fecha con hora</option>
              <option value="number">Numerico</option>
              <option value="hidden">Oculto</option>
            </select>
          </div>
          <div class="form-group ocultar" id="multi_campo" style="display:none;">
            <label for="">Valores del Campo Multi Opciones</label>
            <input type="text" name="valores" id="multi" value="{{ old('valores') }}" data-role="tagsinput" value="" class="form-control">
          </div>
          <div class="form-group fecha" style="display:none;">
            <label for="">¿Este Campo es de edad?</label>
            <select class="form-control" name="edad">
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="form-group mostrar">
            <label for="">Valor Minimo Permitido</label>
            <input type="number" class="form-control" name="min" value="{{ old('min') }}">
          </div>
          <div class="form-group mostrar">
            <label for="">Valor Maximo Permitido</label>
            <input type="number" class="form-control" name="max" value="{{ old('max') }}">
          </div>
          <div class="form-group">
            <label for="">¿Este Campo se Puede Desactivar? (*)</label>
            <select class="form-control" name="desactivable" required>
              <option value="" selected disabled>Seleccione una opción</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
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
