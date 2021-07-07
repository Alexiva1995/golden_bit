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
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Invertido</th>
                            <th>Progreso</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inversiones as $inversion)
                        <tr class="text-center">
                            <td>{{$inversion->id}}</td>
                            <td>{{$inversion->usuario}}</td>
                            <td>{{$inversion->correo}}</td>
                            <td>$ {{$inversion->precio}}</td>
                            <td>{{($inversion->progreso * 2)}} %</td>
                            <td>
                                @if ($inversion->progreso == 100)
                                    Completada
                                @else
                                    Activa
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="reinvertir('{{$inversion->id}}', '{{$inversion->wallet}}')">
                                    Reinvertir
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!-- Modal Actualizar la inversion -->
  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reinversion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4>
                <b>Nota:</b> Esto permitira sumar el monto de la inversion selecionado con el monto a reinvertir
            </h4>
          <form action="{{route('wallet-reinversion')}}" method="post" id="form_retiro2">
            {{ csrf_field() }}
            <input type="hidden" name="idinversion3" id="idinversion3">
            {{-- <div class="form-group">
                <label for="">Plan</label>
                <input type="text" class="form-control" readonly name="plan" id="plan">
            </div> --}}
            <input type="hidden" class="form-control" readonly name="porc_fee" id="porc_fee">
            <div class="form-group">
                <label for="">Disponibles</label>
                <input type="text" class="form-control" readonly name="disponible" id="disponible">
            </div>
            <div class="form-group">
                <label for="">Monto a Reinvertir</label>
                <input type="number" min="50" class="form-control" name="reinversion" onkeyup="calcularMonto2(this.value)">
            </div>
            <div class="form-group">
                <label for="">El 5% de monto a reinvertir</label>
                <input type="text" class="form-control" readonly name="mont_fee" id="mont_fee">
            </div>
            <div class="form-group">
                <label for="">Total a Descontal del saldo</label>
                <input type="text" class="form-control" readonly name="total" id="total_descontar">
            </div>
            <div class="form-group">
                <button class="btn btn-info">Reinvertir</button>
            </div>
          </form>
          <div class="alert alert-warning" role="alert" id="alert_retiro2" style="display: none;">
                El saldo estan en 0, por lo tanto no se puede reinvertir
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function reinvertir(id, balance) {
        if (balance != 0) {
            $('#form_retiro2').fadeIn(1000)
            $('#alert_retiro2').fadeOut(1000)
            $('#plan').val('no disponible')
            $('#idinversion3').val(id)
            $('#disponible').val(balance)
            $('#porc_fee').val(5)
        }else{
            $('#form_retiro2').fadeOut(1000)
            $('#alert_retiro2').fadeIn(1000)
        }
        $('#exampleModal3').modal('show')
    }

    function calcularMonto2(monto) {
        let ganancia = $('#disponible').val()
        let penalizacion = $('#porc_fee').val()
        let result_penali = 0
        let result_retiro = 0
        if (penalizacion != 0) {
            let porc = (penalizacion / 100)
            result_penali = (monto * porc)
        }else{
            let porc = 1
            result_penali = (monto * porc)
        }
        result_retiro = (parseFloat(monto) + parseFloat(result_penali))
        $('#mont_fee').val(result_penali)
        $('#total_descontar').val(result_retiro)
    }
  </script>
@endsection