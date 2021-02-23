<div class="modal fade" id="myModalTrasferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabelT">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelT">Transferencia</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('wallet-transferencia')}}" oninput="total.value=parseInt(monto.value)-parseInt(comision.value)" method="post">
            {{ csrf_field() }}
            <div class="row" style="background:white;">
                <div class="form-group col-xs-12 col-sm-6">
                    <label>Monto Disponible</label>
                    <input class="form-control" type="text" name="montodisponible" readonly value="{{Auth::user()->wallet_amount}}">
                </div>
                <div class="form-group col-xs-12 col-sm-6">
                    <label>Comision por Transferencia</label>
                    <input class="form-control" type="text" name="comision" readonly value="{{$comisiones[0]->comisiontransf}}">
                </div>
                <div class="form-group col-xs-12 col-sm-6">
                    <label>Cantidad a Transferir</label>
                    <input class="form-control" type="number" name="monto" required>
                </div>
                <div class="form-group col-xs-12 col-sm-6">
                    <label>Monto final a Transferir</label>
                    <output class="form-control" name="total" readonly>
                </div>
                <div class="form-group col-xs-12">
                    <label>Correo del usuario a Transferir</label>
                    <input class="form-control" name="usuario" required>
                </div>
                <div class="form-group col-xs-12">
                    <button type="submit" class="btn green btn-block">Transferir</button>            
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>