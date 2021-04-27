@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

<div class="col-xs-12">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Nueva Publicidad
    </button>
</div>

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Product ID
                            </th>
                            <th class="text-center">
                                Imagen
                            </th>
                            <th class="text-center">
                                Nombre
                            </th>
                            <th class="text-center">
                                Descripcion
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publicidades as $publicidad)
                        <tr>
                            <td class="text-center">
                                {{$publicidad->id}}
                            </td>
                            <td class="text-center">
                                <img src="{{$publicidad->img}}" height="50">
                            </td>
                            <td class="text-center">
                                {{$publicidad->titulo}}
                            </td>
                            <td class="text-center">
                                {{$publicidad->descripcion}}
                            </td>
                            <td>
                                <a class="btn btn-info" onclick="editProduct({{json_encode($publicidad)}})"> Editar</a>
                                <a class="btn btn-danger" href="{{route('delete.publicidad', [$publicidad->id])}}"> Borrar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nueva Publicidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('save.publicidad')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Titulo</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Imagen Publicitaria</label>
                        <input type="file" name="imagen" class="form-control" required accept="image/jpeg, image/png" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- modal Editar --}}
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Publicidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('edit.publicidad')}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="idproduct" id="product">
                    <div class="form-group">
                        <label for="">Titulo</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Imagen Publicitaria</label>
                        <input type="file" name="imagen" class="form-control" accept="image/jpeg, image/png">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function editProduct(dataProduct) {
        $('#content').val(dataProduct.descripcion)
        $('#name').val(dataProduct.titulo)
        $('#product').val(dataProduct.id)
        $('#myModalEdit').modal('show')
    }
</script>