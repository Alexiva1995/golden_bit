<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Level Up</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('flaticn.png') }}">
    {{-- font Google --}}
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2:400,500,600,700,800&display=swap"
        rel="stylesheet">
    {{-- Css Boostrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    {{-- Css Custom --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/css/landing.css')}}"> --}}
    <style>
        body {
            font-family: 'Baloo Thambi 2', cursive;
        }

        .card-alt {
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 1.4rem !important;
        }

        .bg-alt-orange {
            background: #000000;
        }

        .text-alt-orange {
            color: #00646d;
        }

        .container-alt {
            /* height: 80vh; */
            display: flex;
            align-items: center;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }

        .text-white{
            color: white !important;
        }

        .text-center{
            text-align: center;
        }


        .pt-2{
            padding-top: .5rem !important;
        }

        .pl-3{
            padding-left: 1rem !important;
        }

        .m2-auto{
            margin: 0 auto !important;
        }
    </style>
</head>

<body>
    <div class="container container-alt2">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center ">
                    <div class="col-12 col-sm-10 co-md-10 col-lg-8">
                        <div class="card text-white card-alt"
                            style="background:#cab07a">
                            <h6 class="text-center">
                                <img src="{{asset('assets/imgLanding/foto-logo.png')}}" alt="logo" height="120"
                                class="pt-2">
                            </h6>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-3 text-alt-orange">
                    <h4>
                        <strong>
                            @stack('quote')
                        </strong>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 bg-alt-orange mt-5">
        <div class="card bg-alt-orange text-white">
            <div class="card-body">
                <small>
                    <p class="">
                  
                    </p>
                </small>
                <div class="col-12 text-white">
                    <h5>
                        <a href="https://www.facebook.com/Level.upclubuppers/">
                            <img src="{{asset('assets/imgLanding/icono_fb-09.png')}}" alt="" height="30" class="text-white">
                        </a>
                        <a href="https://www.instagram.com/level.upclub/">
                            <img src="{{asset('assets/imgLanding/icono_instagram-09.png')}}" alt="" height="30" class="text-white">
                        </a>
                        <a href="http://">
                            <img src="{{asset('assets/imgLanding/icono_telegram-09.png')}}" alt="" height="30" class="text-white">
                        </a>
                    </h5>
                </div>
            </div>
        </div>
    </div> --}}
</body>
{{-- js Boostrap y jquery y popper --}}
<script src="{{asset('assets/scripts/jquery.min.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

</html>