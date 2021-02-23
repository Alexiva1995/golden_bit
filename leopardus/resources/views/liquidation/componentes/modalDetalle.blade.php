<div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="modaDetallesComision">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="modaDetallesComision"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="{{route('liquidacion.procesar.comision')}}" method="post" id="form_comisiones">
                {{ csrf_field() }}
                <input type="hidden" name="iduser" id="iduser">
                <input type="hidden" name="action" id="action">
                <table id="mytable2" class="table zero-configuration" style="width: 100%">
                    <thead>
                        <tr class="text-center">
                            <td>
                                <button class="btn btn-info" id="select2" type="button" onclick="selectAllComisiones()" style="z-index: 100">Todo</button>
                                <button class="btn btn-info" id="deselect2" type="button" onclick="deselectAllComisiones()" style="z-index: 100; display:none;">Todo</button>
                            </th>
                            <th>ID Comision</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>ID Referido</th>
                            <th>Referido</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody id="listComision">
    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total Comision</th>
                            <th colspan="2" id="totalComision" class="text-right"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="form-group mt-2 text-center">
                    <button type="button" onclick="procesar('liquidar')" class="btn btn-info">Procesar Comisiones</button>
                    <button type="button" onclick="procesar('rechazar')" class="btn btn-danger">Rechazar Comisiones</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
