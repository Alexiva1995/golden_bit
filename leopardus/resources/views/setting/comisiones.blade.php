@extends('layouts.dashboard')

@section('content')
@if (Session::has('msj'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>¡Enhorabuena!</strong> {{Session::get('msj')}}
</div>
@endif


<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Bono Por Activacion y Comision de Primera Compra</h3>
      <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModal2">
        Editar
      </button>
  </div>
  </legend>
  <div class="panel-body">
      <div class="alert alert-info alert-dismissible" role="alert">
          <strong>Nota:</strong> Para desactivar este bono deben el valor en 0
        </div>
    <div class="col-xs-12 col-sm-6">
      <h5>Bono por Activacion</h5>
      @empty(!$settingComision)
      <input type="text" readonly class="form-control" value="{{$settingComision->bonoactivacion}}">
      @endempty
    </div>
    <div class="col-xs-12 col-sm-6">
        <h5>Recibir Bono de los Usuario</h5>
        @empty(!$settingComision)
        <input type="text" readonly class="form-control" value="{{($settingComision->directos == 1) ? 'Directos' : 'Todos en red'}}">
        @endempty
      </div>
    <div class="col-xs-12 col-sm-6">
        <h5>Aceptar Primera Compra</h5>
        @empty(!$settingComision)
        <input type="text" readonly class="form-control" value="{{($settingComision->primera_compra == 1) ? 'SI' : 'NO'}}">
        @endempty
      </div>
  </div>
</div>


<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">ID de productos que no generan comisiones</h3>
      <button type="button" class="btn green btn-block hh" data-toggle="modal" data-target="#myModal3">
        Editar
      </button>
  </div>
  </legend>
  <div class="panel-body">
    <div class="col-xs-12">
      <h5>ID de productos</h5>
      <input type="text" readonly class="form-control" value="{{$settings->id_no_comision}}">
    </div>
  </div>
</div>


<!-- informacion -->
<div class="panel panel-default mostrar">
  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Información de las comisiones del Sistema </h3>
      <button class="btn green btn-block mostrar hh" onclick="toggle()">Editar</button>
    </legend>
  </div>
  <div class="panel-body">
    @empty(!$settingComision)
    <div class="col-sm-3 col-xs-12">
      <h5>Niveles de Cobro</h5>
      <input type="text" class="form-control" readonly value="{{$settingComision->niveles}}">
    </div>
    <div class="col-sm-3 col-xs-12">
      <h5>Tipo</h5>
      <input type="text" class="form-control" readonly value="{{$settingComision->tipocomision}}">
    </div>
    <div class="col-sm-3 col-xs-12">
      <h5>Se calcula por</h5>
      <input type="text" class="form-control" readonly value="{{$settingComision->tipopago}}">
    </div>
    <div class="col-sm-3 col-xs-12">
      @if($settingComision->tipocomision == 'general')
      <h5>Valor General</h5>
      <h5>
        @if ($settingComision->tipopago == 'porcentaje')
        <input type="text" class="form-control" readonly value="{{$settingComision->valorgeneral*100}} %">
        @else
        <input type="text" class="form-control" readonly value="{{$settingComision->valorgeneral}} $">
        @endif
      </h5>
      @elseif($settingComision->tipocomision == 'detallado')
      <h5>Valor Detallado</h5>
      <h5>
        @foreach($settingComision->valordetallado as $primerarreglo)
        @foreach($primerarreglo as $nivel => $valor)
        @if ($settingComision->tipopago == 'porcentaje')
        <input type="text" class="form-control" readonly value="{{$nivel}} - Valor: {{($valor * 100)}} %">
        @else
        <input type="text" class="form-control" readonly value="{{$nivel}} - Valor: {{$valor}} $">
        @endif
        @endforeach
        @endforeach
      </h5>
      @endif
    </div>
    <div class="col-xs-12">
      <div class="row" style="background:#fff">
        @if ($settingComision->tipocomision == 'categoria')
          @foreach ($settingComision->valordetallado as $primerarreglo)
            <h5 class="col-xs-12">Información de la Categoria - {{$primerarreglo->nombre}}</h5>
            @foreach ($primerarreglo->comisiones as $item)
                <div class="col-xs-12 col-sm-4">
                  <label for="">Comision Rango: {{$item->nombre}}</label>
                  @if ($settingComision->tipopago == 'porcentaje')
                  <input type="text" class="form-control" readonly value="{{($item->comision * 100)}} %">
                  @else
                  <input type="text" class="form-control" readonly value="{{$item->comision}} $">
                  @endif    
                </div>
            @endforeach
          @endforeach
        @elseif($settingComision->tipocomision == 'producto')
          @foreach ($settingComision->valordetallado as $primerarreglo)
            <h5 class="col-xs-12">Información del Producto - {{$primerarreglo->idproductos}}</h5>
            @foreach ($primerarreglo->comisiones as $item)
                <div class="col-xs-12 col-sm-4">
                  <label for="">Comision Nivel: {{$item->nivel}}</label>
                  @if ($settingComision->tipopago == 'porcentaje')
                  <input type="text" class="form-control" readonly value="{{($item->comision * 100)}} %">
                  @else
                  <input type="text" class="form-control" readonly value="{{$item->comision}} $">
                  @endif    
                </div>
            @endforeach
          @endforeach
        @endif
      </div>
    </div>
    @endempty
  </div>
</div>
<!-- Formulario -->
<div class="panel panel-default mostrar" style="display:none;">

  <div class="panel-heading pla">
    <legend>
      <h3 class="panel-title">Configuración de las comisiones del Sistema </h3>
      <button class="btn green btn-block mostrar hh" onclick="toggle()">Editar</button>

    </legend>
  </div>
  <div class="panel-body">
    <form class="" action="{{route('setting-save-comision')}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{(!empty($settingComision)) ? $settingComision->id : ''}}">
      <div class="form-group col-sm-6 col-xs-12 ptr">
        <label for="">Cantidad de niveles ó categorias de Comisión</label>
        <input type="number" class="form-control" name="niveles" id="niveles" required onkeyup="comisiondetalle()">
      </div>
      <div class="form-group col-sm-6 col-xs-12 ptr">
        <label for="">Tipo de Comisión</label>
        <select class="form-control" name="tipocomision" id="tipocomision" required onchange="comisiondetalle()">
          <option value="" selected disabled>Seleccione una Opción</option>
          <option value="general">General (Valor general para todos los niveles)</option>
          <option value="detallado">Detallado (Valor detallado para todos los niveles)</option>
          <option value="categoria">Categoria (La comisión sera en base a los rangos)</option>
          <option value="producto">Produtos (La comision sera en base de los productos a cada nivel)</option>
        </select>
      </div>
      <div class="form-group col-sm-6 col-xs-12 ptr" id="valor">

      </div>
      <div class="form-group col-sm-6 col-xs-12 ptr">
        <label for="">Tipo de pago de comision</label>
        <select class="form-control" name="tipopago" required>
          <option value="" selected disabled>Seleccione una Opción</option>
          <option value="normal">Valor Fijo</option>
          <option value="porcentaje">Valor Por Porcentaje</option>
        </select>
      </div>
      <div class="row form-group col-xs-12 ptr" style="background:#fff" id="valor2">

        </div>
      <div class="form-group col-sm-12 ji">
        <div class="form-group col-sm-6">
          <button class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
        </div>
        <div class="form-group col-sm-6">
          <button type="submit" class="btn green btn-block"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


{{-- modal de bono por activacion --}}
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Bono por Activación y Comision Primera Compra</h4>
      </div>
      <div class="modal-body">
        {{-- Bono Activacion --}}
        <form class="" action="{{route ('setting-save-bono')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Bono</label>
            <input type="number" name="bono" value="{{ old('bono') }}" min="0" class="form-control">
          </div>
          <div class="form-group">
            <label for="">¿De quien recibir este bono?</label>
            <select name="recibir" class="form-control">
              <option value="" disabled selected>Selecione una Opcion</option>
              <option value="1">Los Directos</option>
              <option value="0">Todos los Usuarios de en red</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
          </div>
        </form>
        {{-- Primera Compra --}}
        <form class="" action="{{route ('setting-save-primara-compra')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Aceptar Comision en Primera Compra</label>
            <select name="primera_compra" class="form-control">
              <option value="" disabled selected>Selecione una Opcion</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

{{-- modal de id de productos --}}
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Productos que no generan comision</h4>
      </div>
      <div class="modal-body">
        {{-- agregar id --}}
        <form class="" action="{{route ('setting-save-producto')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Agregar ID Producto</label>
            <input type="number" name="idproducto" value="{{ old('idproducto') }}" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
          </div>
        </form>
        {{-- eliminar id --}}
        <form class="" action="{{route ('setting-delete-producto')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Eliminar Id de Producto</label>
            @php
                $array = explode(', ', $settings->id_no_comision);
            @endphp
            <select name="idproducto_elimanar" class="form-control">
              <option disabled selected>Seleccione una Opcion</option>
              @foreach ($array as $item)
                <option value="{{trim($item)}}">{{trim($item)}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger btn-block">Borrar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var rangos = null
  var productos = null
  $(document).ready(function(){
      $.get('getrangosall', function(response){
        rangos = JSON.parse(response)
      })
      $.get('getproductosall', function(response){
        productos = JSON.parse(response)
      })
  })
  function toggle() {
    $('.mostrar').toggle('slow')
  }

  function comisiondetalle() {
    $('#valor').empty()
    $('#valor2').empty()
    let tipoComision = $('#tipocomision').val()
    let niveles = $('#niveles').val()
    if (tipoComision == 'general') {
      $('#valor').append(
        '<label for="">Valor de Comision</label>' +
        '<input type="number" step="any" class="form-control" name="valorgeneral">'
      )
    } else if (tipoComision == 'detallado') {
      for (var i = 0; i < niveles; i++) {
        $('#valor').append(
          '<label for="">Valor de Comision Nivel ' + (i + 1) + '</label>' +
          '<input type="number" step="any" class="form-control" name="nivel' + (i + 1) + '">'
        )
      }
    } else if (tipoComision == 'categoria'){
      if (rangos.length < 2) {
        $('#valor2').append(
          '<div class="alert alert-warning" role="alert">'+
            '<h4> <b>Aviso:</b> Para usar este modo, primero debes tener la configuración de rango lista</h4>'+
          '</div>'
        )
      } else {
        let comision = ''
        for (let i = 0; i < niveles; i++) {
          
          rangos.forEach(item => {
          comision = comision + '<div class="form-group col-xs-12 col-sm-6 col-lg-4">'+
            '<label for="">Comision para el rango: '+item.name+'</label>'+
            '<input type="number" class="form-control" step="any" required min="0" name="idrango'+item.id+'_'+(i + 1)+'">'+
          '</div>'
          });
          $('#valor2').append(
            '<h4 class="col-xs-12"> Configuracion de la Categoria '+(i + 1)+' </h4>'+
            '<div class="form-group col-xs-12 col-sm-6 col-lg-4">'+
            '<label for="">Nombre de la Categoria '+(i + 1)+'</label>'+
            '<input type="text" class="form-control" required name="categoria'+(i + 1)+'">'+
          '</div>'+comision
        )
        comision =  ''
        }
         
      }
    }else if (tipoComision == 'producto'){
      if (productos.length <= 0) {
        $('#valor2').append(
          '<div class="alert alert-warning" role="alert">'+
            '<h4> <b>Aviso:</b> Para usar este modo, primero debes tener productos registrado</h4>'+
          '</div>'
        )
      }else{
        let comision = ''
        productos.forEach(item => {
          for (var i = 0; i < niveles; i++) {
            comision = comision + '<div class="form-group col-xs-12 col-sm-6 col-lg-4">'+
            '<label for="">Comision para el nivel: '+(i + 1)+'</label>'+
            '<input type="number" class="form-control" step="any" required min="0" name="idproducto'+item.ID+'_'+(i + 1)+'">'+
          '</div>'
          }
          $('#valor2').append(
            '<div class="alert alert-info" role="alert">'+
              '<h4> <b>Nota:</b> Si el valor en un nivel es 0, ese nivel no se cobrara</h4>'+
            '</div>'+
            '<h4 class="col-xs-12"> Configuracion del Producto - ID: '+item.ID+' </h4>'+
            comision
          )
        comision = ''
        })
      }
    }
  }
</script>

@endsection