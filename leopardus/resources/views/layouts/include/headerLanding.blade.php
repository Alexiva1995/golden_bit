{{-- Menu --}}

{{-- <nav class="navbar navbar-expand-lg {{($landing == 0) ? 'fixed-top' : 'sticky-top'}} navbar-light" id="menu"> --}}
<nav class="navbar navbar-expand-lg sticky-top navbar-light" id="menu">

    <a class="navbar-brand" href="javascript:;" onclick="moveDiv('#header')">

        <img src="{{asset('assets/imgLanding/logo2.png')}}" height="90" alt="">

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"

        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

        <ul class="navbar-nav">

            <li class="nav-item active">

                <a class="nav-link d-flex text-small" href="javascript:;" onclick="moveDiv('#quienessomos')">

                    <div class="point"></div> Filosofía <span class="sr-only">(current)</span>

                </a>

            </li>

            <li class="nav-item">



                <a class="nav-link d-flex text-small" href="javascript:;" onclick="moveDiv('#comofunciona')">

                    <div class="point"></div> Alianzas

                </a>

            </li>

            <li class="nav-item">



                <a class="nav-link d-flex text-small" href="javascript:;" onclick="moveDiv('#participar')">

                    <div class="point"></div> ¿Cómo funciona?

                </a>

            </li>

            <li class="nav-item">



                <a class="nav-link d-flex text-small" href="{{route('product')}}">
                    <div class="point"></div> Productos

                </a>

            </li>

            <li class="nav-item">



                <a class="nav-link d-flex text-small" href="javascript:;" onclick="moveDiv('#contacto')">

                    <div class="point"></div> Contacto

                </a>

            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle text-small" href="#" id="navbarDropdownMenuLink" role="button"

                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    Idioma

                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    <a class="dropdown-item text-small" href="#">Ingles</a>

                    <a class="dropdown-item text-small" href="#">Español</a>

                    <a class="dropdown-item text-small" href="#">Frances</a>

                </div>

            </li>

        </ul>

    </div>

</nav>

{{-- informacion principal --}}

<div class="container" id="header">

    @if ($landing == 0)

        @include('layouts.include.sublanding.inicio')

    @elseif($landing == 1)
        @include('layouts.include.sublanding.tabLegal')
    @elseif($landing == 3)
        @include('layouts.include.sublanding.product')
    @else
        @include('layouts.include.sublanding.faq')
    @endif

</div>