<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"></h4>
            </div>
            <div class="modal-body">
                <form action="{{route('tienda-save-cupon')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="idproducto" id="idproducto2">
                    <input type="hidden" name="tipo" value="Cupon">
                    <input type="hidden" name="cupon" id="cupon2">
                    <div class="form-group">
                        <label for="">Disponible en la Billetera</label>
                        <input type="text" class="form-control" id="disponible2" readonly
                            value="{{Auth::user()->wallet_amount}}">
                    </div>
                    <div class="form-group">
                        <label for="">Producto</label>
                        <input type="text" class="form-control" id="producto2" name="name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" class="form-control" id="total2" name="precio" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Billetera restante</label>
                        <input type="text" class="form-control" id="restante2" disabled>
                    </div>
                    <div class="form-group pl">
                        <button type="submit" class="btn green">Comprar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>