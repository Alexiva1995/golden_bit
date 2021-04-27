<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .header {
        background: black;
        color: #ffb102;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    .header div:first-child {
        width: 70%;
        text-align: left;
    }

    .header div:last-child {
        width: 30%;
        text-align: center;
    }

    .body {
        text-align: center;
    }

    .body h3 {
        margin: 0 0 90px;
    }

    .body .title {
        color: #ffb102;
    }

    .body .disenbtn {
        display: flex;
        justify-content: center;
    }

    .body .disenbtn a {
        text-decoration: none;
    }

    .body .disenbtn h3 {
        border: 2px solid #ffb102;
        border-right-color: rgb(255, 177, 2);
        border-right-style: solid;
        border-right-width: 2px;
        border-left-color: rgb(255, 177, 2);
        border-left-style: solid;
        border-left-width: 2px;
        border-left: 0px;
        border-right: 0px;
        padding: 20px 0px;
        font-size: 2em;
    }
    .body .msj{
        margin: 60px 0px 0px;
        text-align: left;
    }
    .footer{
        background: black;
        color: white;
        padding: 0px 20px;
    }
</style>

<body>
    <div class="header">
        <div>
            <img src="{{asset('assets/img/logo-light.png')}}" height="80" alt="">
        </div>
        <div>
            <b>
                <span>Contenido del producto</span>
            </b>
        </div>
    </div>
    <div class="body">
        <h2 class="title">Bienvenido Ecripto FX</h2>
        <h3>Gracias por la compra de su producto</h3>

        <div class="disenbtn">
            <div>
                <h6>
                    <span>Presione el siguente link para ver el contido ofrecido por este producto</span>
                </h6>
                @empty(!$ruta)
                @php
                    $ruta = json_decode($ruta);
                @endphp
                @foreach ($ruta as $item => $value)
                <a href="{{ asset('products/'.$value)}}">
                    <h3>
                        Ver Contenido
                    </h3>
                </a>
                <br>
                <a href="{{ asset('products/'.$value)}}" download="">
                    <h3>
                        Descargar Contenido
                    </h3>
                </a>
                @endforeach
                
                @endempty
            </div>
        </div>
        {{-- <div class="msj">
            <h5>
                If you received this email but did not register with ecripto it means that someone registered using this email address. If you did not register, simply ignore this email.
            </h5>
        </div> --}}
    </div>
    <div class="footer">
        Ecripto FX &copy; 2019 - 2020
    </div>
</body>

</html>