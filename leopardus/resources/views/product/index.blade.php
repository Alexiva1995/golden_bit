@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

<div class="col-xs-12">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Nuevo Producto
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
                                Descripción
                            </th>
                            <th class="text-center">
                                Duración
                            </th>
                            <th class="text-center">
                                Rentabilidad
                            </th>
                            <th class="text-center">
                                Penalización
                            </th>
                            <th class="text-center">
                                Precio
                            </th>
                            <th class="text-center">
                                Visible en la tienda
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="text-center">
                                {{$product->ID}}
                            </td>
                            <td class="text-center">
                                <img src="{{$product->imagen}}" height="50">
                            </td>
                            <td class="text-center">
                                {{$product->post_title}}
                            </td>
                            <td class="text-center">
                                {{$product->post_content}}
                            </td>
                            <td class="text-center">
                                {{$product->duration}}
                            </td>
                            <td class="text-center">
                                {{(!empty($product->rentabilidad)) ?  $product->rentabilidad : 0}}
                            </td>
                            <td class="text-center">
                                {{$product->penalizacion}}
                            </td>
                            <td class="text-center">
                                $ {{$product->meta_value}}
                            </td>
                            <td class="text-center">
                                {{$product->visible}}
                            </td>
                            <td>
                                <a class="btn btn-info" onclick="editProduct({{json_encode($product)}})"> Editar</a>
                                <a class="btn btn-danger" href="{{route('save.delete', [$product->ID])}}"> Borrar</a>
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
                <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('save.product')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nombre del Producto</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Duración</label>
                        <select class="form-control" name="duration" id="" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="6">6 Meses</option>
                            <option value="12">12 Meses</option>
                            <option value="18">18 Meses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje de Rentabilidad</label>
                        <input type="number" class="form-control" name="rentabilidad">
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje de Penalización</label>
                        <input type="number" class="form-control" name="penalizacion">
                    </div>
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="text" class="form-control" name="price">
                    </div>
                    <div class="form-group">
                        <label for="">Visible en la tienda</label>
                        <select class="form-control" name="visible" id="" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Visible">Visible</option>
                            <option value="No Visible">No Visible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Imagen Producto</label>
                        <input type="file" name="imagen" class="form-control" required accept="image/jpeg, image/png">
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
                <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('edit.product')}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="idproduct" id="product">
                    <div class="form-group">
                        <label for="">Nombre del Producto</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Duración</label>
                        <select class="form-control" name="duration" id="duration" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="6">6 Meses</option>
                            <option value="12">12 Meses</option>
                            <option value="18">18 Meses</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje de Rentabilidad</label>
                        <input type="number" class="form-control" name="rentabilidad" id="rentabilidad">
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje de Penalización</label>
                        <input type="number" class="form-control" name="penalizacion" id="penalizacion">
                    </div>
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="">Visible en la tienda</label>
                        <select class="form-control" name="visible" id="visible" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Visible">Visible</option>
                            <option value="No Visible">No Visible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Imagen Producto</label>
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
        $('#price').val(dataProduct.meta_value)
        $('#content').val(dataProduct.post_content)
        $('#name').val(dataProduct.post_title)
        $('#product').val(dataProduct.ID)
        $('#limite').val(dataProduct.duration)
        $('#rentabilidad').val(dataProduct.rentabilidad)
        $('#penalizacion').val(dataProduct.penalizacion)
        $('#visible').val(dataProduct.visible)
        $('#myModalEdit').modal('show')
        
    }
</script>