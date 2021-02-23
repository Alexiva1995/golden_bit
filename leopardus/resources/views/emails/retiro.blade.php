@extends('layouts.email')


@section('content')


<h4 class="card-title">
    <strong>RETIRO ÉXITOSO</strong>
</h4>

<small>
    <p class="card-text text-justify">
        Tu retiro de ${{$data['monto']}} ETH se realizó con éxito <br>
        el día {{$data['fecha']}}
        a las {{$data['hora']}}
        <br> <br>
        Gracias por pertenecer a la Familia Level UP
    </p>
</small>

@endsection
@push('quote')
De seguro que serás nuestro próximo UPPER, <br>
asi pues que sigamos
@endpush