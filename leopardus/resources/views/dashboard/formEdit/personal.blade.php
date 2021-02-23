{{-- <div class="col-12 text-right">

    <button type="button" class="btn btn-secondary mt-2 mb-2" onclick="activarPersonal();">Edit</button>

</div> --}}

<div class="col-11">

    <div class="media">
        <a class="media-left align-self-center" href="#">
            <img src="{{asset('/avatar/'.$data['principal']->avatar)}}" alt="" height="64" width="64" style="border-radius: 50%;"/>
        </a>
        <div class="media-body ml-2">
            {{-- <h5 class="media-heading">Middle Aligned Media</h5> --}}
            <button class="btn input-group-text " data-target="#myModal" data-toggle="modal">Subir Fotos</button>
            <p class="mb-0">
                Se permiten JPG o PNG. Tamaño máximo de 800KB
            </p>
        </div>
    </div>

    <form action="{{ action($controler, ['data' => 'general']) }}" method="post" enctype="multipart/form-data">

        {{ method_field('PUT') }}

        {{ csrf_field() }}



        {{-- <legend>Personal</legend> --}}

        <input name="id" type="hidden" value="{{$data['segundo']->ID}}">



        <div class="form-group" style="margin-bottom: 15px;">

            <label>Nombre</label>



            <input name="firstname" type="text" placeholder="{{$data['segundo']->firstname}}"
                class="form-control personal b-blue"
                value="{{(!empty($data['segundo']->firstname)) ? $data['segundo']->firstname : old('firstname')}}"
                required>

        </div>



        <div class="form-group" style="margin-bottom: 15px;">

            <label>Apellido</label>



            <input name="lastname" type="text" placeholder="{{$data['segundo']->lastname}}"
                class="form-control personal b-blue"
                value="{{(!empty($data['segundo']->lastname)) ? $data['segundo']->lastname : old('lastname')}}"
                required>

        </div>



        <div class="form-group" style="margin-bottom: 15px;">

            <label>Nombre de Usuario</label>



            <input name="nameuser" type="text" placeholder="{{$data['segundo']->nameuser}}"
                class="form-control personal b-blue"
                value="{{(!empty($data['segundo']->nameuser)) ? $data['segundo']->nameuser : old('nameuser')}}"
                required>

        </div>



        <div class="form-group" style="margin-bottom: 15px;">

            <label>Genero</label>



            <select class="form-control personal b-blue form-control personal b-blue-solid placeholder-no-fix form-group"
                name="genero" value="{{$data['segundo']->genero}}" required>

                <option value="M" id="M" @if($data['segundo']->genero == 'M' ) selected @endif>Male</option>

                <option value="F" id="F" @if($data['segundo']->genero == 'F' ) selected @endif>Female</option>

            </select>

        </div>



        <div class="form-group" style="margin-bottom: 15px;">

            <label>Fecha de Nacimiento</label>

            <input name="edad" type="date" placeholder="Edad" class="form-control personal b-blue"
                value="{{(!empty($data['segundo']->edad)) ? $data['segundo']->edad : old('edad')}}" required>

        </div>



        @if (Auth::user()->rol_id == 0)

        <div class="form-group" style="margin-bottom: 15px;">

            <label>ID del Auspiciador</label>

            <input name="id_referred" type="number" placeholder="patrocinador" class="form-control personal b-blue"
                value="{{$data['principal']->referred_id}}" required>

        </div>

        <div class="form-group" style="margin-bottom: 15px;">

            <label>ID de la Posicion</label>

            <input name="id_position" type="number" placeholder="posicionamiento" class="form-control personal b-blue"
                value="{{$data['principal']->position_id}}" required>

        </div>

        @endif



        <div class="col-12 text-right" id="botom">

            {{-- <button type="button" class="btn btn-danger" onclick="cancelarPersonal();">Cancel</button> --}}

            <button class="btn btn-info">Guardar Cambios</button>

        </div>



    </form>

    {{-- @if (Auth::user()->ID == $data['principal']->ID)

<form action="{{ action($controler, ['data' => 'password']) }}" method="post" class="mt-3">

    {{ method_field('PUT') }}

    {{ csrf_field() }}

    <legend>Cambio de clave</legend>

    <input name="id" type="hidden" value="{{$data['segundo']->ID}}">

    <div class="form-group botom1" style="margin-bottom: 15px;">

        <label for="">Clave</label>

        <input name="clave" type="password" placeholder="***********" class="form-control contacto">

        <div>

            <label for="">Confirmar Clave</label>

            <input name="clave_confirmation" type="password" placeholder="***********" class="form-control contacto">

        </div>

    </div>

    <div class="form-group" style="margin-bottom: 15px;">

        <label>Code 2 factor</label>

        <input name="code" type="code" class="form-control" required>

    </div>

    <div class="col-12 botom1">


        <button type="submit" class="btn btn-success ml-2">Enviar</button>

    </div>

    </form>

    @endif --}}

</div>