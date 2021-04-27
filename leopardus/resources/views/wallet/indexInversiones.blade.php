@extends('layouts.dashboard')

@section('content')

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Inversion</th>
                            <th>Ganacia</th>
                            <th>Retirado</th>
                            <th>Progreso</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inversiones as $inversion)
                        <tr class="text-center">
                            <td>{{$inversion->id}}</td>
                            <td>$ {{$inversion->precio}}</td>
                            <td>$ {{$inversion->ganado}}</td>
                            <td>$ {{$inversion->retirado}}</td>
                            <td>{{($inversion->progreso * 2)}} %</td>
                            <td>
                                @if ($inversion->progreso == 100)
                                    Completado
                                @else
                                    Activo
                                @endif
                            </td>
                            <td>
                                @if ($inversion->limite > $inversion->retirado)
                                <button class="btn btn-info" onclick="retiro('{{$inversion->id}}', '{{$inversion->balance}}')">
                                    Retirar
                                </button>
                                @endif
                                <a href="{{route('wallet-detalles', [$inversion->id])}}" class="btn btn-info">
                                    Detalles
                                </a>
                                {{-- @if ($inversion['estado'] != 'Retirado')
                                <button class="btn btn-info" onclick="retiro2('{{json_encode($inversion)}}')">
                                    Retirar Inversion
                                </button>
                                @endif --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Retiro -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retiro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('wallet-inversiones-retirar')}}" method="post" id="form_retiro">
            {{ csrf_field() }}
            <input type="hidden" name="idinversion" id="idinversion">
            {{-- <div class="form-group">
                <label for="">Plan</label>
                <input type="text" class="form-control" readonly name="plan" id="plan">
            </div> --}}
            <div class="form-group">
                {{-- <label for="">% Retiro</label> --}}
                <input type="hidden" class="form-control" readonly name="porc_penalizacion" id="porc_penalizacion">
            </div>
            <div class="form-group">
                <label for="">Disponibles</label>
                <input type="text" class="form-control" readonly name="ganacia" id="ganacia">
            </div>
            <div class="form-group">
                <label for="">Monto a Retirar</label>
                <input type="number" min="50" class="form-control" name="retirar" id="retirar" onkeyup="calcularMonto(this.value)">
            </div>
            <div class="form-group">
                <label for="">El 10% de monto a retirar</label>
                <input type="text" class="form-control" readonly name="mont_penalizacion" id="mont_penalizacion">
            </div>
            <div class="form-group">
                <label for="">Total a Recibir</label>
                <input type="text" class="form-control" readonly name="total" id="total">
            </div>
            <div class="form-group">
                <button class="btn btn-info">Retirar</button>
            </div>
          </form>
          <div class="alert alert-warning" role="alert" id="alert_retiro" style="display: none;">
                Las ganancias estan en 0, por lo tanto no se puede retirar
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Retiro Invertido -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retiro Invertido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('wallet-inversiones-retirar-invertido')}}" method="post" id="form_retiro2">
            {{ csrf_field() }}
            <input type="hidden" name="idinversion" id="idinversion2">
            <div class="form-group">
                <label for="">Plan</label>
                <input type="text" class="form-control" readonly name="plan" id="plan2">
            </div>
            <div class="form-group">
                <label for="">Estas Ganancias se perderan</label>
                <input type="text" class="form-control" readonly name="ganacia" id="ganacia2">
            </div>
            <div class="form-group">
                <label for="">Monto a Retirar (Lo Invertido)</label>
                <input type="text" class="form-control" name="retirar" id="retirar2">
            </div>
            <div class="form-group">
                <button class="btn btn-info">Retirar Invertido</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<script>
    function retiro(id, balance) {
        if (balance != 0) {
            $('#form_retiro').fadeIn(1000)
            $('#alert_retiro').fadeOut(1000)
            // let fechaActual = new Date();
            // let fechaInversion = new Date(inversion.fecha_venci.date)
            $('#plan').val('no disponible')
            $('#idinversion').val(id)
            $('#ganacia').val(balance)
            // if (fechaActual.getTime() >= fechaInversion.getTime()) {
            $('#porc_penalizacion').val(10)
            // }else{
            //     $('#porc_penalizacion').val(inversion.penalizacion)
            // }
        }else{
            $('#form_retiro').fadeOut(1000)
            $('#alert_retiro').fadeIn(1000)
        }
        $('#exampleModal').modal('show')
    }

    function retiro2(inversion) {
        inversion = JSON.parse(inversion)
        $('#plan2').val(inversion.plan)
        $('#idinversion2').val(inversion.id)
        $('#ganacia2').val(inversion.rentabilidad)
        $('#retirar2').val(inversion.inversion)
        $('#exampleModal2').modal('show')
    }

    function calcularMonto(monto) {
        let ganancia = $('#ganacia').val()
        let penalizacion = $('#porc_penalizacion').val()
        let result_penali = 0
        let result_retiro = 0
        if (penalizacion != 0) {
            let porc = (penalizacion / 100)
            result_penali = (monto * porc)
        }else{
            let porc = 1
            result_penali = (monto * porc)
        }
        result_retiro = (monto - result_penali)
        $('#mont_penalizacion').val(result_penali)
        $('#total').val(result_retiro)
    }
</script>
@endsection