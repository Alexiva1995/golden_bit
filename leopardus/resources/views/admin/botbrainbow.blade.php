@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
@push('custom_js')
<script>
    $(document).ready(function () {
        $('#mytable2').DataTable({
            dom: 'flBrtip',
            responsive: true,
            order: [5, ['desc']]
        });
    });
</script>
@endpush
{{-- alertas --}}
@include('dashboard.componentView.alert')
<section>
    {{-- <div class="card">
        <div class="card-header">
            <h5 class="card-title">Subir BotBrainbow</h5>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{route('botbrainbow.upbot')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Formato de Subida Bot</label><br>
                        <a href="{{asset('assets/formatoBotBrainbow.xlsx')}}" download>Descargar Formato</a>
                    </div>
                    <div class="form-group">
                        <label for="">Subir Excel</label>
                        <input type="file" name="lote" id="" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <button class="btn btn-primary" data-target="#newBot" data-toggle="modal">Agregar nuevo
                        registro</button>
                </div>
                <div class="table-responsive">
                    <table id="mytable2" class="table zero-configuration">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">
                                    Fondo de inversión
                                </th>
                                <th class="text-center">
                                    Redes Neuronales
                                </th>
                                <th class="text-center">
                                    Acciones
                                </th>
                                <th class="text-center">
                                    Mes
                                </th>
                                <th class="text-center">
                                    Año
                                </th>
                                <th>
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($botbrainbow as $bot)
                            <tr class="text-center">
                                <td>{{$bot->fondo_inversion}}%</td>
                                <td>{{$bot->redes_neuronales}}%</td>
                                <td>{{$bot->acciones}}%</td>
                                <td>{{$bot->mes}}</td>
                                <td>{{$bot->year}}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="update('{{json_encode($bot)}}')">
                                        <i class="fa fa-edit"></i>
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

    <!-- Modal Nuevo Registro -->
    <div class="modal fade" id="newBot" tabindex="-1" role="dialog" aria-labelledby="newBotLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="newBotLabel">Nuevo registro de bot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('botbrainbow.save')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Fondo Inversion</label>
                            <input type="number" class="form-control" name="fondo_inversion" step="any">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Redes Neuronales</label>
                            <input type="number" class="form-control" name="redes_neuronales" step="any">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Acciones</label>
                            <input type="number" class="form-control" name="acciones" step="any">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Mes</label>
                            <select name="mes" class="form-control">
                                <option value="" disabled selected>Seleccione un Mes</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{$i}}">Mes {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Año</label>
                            <input type="number" class="form-control" name="year" max="9999">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Editar Registro --}}
    <div class="modal fade" id="editBot" tabindex="-1" role="dialog" aria-labelledby="editBotLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editBotLabel">Editar Registro Bow</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('botbrainbow.update')}}" method="post">
                        <input type="hidden" name="_token" id="token">
                        <input type="hidden" name="idbot" id="idbot">
                        <div class="form-group">
                            <label for="">Fondo Inversion</label>
                            <input type="number" class="form-control" name="fondo_inversion" step="any" id="fondo_inversion">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Redes Neuronales</label>
                            <input type="number" class="form-control" name="redes_neuronales" step="any" id="redes_neuronales">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Acciones</label>
                            <input type="number" class="form-control" name="acciones" step="any" id="acciones">
                            <p class="text-black text-help">
                                El valor aqui puesto sera tomado directamente como un valor en porcentaje
                                Ej: si colocas 5, este sera tomado como si fuera 5%
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Mes</label>
                            <select name="mes" class="form-control" id="mes">
                                <option value="" disabled selected>Seleccione un Mes</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{$i}}">Mes {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Año</label>
                            <input type="number" class="form-control" name="year" max="9999" id="year">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function update(bot) {
        bot = JSON.parse(bot)
        $('#idbot').val(bot.id)
        $('#fondo_inversion').val(bot.fondo_inversion)
        $('#redes_neuronales').val(bot.redes_neuronales)
        $('#acciones').val(bot.acciones)
        $('#mes').val(bot.mes)
        $('#year').val(bot.year)
        $('#token').val('{{ csrf_token() }}')
        $('#editBot').modal('show')
    }
</script>
@endsection