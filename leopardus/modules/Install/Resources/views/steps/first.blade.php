<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold uppercase">Instalardor del sistema</span>
            </div>
            <div class="actions">
            	<strong>PASO #1: Configuración del entorno</strong>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="form-horizontal form-bordered ">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input name="step" type="hidden" value="{{ $step }}"/>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-4">Servidor</label>
                        <div class="col-md-8">
                            <input type="text" name="host" placeholder="Host" class="form-control" value="localhost" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Usuario</label>
                        <div class="col-md-8">
                            <input type="text" name="user" placeholder="Usuario del servidor" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Contraseña</label>
                        <div class="col-md-8">
                            <input type="password" name="pass" placeholder="Contraseña del servidor" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Puerto</label>
                        <div class="col-md-8">
                            <input type="text" nme="port" placeholder="Puerto" class="form-control" value="3306" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Base de datos</label>
                        <div class="col-md-8">
                            <input type="text" name="bd" placeholder="Nombre de la base de datos" class="form-control" required>
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