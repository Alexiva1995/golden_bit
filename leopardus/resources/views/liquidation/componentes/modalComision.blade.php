<div class="modal fade" id="modalComision" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <h4>Total Selecionado: <strong id="ts"></strong></h4>
            <h4>Feed 10%: <strong id="feed"></strong></h4>
            <h4>Total a Recibir: <strong id="tr"></strong></h4>
            <label for="">Billetera</label>
            <input type="text" class="form-control" placeholder="Billetera..." onchange="wallet(this.value)">
            
            <div class="text-center">
                <button type="button" onclick="procesar('liquidar')" class="btn btn-info mt-2">Procesar</button>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
