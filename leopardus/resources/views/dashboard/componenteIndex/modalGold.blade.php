<div class="modal fade" id="myModalGold" tabindex="-1" role="dialog" aria-labelledby="myModalFormGold">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalFormGold">Obtener Paquete Gold</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="{{route('tienda.pagogold')}}" method="post">
            {{csrf_field()}}
            <div class="row" style="background:white;">
                <div class="col-12">
                    <h4>Beneficios del paquete Gold</h4>
                    <ul>
                        <li>Pagos de Rentabilidad de 1% a 1.5%</li>
                        <li>Pagos en el Bono Binario de 10%</li>
                    </ul>
                </div>
                <div class="col-12">
                  <h5>El monto del Paquete Gold viene siendo el 6% de todas las inversiones activas</h5>
                  <h5>Monto de Inversion: <strong>{{($data['goldPaquete'] / 0.06)}}</strong> </h5>
                  <h5>Valor a Pagar: <strong>{{$data['goldPaquete']}}</strong> </h5>
                </div>
                <div class="form-group col-12 mt-2">
                  <button type="submit" class="btn btn-success btn-block">Activar Paquete</button>
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