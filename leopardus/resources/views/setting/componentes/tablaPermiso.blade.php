<table id="mytable" class="table table-bordered table-hover table-responsive pli">
    <thead>
      <tr>
        <th><center>ID Usuario Admin </center></th>
        <th><center>Nombre Usuarios </center></th>
        <th><center>Estado </center></th>
        <th><center>Permisos </center></th>
      </tr>
    </thead>
    <tbody>
      @foreach($admins as $admin)
        <tr>
          <td><center>{{ $admin->ID }}</center></td>
          <td><center>{{ $admin->display_name }}</center></td>
          <td>
            <center>
              @if($admin->status == 1)
                Activo
              @else
                Inactivo
              @endif
            </center>
          </td>
          <td>
              <center>
                  <button class="btn green btn-block" onclick="modal_permiso({{$admin->ID}})">Asignar</button>
              </center>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  