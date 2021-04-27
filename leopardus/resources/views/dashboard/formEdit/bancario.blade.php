<div class="col-md-12">

    <button type="button" class="btn green padding_both_small" onclick="activarBanco();"
        style="margin-top:5px; float: right !important;">Edit</button>

</div>

<form action="{{ action($controler, ['data' => 'avatar_arbol']) }}" method="post">

    {{ method_field('PUT') }}

    {{ csrf_field() }}



    <input name="id" type="hidden" value="{{$data['segundo']->ID}}">

    {{-- 

    <div class="form-group" style="margin-bottom: 15px;">

        <label>Nombre del Banco</label>



        <input name="banco" type="text" placeholder="{{$data['segundo']->banco}}" class="form-control banco"
    value="{{$data['segundo']->banco}}" required disabled>

    </div>



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Branch Name</label>



        <input name="Branch" type="text" placeholder="{{$data['segundo']->Branch}}" class="form-control banco"
            value="{{$data['segundo']->Branch}}" required disabled>

    </div>



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Titular de la cuenta</label>



        <input name="titular" type="text" placeholder="{{$data['segundo']->titular}}" class="form-control banco"
            value="{{$data['segundo']->titular}}" required disabled>

    </div>



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Número de cuenta</label>



        <input name="cuenta" type="number" step="any" placeholder="{{$data['segundo']->cuenta}}"
            class="form-control banco" value="{{$data['segundo']->cuenta}}" required disabled>

    </div>



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Código IFSC</label>



        <input name="ifsc" type="text" placeholder="{{$data['segundo']->ifsc}}" class="form-control banco"
            value="{{$data['segundo']->ifsc}}" required disabled>

    </div>



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Numero PAN</label>



        <input name="pan" type="number" step="any" placeholder="{{$data['segundo']->pan}}" class="form-control banco"
            value="{{$data['segundo']->pan}}" required disabled>

    </div> --}}

    @php
    $arregloAvatares = [
    'M' => [
    'N' => [
    'avatares\Men\N\1.png',
    'avatares\Men\N\2.png',
    'avatares\Men\N\3.png',
    'avatares\Men\N\4.png',
    'avatares\Men\N\5.png',
    ],
    'NC' => [
    'avatares\Men\NC\1.png',
    'avatares\Men\NC\2.png',
    'avatares\Men\NC\3.png',
    'avatares\Men\NC\4.png',
    'avatares\Men\NC\5.png',
    ],
    'R' => [
    'avatares\Men\R\1.png',
    'avatares\Men\R\2.png',
    'avatares\Men\R\3.png',
    'avatares\Men\R\4.png',
    'avatares\Men\R\5.png',
    ],
    'RC' => [
    'avatares\Men\RC\1.png',
    'avatares\Men\RC\2.png',
    'avatares\Men\RC\3.png',
    'avatares\Men\RC\4.png',
    'avatares\Men\RC\5.png',
    ],
    ],
    'F' => [
    'N' => [
    'avatares\Woman\N\1.png',
    'avatares\Woman\N\2.png',
    'avatares\Woman\N\3.png',
    'avatares\Woman\N\4.png',
    'avatares\Woman\N\5.png',
    ],
    'NC' => [
    'avatares\Woman\NC\1.png',
    'avatares\Woman\NC\2.png',
    'avatares\Woman\NC\3.png',
    'avatares\Woman\NC\4.png',
    'avatares\Woman\NC\5.png',
    ],
    'R' => [
    'avatares\Woman\R\1.png',
    'avatares\Woman\R\2.png',
    'avatares\Woman\R\3.png',
    'avatares\Woman\R\4.png',
    'avatares\Woman\R\5.png',
    ],
    'RC' => [
    'avatares\Woman\RC\1.png',
    'avatares\Woman\RC\2.png',
    'avatares\Woman\RC\3.png',
    'avatares\Woman\RC\4.png',
    'avatares\Woman\RC\5.png',
    ],
    ]
    ]
    @endphp

    <div class="form-group">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                @foreach ($arregloAvatares[$data['segundo']->genero]['N'] as $index => $avatares)
                <label for="N{{$index}}">
                    <input type="radio" value="{{$avatares}}" name="icon_activo" id="N{{$index}}"
                        {{($data['principal']->icono_activo == $avatares) ? 'checked' : ''}}>
                    <img src="{{asset('assets/img/'.$avatares)}}" alt="" height="60">
                </label>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                @foreach ($arregloAvatares[$data['segundo']->genero]['R'] as $index => $avatares)
                <label for="R{{$index}}">
                    <input type="radio" value="{{$avatares}}" name="icon_activo" id="R{{$index}}"
                        {{($data['principal']->icono_activo == $avatares) ? 'checked' : ''}}>
                    <img src="{{asset('assets/img/'.$avatares)}}" alt="" height="60">
                </label>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                @foreach ($arregloAvatares[$data['segundo']->genero]['NC'] as $index => $avatares)
                <label for="NC{{$index}}">
                    <input type="radio" value="{{$avatares}}" name="icon_inactivo" id="NC{{$index}}"
                        {{($data['principal']->icono_inactivo == $avatares) ? 'checked' : ''}}>
                    <img src="{{asset('assets/img/'.$avatares)}}" alt="" height="60">
                </label>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                @foreach ($arregloAvatares[$data['segundo']->genero]['RC'] as $index => $avatares)
                <label for="RC{{$index}}">
                    <input type="radio" value="{{$avatares}}" name="icon_inactivo" id="RC{{$index}}"
                        {{($data['principal']->icono_inactivo == $avatares) ? 'checked' : ''}}>
                    <img src="{{asset('assets/img/'.$avatares)}}" alt="" height="60">
                </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-12" id="botom3" style="display: none;">

        <button type="button" class="btn btn-danger" onclick="cancelarBanco();"
            style="margin-top:5px; float: left !important; font-size: 12px;">Cancel</button>

        <button type="submit" class="btn green padding_both_small"
            style="margin-top:5px; margin-left:10px;">Send</button>

    </div>



</form>