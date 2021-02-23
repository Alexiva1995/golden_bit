@extends('layouts.dashboard')

@section('content')
<div class="contai2">
    <div class="card">
        <div class="card-body text-center">
            <h4 class="mt-2">Presentacion Blackbox</h4>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/pQhbrOu8njw" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <h5 class="mt-2 mb-2">Materiales de Apoyo</h5>
            <div>
                <h6>
                    <a href="{{asset('assets/pdf/BLACKBOX_TIGERWIT_PASO_A_PASO.pdf')}}" download="">
                        BLACKBOX TIGERWIT PASO A PASO
                    </a>
                </h6>
                <h6>
                    <a href="{{asset('assets/pdf/GUIA_COMPLETA_DE_ATENCIÓN_AL_CLIENTE_BLACKBOX.pdf')}}" download="">
                        GUIA COMPLETA DE ATENCIÓN AL CLIENTE BLACKBOX
                    </a>
                </h6>
                <h6>
                    <a href="{{asset('assets/pdf/PDF_BRAINBOW.pdf')}}" download="">
                        BRAINBOW
                    </a>
                </h6>
            </div>
        </div>
    </div>
</div>
@endsection