<div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">

    <div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold uppercase">Instalardor del sistema</span>
            </div>
            <div class="actions">
            	<strong>PASO #2: Configuración básica</strong>
            </div>
            <!--<div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                    <i class="icon-cloud-upload"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                    <i class="icon-wrench"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                    <i class="icon-trash"></i>
                </a>
            </div>-->
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form method="POST" class="form-horizontal form-bordered ">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input name="step" type="hidden" value="{{ $step }}"/>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-4">Titulo</label>
                        <div class="col-md-8">
                            <input type="text" name="title" placeholder="Titulo del sitio web" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Url</label>
                        <div class="col-md-8">
                            <input type="text" name="url" value="{{ url('/') }}" placeholder="Url del sitio web" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Eslogan</label>
                        <div class="col-md-8">
                            <input type="text" name="slogan" placeholder="Slogan del sitio web" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Descripción</label>
                        <div class="col-md-8">
                            <textarea name="description" class="form-control" placeholder="Descripcion del sitio" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre</label>
                        <div class="col-md-8">
                            <input type="text" name="name" placeholder="Nombre completo del administrador" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Correo electronico</label>
                        <div class="col-md-8">
                            <input type="email" name="email" placeholder="Correo electronico del administrador" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Contraseña</label>
                        <div class="col-md-8">
                            <input type="password" name="pass" placeholder="Contraseña del usuario administrador" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> Continuar</button>
                        <a href="{{ url('/') }}" class="btn default">Cancelar</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>