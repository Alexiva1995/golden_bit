@extends('layouts.dashboard')

@section('content')

{{-- alertas --}}
@include('dashboard.componentView.alert')

{{-- style page --}}
@push('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/wizard.css')}}">
<style>
    #steps-uid-0 div.actions.clearfix ul li.disabled a {
    display: none;
}
    .app-content .wizard > .actions > ul > li > a {
    background: #02E9FE;
    font-weight: 600;
    border-radius: 4px !important;
    text-transform: uppercase;
    padding: 10px 20px;
    margin-top: 40px;
}
</style>
@endpush

{{-- script vendor --}}
@push('vendor_js')
<script src="{{asset('app-assets/vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endpush

<section class="row flexbox-container">
    <div class="col-12 d-flex justify-content-center">
        <section id="validation">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Proceso de Inversion</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('tienda.inversion')}}" class="steps-validation wizard-circle" method="POST">
                                    {{ csrf_field() }}
                                    {{-- paso 1 --}}
                                    @include('tienda.componentes.inversion')
                                    {{-- paso 1 fin --}}

                                    {{-- paso 2 --}}
                                    {{-- @include('tienda.componentes.planes') --}}
                                    {{-- paso 2 fin --}}

                                    {{-- paso 3 --}}
                                    {{-- @include('install.component.step3') --}}
                                    {{-- paso 3 fin --}}
                                    <input type="hidden" name="idproducto" id="idproducto" value="0000">
                                    <input type="hidden" id="title2" name="name" value="inversion">
                                    <input type="hidden" id="price2" name="precio" value="0">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>


{{-- modales --}}
{{-- @include('tienda.modalCompra') --}}
{{-- @include('tienda.modalCupon') --}}

@push('custom_js')
<script>
    var form = $(".steps-validation").show();
    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: 'Invertir',
            next: 'Siguiente',
            previous: 'Atras'
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            form.submit()
        }
    });

    // Initialize validation
    $(".steps-validation").validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'danger',
        successClass: 'success',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            email: {
                email: true
            }
        }
    });
</script>
@endpush

<script>
    function medidas() {
        let medida = $('#inversion').val();
        $('#medida').text(medida)
    }

    function detalles(product) {
        product = JSON.parse(product)
        let inversion = $('#inversion').val()
        $('.enable').attr('disabled', false)
        $('#product'+product.ID).attr('disabled', true)
        $('#idproducto').val(product.ID)
        $('#title2').val(product.post_title)
        $('#price2').val(product.meta_value)
    }

</script>

@endsection