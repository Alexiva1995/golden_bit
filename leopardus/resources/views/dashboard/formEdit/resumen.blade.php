{{-- <div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-2">
                    <div class="card">
                        <div class="card-content">
                            <img src="{{asset('/avatar/'.$data['principal']->avatar)}}" alt=""
                                class="card-img-top img-fluid" >
                                <div class="card-footer text-center">
                                    <button class="btn btn-primary" data-target="#myModal" data-toggle="modal">Cambiar</button>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Datos del Usuario
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-text">
                                    <span>Nombre de Usuario</span>
                                    <strong>{{$data['segundo']->nameuser}}</strong>
                                </div>
                                <div class="card-text">
                                    <span>Nombre Completo</span>
                                    <strong>{{$data['segundo']->firstname}} {{$data['segundo']->lastname}}</strong>
                                </div>
                                <div class="card-text">
                                    <span>Auspiciador</span>
                                    <strong>{{$data['referido']['display_name']}}</strong>
                                </div>
                                <div class="card-text">
                                    <span>Correo</span>
                                    <strong>{{$data['principal']->user_email}}</strong>
                                </div>
                                <div class="card-text">
                                    <span>Estado</span>
                                    <strong>
                                        @if($data['principal']->status == 1)
                                        Activo
                                        @elseif($data['principal']->status == 0)
                                        Inactivo
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal para la imagen -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Avatar</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>


            </div>

            <div class="modal-body">

                <div class="col-md-12 buq">

                    <form method="POST" action="{{ route('admin.user.actualizar', $data['principal']->ID) }}"
                        enctype="multipart/form-data">

                        {{ method_field('PUT') }}

                        {{ csrf_field() }}

                        <div class="form-group col-sm-12">

                            <label for="">Imagen del Usuario</label>

                            <input class="form-control form-control-solid placeholder-no-fix b-blue" type="file" name="avatar"
                                required style="background-color:f7f7f7;" accept="image/png, image/jpeg">

                        </div>

                        <div class="form-group col-sm-12 text-center" style="padding-left: 10px;">

                            <button class="btn btn-info" type="submit">Subir</button>

                        </div>

                    </form>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>

        </div>

    </div>

</div>