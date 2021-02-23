<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Detalles del Producto
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel1"></h4>
            </div>
            <div class="modal-body">
                <div class="card text-center bg-transparent">
                    <img id="img" src="" alt="" class="card-img-top">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="card-title mt-2">Valor Invertido</div>
                                <p id="invertido" class="card-text"></p>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div id="title" class="card-title mt-2"></div>
                                <p id="content" class="card-text"></p>
                                <p id="price" class="card-text"></p>
                            </div>
                            <h6 class="text-center">
                                <form action="{{route('tienda.inversion')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="inversion" id="invertido2">
                                    <input type="hidden" name="idproducto" id="idproducto">
                                    <input type="hidden" id="title2" name="name">
                                    <input type="hidden" id="price2" name="precio">
                                    <input type="hidden" name="tipo" value="">
                                    <button type="submit" class="btn btn-info">Comprar</button>
                                </form>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>