<div class="col-12">
    {{-- fila 1 --}}
    <section id="dashboard-ecommerce">
        <div class="row">
            {{-- Cuadro de Inversiones Activas --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-package text-primary font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">{{$data['InversionesActivas']['totalInversiones']}}</h2>
                        <p class="mb-0">Inversiones - Año: {{date('Y')}}</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-1"></div>
                    </div>
                </div>
            </div>
            {{-- Cuadro Invertido --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-credit-card text-success font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">
                            {{number_format($data['totalInvertido']['totalInvertido'], 2, ',', '.')}} $</h2>
                        <p class="mb-0">Total Invertido - Año {{date('Y')}}</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-2"></div>
                    </div>
                </div>
            </div>
            {{-- Cuadro de usuarios --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-danger font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">{{$data['totalusers']['totalusers']}}</h2>
                        <p class="mb-0">Usuarios Registrado - Año {{date('Y')}}</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-3"></div>
                    </div>
                </div>
            </div>
            {{-- Cuadro de Link de referido --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100 d-flex flex-column align-items-center justify-content-center">
                    <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2" onclick="copyToClipboard('copy')">
                        <div class="avatar p-50 m-0" style="background-color: #02E9FE;">
                            <div class="avatar-content">
                                <i class="feather icon-link font-medium-5" style="color: white;"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">Copiar Link</h2>
                        <p class="mb-0">Link de Referir</p>
                        <p style="display:none;" id="copy">
                            {{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <label class="text-center">Selecione un lado de Registro para su arbol</label>
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

            {{-- Dinero Semanal --}}
            <div class="col-12 mt-2">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">Entrada Mensual - Año {{date('Y')}}</h4>
                        {{-- <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p> --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-start">
                                <div class="mr-2">
                                    <p class="mb-50 text-bold-600">Este Mes</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">$</sup>
                                        <span
                                            class="text-success">{{number_format($data['totalEntrada']['totalActual'], 2, ',', '.')}}</span>
                                    </h2>
                                </div>
                                <div>
                                    <p class="mb-50 text-bold-600">Mes Anterior</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">$</sup>
                                        <span
                                            class="text-success">{{number_format($data['totalEntrada']['totalAnterior'], 2, ',', '.')}}</span>
                                    </h2>
                                </div>

                            </div>
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tipo de Inversiones --}}
            <div class="col-md-4 col-12 mt-2">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="card-title">Division de Paquetes - Año {{date('Y')}}</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="customer-chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">ORO</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$data['divisiones']['ORO']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">PLATA</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$data['divisiones']['PLATA']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-danger"></i>
                                    <span class="text-bold-600">BRONCE</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$data['divisiones']['BRONCE']}}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- tabla de ordenes --}}
            <div class="col-12 col-md-8 mt-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="mb-0">Ultimos Ordenes - Año {{date('Y')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            <table class="table table-hover-animation mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>N° ORden</th>
                                        <th>STATUS</th>
                                        <th>CORREO</th>
                                        <th>MONTO</th>
                                        <th>PLAN</th>
                                    </tr>
                                </thead>
                                {{-- <td><i class="fa fa-circle font-small-3 text-danger mr-50"></i>Canceled</td> --}}
                                <tbody>
                                    @foreach ($data['listadoOrdenes'] as $orden)
                                    <tr class="text-center">
                                        <td>{{$orden['id']}}</td>
                                        <td>
                                            @if ($orden['estado'] == 0)
                                            <i class="fa fa-circle font-small-3 text-warning mr-50"></i> Pendiente
                                            @else
                                            <i class="fa fa-circle font-small-3 text-success mr-50"></i> Completada
                                            @endif
                                        </td>
                                        <td class="p-1">
                                            {{$orden['correo']}}
                                        </td>
                                        <td>
                                            $ {{$orden['inversion']}}
                                        </td>
                                        <td>
                                            {{$orden['plan']}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- fin fila 1 --}}
</div>

@push('page_vendor_js')
<script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/scripts/graficasAdmin.js')}}"></script>
<script>
    totalInversiones("{{json_encode($data['InversionesActivas']['arregloInversiones'])}}")
    totalInvertido("{{json_encode($data['totalInvertido']['arregloInvertido'])}}")
    totalUsers("{{$data['totalusers']['arrayregistro']}}")
    entradaMensual("{{$data['totalEntrada']['anterior']}}", "{{$data['totalEntrada']['actual']}}")
    divisiones("{{$data['divisiones']['total']}}")
</script>
@endpush