@extends('layouts.email')


@section('content')


<h4 class="card-title">
    <strong>RETIRO ÉXITOSO</strong>
</h4>

<small>
    <p class="card-text text-justify">
        Tu retiro de ${{$data['monto']}} a la billetera {{$data['billetera']}} se realizó con éxito <br>
        el día {{$data['fecha']}}
        a las {{$data['hora']}}
        <br>
    </p>
</small>

@endsection
{{-- @push('quote')
De seguro que serás nuestro próximo UPPER, <br>
asi pues que sigamos
@endpush --}}