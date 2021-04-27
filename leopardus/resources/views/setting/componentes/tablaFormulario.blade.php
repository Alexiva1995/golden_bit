
<table id="mytable" class="table table-bordered table-hover table-responsive pli">
  <thead>
    <tr>
      <th><center>ID </center></th>
      <th><center>Label </center></th>
      <th><center>Nombre </center></th>
      <th><center>Tipo </center></th>
      <th><center>Unico </center></th>
      <th><center>Requerido</center></th>
      <th><center>¿Edad?</center></th>
      <th><center>Valor Minimo</center></th>
      <th><center>Valor Maximo</center></th>
      <th><center>Estado</center></th>
      <th><center>Acciones</center></th>
    </tr>
  </thead>
  <tbody>
    @foreach($formulario as $campo)
      <tr>
        <td><center>{{ $campo->id }}</center></td>
        <td><center>{{ $campo->label }}</center></td>
        <td><center>{{ $campo->nameinput }}</center></td>
        <td><center>
          @switch($campo->tipo)
            @case('text')
                Texto
              @break
            @case('email')
                Correo
              @break
            @case('select')
                Selector
              @break
            @case('url')
                Dirección Web
              @break
            @case('date')
                Fecha
              @break
            @case('number')
                Numerico
              @break
            @case('hidden')
                Oculto
              @break
          @endswitch
        </center></td>
        <td>
          <center>
            @if($campo->unico == 1)
              SI
            @else
              NO
            @endif
          </center>
        </td>
        <td>
          <center>
            @if($campo->requerido == 1)
              SI
            @else
              NO
            @endif
          </center>
        </td>
        <td>
          <center>
            @if($campo->input_edad == 1)
              SI
            @else
              NO
            @endif
          </center>
        </td>
        <td><center>{{$campo->min}}</center></td>
        <td><center>{{$campo->max}}</center></td>
        <td>
          @if($campo->desactivable == 1)
            <a href="{{route('setting-update-field', ['id' => $campo->id, 'estado' => ($campo->estado == 1) ? 0 : 1])}}" name="button" class="btn {{ ($campo->estado == 1) ? 'btn-danger' : 'btn-primary' }}">{{ ($campo->estado == 1) ? 'Desactivar' : 'Activar' }}</a>
          @else
            <a name="button" class="btn {{ ($campo->estado == 1) ? 'btn-danger' : 'btn-primary' }}" disabled>{{ ($campo->estado == 1) ? 'Desactivar' : 'Activar' }}</a>
          @endif
        </td>
        <td><center>
          <button value="{{$campo->id}}" class="btn btn-primary" onclick="getForm(this.value)"> <i class="fa fa-edit"></i> </button>
          <button value="{{$campo->id}}" class="btn btn-danger" onclick="alertDelete(this.value)"> <i class="fa fa-trash"></i> </button>
          </center></td>
      </tr>
    @endforeach
  </tbody>
</table>
