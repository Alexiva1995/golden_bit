@php
$faqs = [
[
'title' => '¿Es Level Up una empresa?',
'description' => 'No, Level Up es una comunidad de líderes y emprendedores, que han decidido unirse para apalancarse de la oferta de productos de varias compañías, aprovechar las ventajas que ofrece la nueva economía digital y llevas sus vidas y sus ingresos a un siguiente nivel.'
],
[
'title' => '¿Qué tipo de relación tienen las empresas aliadas con Level - UP?',
'description' => 'La relación de cada una de las compañías pertenecientes al portafolio ofrecido en Level Up y Level Up es netamente comercial, esto significa que dichas compañías realizan sus actividades económicas independientes a Level Up y han llegado a acuerdos comerciales con Level Up para publicitar sus productos dentro de la comunidad.'
],
[
'title' => '¿Cómo funciona el fondo de utilidades?',
'description' => 'El fondo de utilidades consiste básicamente en una rentabilidad mensual que los usuarios recibirán por el hecho de adquirí un plan Plus Level o un plan Pro Level. <br>
La persona que adquiera el Plus Level recibirá un rendimiento mensual del 4,5% sobre el 60% del valor del pagado por el paquete. <br>
La persona que adquiera el Pro Level recibirá un rendimiento mensual del 5 % sobre el 65% del valor del pagado por el paquete.'
],
[
'title' => '¿Por cuánto tiempo recibo las ganancias del fondo de utilidades?',
'description' => 'Recibirás este beneficio hasta que las utilidades producto del mismo sean equivalente al valor pagado por el paquete que adquiriste.'
],
[
'title' => '¿Qué es y cómo funciona el Trading CashBack?',
'description' => 'El Trading CashBack es un bono adicional que se ofrece a todas aquellas personas que abran una cuenta de Forex siguiendo el siguiente Link de referido (Adjuntar Link De IB), consiste esencialmente en pagar USD 1 por cada lote estándar operado en su cuenta personal de trading.'
],
[
'title' => '¿Por qué Level-UP paga comisiones por venta?',
'description' => 'El pago de las comisiones que Level Up presenta se debe a la realización de una estrategia comercial acordada con cada una de las compañías aliadas, con la firme intención de mejorar los ingresos de las personas que conforman la comunidad.'
],
[
'title' => '¿Es Level Up un multinivel?',
'description' => 'No, Level Up es una comunidad de líderes y emprendedores que buscan aprovechar las oportunidades que ofrece la nueva economía digital, contamos con una plataforma de pagos con la firme intención de llevar control sobre cada una de las ventas y comisiones generadas por cada usuario.'
],
[
'title' => ' ¿Por qué las herramientas de trading de My Academy tienen tiempo limitado? ',
'description' => 'Porque My Academy independientemente de Level Up cobra por este servicio, sin embargo, el acuerdo comercial con My Academy consiste esencialmente en aumentar el tiempo durante el cual las personas puedan usar sus herramientas.'
],
[
'title' => '¿Son seguros los Robots de trading de U-Bot?',
'description' => 'En Level Up se ha analizado varias propuestas respecto a trading algorítmico y se concluye que la de U-Bot es sin lugar a dudas la más óptima y la de mejor rendimiento teniendo en cuenta la relación riesgo-beneficio, sin embargo, es importante recordar que los resultados pasados no garantizan rendimientos futuros, debido a que este es un negocio de rentabilidad variable.'
],
[
'title' => '¿Qué tan efectivas son las señales de Win Signal FX?',
'description' => 'Las señales de Win Signal FX son lo suficientemente efectivas como para obtener ganancias consistentemente en el mediano y largo plazo producto de operar el mercado Forex y el mercado de Binarias, esto debido a la rigurosa gestión de riesgo que se aplica en la operativa, sin embargo, es importante recordar que los resultados pasados no garantizan rendimientos futuros, debido a que este es un negocio de rentabilidad variable.'
],
[
'title' => '¿Level-Up es responsable de la calidad de los productos? ',
'description' => 'Level Up ha analizado rigurosamente la industria, seleccionando de ella los mejores productos que hay en el mercado, con la firme intención de crear un portafolio de productos amplio y de alta calidad, sin embargo, no Level Up no es responsable de prestar ningún servicio, por lo que cualquier queja, reclamo o inquietud debe hacerse directamente a la empresa que le está prestando el servicio.'
],
[
'title' => '¿Cómo puedo hacerme miembro de la gran comunidad Level Up y disfrutar de las ganancias?',
'description' => 'La forma más fácil de pertenecer a Level Up es contactarte con la persona que te presento el negocio o te facilito la información respecto al proyecto, en caso tal de que no conozcas a nadie que forme parte de Level Up y quieras hacer parte de la comunidad escríbenos a nuestras redes sociales y con gusto atenderemos tu solicitud.'
],
];
@endphp

<div class="row pt-4 pb-4">
    <div class="accordion col-12" id="accordionExample">
        @foreach ($faqs as $i => $value)
        <div class="card mb-3 accordion-alt">
            <div class="card-header" id="heading{{$i}}">
                {{-- <h2 class="mb-0 "> --}}
                <button class="btn boxshadow col-12 text-alt-gray btn-active efeboot {{($i != 0) ? 'collapsed' : ''}}"
                    type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true"
                    aria-controls="collapse{{$i}}">
                    <strong>{{$value['title']}}</strong>
                    <h4 class="active">
                            <strong>
                                <svg class="bi bi-plus" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H6a.5.5 0 010-1h3.5V6a.5.5 0 01.5-.5z"
                                        clip-rule="evenodd"></path>
                                    <path fill-rule="evenodd"
                                        d="M9.5 10a.5.5 0 01.5-.5h4a.5.5 0 010 1h-3.5V14a.5.5 0 01-1 0v-4z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </strong>
                    </h4>

                    <h4 class="inactive">
                            <strong>
                                <svg class="bi bi-dash" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.5 10a.5.5 0 01.5-.5h8a.5.5 0 010 1H6a.5.5 0 01-.5-.5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </strong>
                    </h4>
                </button>
                {{-- </h2> --}}
            </div>

            <div id="collapse{{$i}}" class="collapse {{($i == 0) ? 'show' : ''}}" aria-labelledby="heading{{$i}}"
                data-parent="#accordionExample">
                <div class="card-body text-alt-gray">
                    <small>
                        {!!$value['description']!!}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>