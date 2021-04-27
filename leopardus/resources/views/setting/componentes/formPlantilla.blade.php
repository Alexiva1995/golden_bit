
<div class="panel panel-default mostrar" style="display:none;">
    <div class="panel-heading pla">
        <h3 class="panel-title">Configuración de la Plantilla de Correo Bienvenida</h3>
    </div>
    <div class="panel-body">
        <form class="" action="{{route('setting-save-plantilla')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="plantilla" value="bienvenida">
            <input type="hidden" name="idplantilla" value="{{(!empty($plantillaB->id)) ? $plantillaB->id : '' }}">
            <div class="form-group">
                <label for="">Titulo del Correo</label>
                <input type="text" name="titulo" class="form-control" value="{{(!empty($plantillaB->titulo)) ? $plantillaB->titulo : '' }}">
            </div>
            <div class="form-group">
                <label for="">Contenido del Correo</label>
                <textarea name="correo" class="summernote" cols="30" rows="10">{{(!empty($plantillaB->contenido)) ? $plantillaB->contenido : '' }}</textarea>
                <p class="help-block">Las Variables de abajo son dinamica, al colocar esas variables se colocara la informacion perteneciente a los usuarios</p>
            </div>
            <div class="form-group">
                <label for="">Variables que pueden usar</label>
                <span class="var">@nombrecompleto</span>
                <span class="var">@usuario</span>
                <span class="var">@idpatrocinio</span>
                <span class="var">@clave</span>
                <span class="var">@correo</span>
            </div>
            <div class="form-group col-sm-12 ji">
                <div class="form-group col-sm-6">
                    <button type="button" class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
                </div>
                <div class="form-group col-sm-6">
                    <button type="submit" class="btn green btn-block"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default mostrar" style="display:none;">
    <div class="panel-heading pla">
        <h3 class="panel-title">Configuración de la Plantilla de Correo Pago</h3>
    </div>
    <div class="panel-body">
        <form class="" action="{{route('setting-save-plantilla')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="plantilla" value="pago">
            <input type="hidden" name="idplantilla" value="{{(!empty($plantillaP->id)) ? $plantillaP->id : '' }}">
            <div class="form-group">
                <label for="">Titulo del Correo</label>
                <input type="text" name="titulo" class="form-control" value="{{(!empty($plantillaP->titulo)) ? $plantillaP->titulo : '' }}">
            </div>
            <div class="form-group">
                <label for="">Contenido del Correo</label>
                <textarea name="correo" class="summernote" cols="30" rows="10">{{(!empty($plantillaP->contenido)) ? $plantillaP->contenido : '' }}</textarea>
                <p class="help-block">Las Variables de abajo son dinamica, al colocar esas variables se colocara la informacion perteneciente a los usuarios</p>
            </div>
            <div class="form-group">
                <label for="">Variables que pueden usar</label>
                <span class="var">@nombrecompleto</span>
                <span class="var">@correo</span>
                <span class="var">@usuario</span>
                <span class="var">@idpatrocinio</span>
            </div>
            <div class="form-group col-sm-12 ji">
                <div class="form-group col-sm-6">
                    <button type="button" class="btn btn-danger btn-block mostrar" style="display:none;" onclick="toggle()">Cancelar</button>
                </div>
                <div class="form-group col-sm-6">
                    <button type="submit" class="btn green btn-block"> Guardar <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>