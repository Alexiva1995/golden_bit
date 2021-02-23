@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

@include('dashboard.componentView.alert')

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>
                                <center>ID</center>
                            </th>
                            <th>
                                <center>User</center>
                            </th>
                            <th>
                                <center>Rank</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cont = "";
                        @endphp
                        @foreach($usuarios as $usuario)
                        @php
                        $roles = DB::table('roles')->get();
                        @endphp
                        @if ($usuario['rolactual'] != 0)
                        <tr>
                            <td class="text-center">
                                {{ $usuario['id'] }}
                            </td>
                            <td class="text-center">
                                {{ $usuario['nombre'] }}
                            </td>
                            <td class="text-center">
                                <div class="row">
                                    @foreach ($usuario['roles'] as $item)
                                    @if ($item->id <= $usuario['rolactual'] && $item->id >= 1)
                                        @php
                                        $item->estado2 = 0;
                                        $verificar = DB::table('rolespagados')->where([
                                        ['id_rol', '=', $item->id],
                                        ['iduser', '=', $usuario['id']],
                                        ])->first();
                                        if (!empty($verificar) && $verificar->estado != 0) {
                                        $item->estado2 = 1;
                                        }
                                        @endphp
                                        <div class="col-xs-4">
                                            <div class="thumbnail">
                                                <img src="{{asset('rangos/'.$item->imagen)}}" alt="{{$item->name}}">
                                                <div class="caption">
                                                    <small> {{$item->name}} </small>
                                                    <p>
                                                        <a href="{{route('info.rango-actualizar', [$usuario['id'], $item->id, 1])}}"
                                                            class="btn btn-primary"
                                                            {{($item->estado2 == 1) ? 'disabled' : ''}}>
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                        <a href="{{route('info.rango-actualizar', [$usuario['id'], $item->id, 2])}}"
                                                            class="btn btn-danger"
                                                            {{($item->estado2 == 1) ? 'disabled' : ''}}>
                                                            <i class="fa fa-ban"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">User Delete</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.userdelete') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="userdelete" id="userdelete">
                    <div class="form-group">
                        <label for="">Enter the administrator password to proceed</label>
                        <input type="password" class="form-control" name="clave">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>  
    </div>
</div>
<script>
    function eliminarProducto(idproducto) {
        $('#userdelete').val(idproducto)
        $('#myModal').modal('show')
    }
</script>
@endsection