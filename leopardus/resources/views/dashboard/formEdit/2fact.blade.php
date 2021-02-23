<div class="col-12">
    <div class="col-12">
        @if (Auth::user()->check_token_google == 1)
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span>
                Su usuario ya tiene activo la validacion por google
            </span>
        </div>
        @endif
    </div>
    <form action="{{ action($controler, ['data' => '2fact']) }}" method="post">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input name="id" type="hidden" value="{{$data['segundo']->ID}}">
        <div class="form-group">
            <div class="row">
                @if (Auth::user()->check_token_google == 0)
                <div class="col-xs-12 col-md-6 text-center">
                    <img src="{{$data['urlqr']}}" alt="">
                </div>
                @endif
                <div class="col-xs-12 col-md-6">
                    <label>Code Autenticador</label>
                    <input name="code" type="text" placeholder="2fact" class="form-control" value="" required>
                    <div class="col-md-12" id="botom">
                        {{-- <button type="button" class="btn btn-danger padding_both_small" onclick="cancelarPersonal();"
                                style="margin-top:5px; float: left !important; font-size: 12px;">Cancel</button> --}}
                        <button class="btn btn-info padding_both_small" style="margin-top:5px; margin-left:10px;">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>