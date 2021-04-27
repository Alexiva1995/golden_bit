<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{  $settings->name }} - {{ $settings->slogan }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/admin_panel.css') }}">
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"  rel="stylesheet"/>
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"  rel="stylesheet"/>
        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Raleway', sans-serif;
            }
            
            .full-height {
                height: 100vh;
                background-color: #fff;
                color: #636b6f;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .install {
                display:block;
                color: #3498db !important;
                font-size: 1.2em !important; 
                padding: 20px !important; 
                border: 1px solid;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        @auth
            @include('layouts.include.adminbar')
        @endauth

        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @guest
                    <a href="{{ route('register') }}">Registraté</a>
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                @endguest
                @if(! $isInstalled )
                        <a style="color:#3498db" href="{{ route('install') }}">Instalar</a>
                @endif
            </div>

            <div class="content">
                <div class="title m-b-md">
                    {{ $settings->name }}
                </div>
                <div class="links">
                    <a>{{ $settings->slogan }}</a>
                    @if(! $isInstalled )
                        <a class="install" href="{{ route('install') }}">Para instalar el sistema has click aquí</a>
                    @endif
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script>
            $('.dropdown-toggle').dropdown()
        </script>
    </body>
</html>
