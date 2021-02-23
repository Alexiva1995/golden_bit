<h6>
    <i class="step-icon fa fa-credit-card"></i>
    Membresias
</h6>
<fieldset>
    <div class="row">
        @foreach ($productos as $item)
        <div class="col-12 col-md-4">
            <div class="card h-100 mt-1 mb-1 fondoBoxDashboard"
                style="background: url('{{ asset('products/'.$item->imagen) }}');">
                <div class="card-header d-flex flex-column align-items-end justify-content-center text-right pb-2">
                    <div class="card-title mt-2">
                        <h5>Membresía</h5>
                        <h4 class="text-bold-700">{{$item->post_title}}</h4>
                    </div>
                    <p class="mb-0 mt-1">
                        Duración:
                        <span class="text-bold-700 mt-1">{{$item->duration}} Meses</span>
                    </p>
                    <p class="mb-0 mt-2">
                        Rentabilidad:
                        <span class="text-bold-700 mt-1">{{$item->rentabilidad}}%</span>
                    </p>
                    <p class="mb-0 mt-2">
                        Penalizacion por retiro:
                        <br>
                        <span class="text-bold-700 mt-1">{{$item->penalizacion}}% sobre capital</span>
                    </p>
                </div>
                <div class="card-body text-center" style="background: white; padding:0px">
                    <button type="button" id="product{{$item->ID}}" class="btn btn-info btn-block bg-blue-dark enable mt-1 text-white" onclick="detalles('{{json_encode($item)}}')" style="margin: 0px auto">
                        <a class="view-in-cart">Comprar</a>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</fieldset>