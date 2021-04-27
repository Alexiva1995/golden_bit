{{-- <div class="col-12 text-right">
    <button type="button" class="btn btn-secondary mt-2 mb-2" onclick="activarPago();">Edit</button>
</div> --}}

<form action="{{ action($controler, ['data' => 'pago']) }}" method="post"

    enctype="multipart/form-data">

    {{ method_field('PUT') }}

    {{ csrf_field() }}



    <input name="id" type="hidden" value="{{$data['segundo']->ID}}">



    <div class="form-group" style="margin-bottom: 15px;">

        <label>Wallet (ETH)</label>



        <input name="paypal" id="paypal" type="text" placeholder="{{$data['segundo']->paypal}}" class="form-control pago"

            value="{{(!empty($data['segundo']->paypal)) ? $data['segundo']->paypal : old('paypal')}}" required>

    </div>



    {{-- <div class="form-group" style="margin-bottom: 15px;">

        <label>Dirección de Blocktrail</label>



        <input name="blocktrail" id="blocktrail" type="text" placeholder="{{$data['segundo']->blocktrail}}"

            class="form-control pago" value="{{$data['segundo']->blocktrail}}" required disabled>

    </div> --}}



    {{-- <div class="form-group" style="margin-bottom: 15px;">

        <label>Dirección de blockchain</label>



        <input name="blockchain" id="blockchain" type="text" placeholder="{{$data['segundo']->blockchain}}"

            class="form-control pago" value="{{$data['segundo']->blockchain}}" required disabled>

    </div> --}}



    {{-- <div class="form-group" style="margin-bottom: 15px;">

        <label>Bitgo Address</label>



        <input name="bitgo" id="Bitgo" type="text" placeholder="{{$data['segundo']->bitgo}}" class="form-control pago"

            value="{{$data['segundo']->bitgo}}" required disabled>

    </div>



    <div class="new_line"></div> --}}



    {{-- <h3>Metodo De Pago</h3>

    <hr>



    <div class="form-group" style="margin-bottom: 15px;">



        <select class="form-control pago form-control pago-solid placeholder-no-fix form-group" name="pago" id="metodo"

            value="{{$data['segundo']->pago}}" required disabled>

            <option value="Banco" @if($data['segundo']->pago == 'Banco' ) selected @endif>Banco</option>

            <option value="Paypal" @if($data['segundo']->pago == 'Paypal' ) selected @endif>Paypal

            </option>

            <option value="Blocktrail" @if($data['segundo']->pago == 'Blocktrail' ) selected

                @endif>Blocktrail

            </option>

            <option value="Blockchain" @if($data['segundo']->pago == 'Blockchain' ) selected

                @endif>Blockchain

            </option>

            <option value="Bitgo" @if($data['segundo']->pago == 'Bitgo' ) selected @endif>Bitgo</option>

        </select>

    </div> --}}



    <div class="col-12" id="botom4">
        {{-- <button type="button" class="btn btn-danger" onclick="cancelarPago();">Cancel</button> --}}

        <button type="submit" class="btn btn-success">Send</button>

    </div>



</form>