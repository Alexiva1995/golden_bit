<div class="modal fade" id="myModalRetiro" tabindex="-1" role="dialog" aria-labelledby="myModalLabelR">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabelR">Retiro</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="{{route('wallet-retiro')}}" method="post">
          {{csrf_field()}}
          <div class="row" style="background:white;">
            <div class="col-12 col-sm-6">
              <label for="">Seleccione un Metodo de Pago</label>
              <select name="metodopago" id="metodopago" class="form-control" onchange="metodospago()" required>
                <option value="" selected disabled>Selecciones un Opción</option>
                @foreach ($metodopagos as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-12 col-sm-6">
              <label>Monto Disponible</label>
              <input class="form-control" type="text" name="montodisponible" readonly value="{{$disponible}}"/>
            </div>
            {{-- <div class="form-group col-12 col-sm-6">
              <label id="lblcomision">Comision por Retiro</label>
              <input id="comision" class="form-control" type="text" name="comision" readonly value=""/>
              <input id="comisionH" class="form-control" type="hidden"/>
              <input id="tipo" class="form-control" type="hidden"/>
              <input class="form-control" type="hidden" name="tipowallet" value="{{$tipowallet}}"/>
            </div> --}}
            <div class="form-group col-12 col-sm-6">
              <label>Cantidad a Retirar</label>
              <input class="form-control" type="number" name="monto" step="any" required onkeyup="totalRetiro(this.value)"/>
              <input id="total" type="hidden" class="form-control" name="total" readonly/>
            </div>
            {{-- <div class="form-group col-12 col-sm-6">
                <label>Monto minimo a Retirar</label>
                <input id="monto_min" class="form-control" name="monto_min" readonly/>
              </div> --}}
            {{-- <div class="form-group col-12 col-sm-6">
              <label>Monto final a Retirar</label>
              
              <input id="descuento" type="hidden" name="descuento"/>
            </div> --}}
            {{-- <div class="form-group col-12 col-sm-6" id="correo" style="display:none;">
              <label>Correo de la cuenta a asociada el metodo de pago</label>
              <input type="email" class="form-control" name="metodocorreo" required/>
            </div> --}}
            <div class="form-group col-12 col-sm-6" id="wallet" style="display:none;">
              <label>Wallet de la cuenta asociada al metodo de pago</label>
              <input type="text" class="form-control" name="metodowallet" required value="{{$cuentawallet}}" readonly/>
            </div>
            @if (Auth::user()->check_token_google == 1)
            <div class="form-group col-12 col-sm-6">
              <label>Codigo de Google Authenticador</label>
              <input type="text" class="form-control" name="code" required/>
            </div>
            @endif
            <div class="form-group col-12" id="retirar" style="display:none;">
              <button type="submit" class="btn btn-success btn-block retirarbtn">Retirar</button>
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