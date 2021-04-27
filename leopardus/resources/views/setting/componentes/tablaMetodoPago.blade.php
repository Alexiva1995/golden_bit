<table id="mytable" class="table table-bordered table-hover table-responsive pli">
    <thead>
        <tr>
            <th>
                <center>ID </center>
            </th>
            <th>
                <center>Nombre </center>
            </th>
            <th>
                <center>Logo </center>
            </th>
            <th>
                <center>Feed </center>
            </th>
            <th>
                <center>Tipo Feed</center>
            </th>
            <th>
                <center>Correo</center>
            </th>
            <th>
                <center>Wallet</center>
            </th>
            <th>
                <center>Datos Bancarios</center>
            </th>
            <th>
                <center>Estado</center>
            </th>
            <th>
                <center>Acciones</center>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($metodospagos as $pago)
        <tr>
            <td>
                <center>{{ $pago->id }}</center>
            </td>
            <td>
                <center>{{ $pago->nombre }}</center>
            </td>
            <td>
                <center>
                    @if ($pago->logo == '')
                        Sin Logo
                    @else
                        <img src="{{asset($pago->logo)}}" alt="{{$pago->nombre}}" height="50">
                    @endif
                </center>
            </td>
            <td>
                <center>
                    @if ($pago->tipofeed == 0)
                        {{$pago->feed}}
                    @else 
                        {{($pago->feed * 100)}}
                    @endif
                </center>
            </td>
            <td>
                <center>
                    @if ($pago->tipofeed == 0)
                        $ 
                    @else 
                        %
                    @endif
                </center>
            </td>
            <td>
                <center>
                    @if($pago->correo == 1)
                    SI
                    @else
                    NO
                    @endif
                </center>
            </td>
            <td>
                <center>
                    @if($pago->wallet == 1)
                    SI
                    @else
                    NO
                    @endif
                </center>
            </td>
            <td>
                <center>
                    @if($pago->datosbancarios == 1)
                    SI
                    @else
                    NO 
                    @endif
                </center>
            </td>
            <td>
                <a href="{{route('setting-update-pagos', ['id' => $pago->id, 'estado' => ($pago->estado == 1) ? 0 : 1])}}"
                    name="button" class="btn {{ ($pago->estado == 1) ? 'btn-danger' : 'btn-primary' }}">{{
                    ($pago->estado == 1) ? 'Desactivar' : 'Activar' }}</a>
            </td>
            <td><center>
                <button value="{{$pago->id}}" class="btn btn-primary" onclick="getForm(this.value)"> <i class="fa fa-edit"></i> </button>
                <button value="{{$pago->id}}" class="btn btn-danger" onclick="alertDelete(this.value, )"> <i class="fa fa-trash"></i> </button>
                </center></td>
        </tr>
        @endforeach
    </tbody>
</table>