{{-- <div class="col-12 text-right">
    <button type="button" class="btn btn-secondary" onclick="activarSocial();">Edit</button>
</div> --}}
<form action="{{ action($controler, ['data' => 'social']) }}" method="post">
    {{ method_field('PUT') }}
    {{ csrf_field() }}


    <legend>Social</legend>
    <input name="id" type="hidden" value="{{$data['segundo']->ID}}">

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Facebook</label>

        <input name="facebook" type="text" placeholder="{{$data['segundo']->facebook}}" class="form-control social"
            value="{{$data['segundo']->facebook}}" required>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Twitter</label>

        <input name="twitter" type="text" placeholder="{{$data['segundo']->twitter}}" class="form-control social"
            value="{{$data['segundo']->twitter}}" required>
    </div>

    <div class="col-12" id="botom2">
        {{-- <button type="button" class="btn btn-danger" onclick="cancelarSocial();">Cancel</button> --}}
        <button type="submit" class="btn btn-success">Send</button>
    </div>

</form>