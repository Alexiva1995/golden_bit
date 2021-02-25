<div class="col-12">
    {{-- fila 1 --}}
    <section class="mt-2 mb-2">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card h-100 mt-1 mb-1">
                    <div style="border-bottom: solid #E4E4E4 1px; padding: 5px 10px;">
                        <h5 class="text-bold-700 mt-1" style="color: #000D2F;">
                            @if ($data['binario'])
                            <i class="fa fa-circle font-small-3 text-success mr-50"></i> ACTIVO
                            @else
                            <i class="fa fa-circle font-small-3 text-danger mr-50"></i> INACTIVO
                            @endif
                        </h5>
                    </div>
                    <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2" onclick="copyToClipboard('copy')">
                        <div class="avatar p-50 m-0" style="background-color: #02E9FE;">
                            <div class="avatar-content">
                                <i class="feather icon-link font-medium-5" style="color: white;"></i>
                            </div>
                        </div>
                        {{-- <h2 class="text-bold-700 mt-1">Copiar Link</h2>
                        <p class="mb-0">Link de Referir</p> --}}
                        <p style="display:none;" id="copy">
                            {{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}
                        </p>
                    </div>
                    <div class="card-body" style="padding-bottom: 0px;">
                        <div class="row justify-content-center">
                            <h6 class="text-center">Selecione un lado de Registro para su arbol</h6>
                            <div class="custom-control custom-radio p-2">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" onclick="updateSideBinary('D')" @if (Auth::user()->ladoregistrar == 'D') checked @endif>
                                <label class="custom-control-label" for="customRadio1">Derecha</label>
                              </div>
                              <div class="custom-control custom-radio p-2">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" onclick="updateSideBinary('I')" @if (Auth::user()->ladoregistrar == 'I') checked @endif>
                                <label class="custom-control-label" for="customRadio2">Izquierda</label>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Inversiones y rentabilidad --}}
            @foreach ($data['inversiones'] as $inversion)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card h-100 mt-1 mb-1">
                    <div class="card-header d-flex flex-column align-items-center justify-content-center" onclick="copyToClipboard('copy')">
                        <img src="{{$data['img']}}" alt="" height="50">  
                    </div>
                    <div class="card-header d-flex flex-column align-items-start pb-2">
                        <p class="mb-0 mt-1">
                            Inversion
                            <br>
                            <span class="text-bold-700 mt-1">{{number_format($inversion->precio, 2, ',', '.')}}
                                USD</span>
                        </p>
                        <p class="mb-0 mt-2">
                            {{-- <h5 class="text-bold-700 mt-1" style="color: #000D2F;"> --}}
                            Rentabilidad
                            {{-- </h5> --}}
                            <div class="progress progress-xl" style="width:100%; margin-bottom: 0px;">
                                <div class="progress-bar" role="progressbar" aria-valuenow="20"
                                    aria-valuemin="0" style="background: #c8ad77; width:{{$inversion->progreso}}%;">
                                    {{$inversion->progreso}} %
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- fin Inversiones y rentabilidad --}}
        </div>
    </section>
    {{-- fin fila 1 --}}
</div>