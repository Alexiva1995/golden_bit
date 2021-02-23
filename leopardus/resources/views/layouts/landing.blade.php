<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Level Up</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('flaticon.png') }}">
    {{-- font Google --}}
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2:400,500,600,700,800&display=swap" rel="stylesheet"> 
    {{-- Css Boostrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        {{-- font-awesome --}}
        <link rel="stylesheet" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    {{-- Css Custom --}}
    <link rel="stylesheet" href="{{asset('assets/css/landing.css')}}">
</head>
<body>
    {{-- header --}}
    @if ($landing == 0)
    <div class="header-alt" style="background: url({{asset('assets/imgLanding/imagen-banner-principal.png')}})">
    @elseif($landing == 3)
    <div class="header-alt2" style="background: url({{asset('assets/fondo-registro-inicio-de-sesin-.jpg')}})">
    @else
    <div class="header-alt2" style="background: url({{asset('assets/imgLanding/fondo-banner-principal.jpg')}})">
    @endif
        @include('layouts.include.headerLanding')
    </div>
    {{-- container --}}
    @if ($landing != 1 || $landing != 3)
    <div class="container">
        @yield('content')
    </div>
    @endif
    {{-- footer --}}
    @include('layouts.include.footerLanding')
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
{{-- Js Custom --}}
<script src="{{asset('assets/scripts/scriptLanding.js')}}"></script>

</html>