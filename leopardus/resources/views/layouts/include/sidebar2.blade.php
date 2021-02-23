<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true"
    style="background-color: #1b1b1b;">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <a class="navbar-brand" href="" href="" style="width: 100%; margin: 0px;">
                <div class="brand-logo2 text-center" style="width: 100%;">
                    <img src="{{ asset('assets/imgLanding/logo-dashboard.png') }}" height="100">
                </div>
            </a>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            style="background-color: #1b1b1b;">
            {{-- INICIO --}}

            {{-- RANKING --}}

            <li class="nav-item">
                <a href="{{url('mioficina/admin')}}" class="nav-link text-white nav-toggle">
                    <i class="fa fa-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle" style="color: #FFFFFF;">
                    <i class="feather icon-bar-chart-2"></i>
                    <span class="title">Inversiones</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu" style="background-color: #1b1b1b;">
                    <li class="nav-item">
                        <a href="{{url('mioficina/tienda')}}" class="nav-link" style="color: #FFFFFF;">
                            <i class="feather icon-circle"></i>
                            <span class="title">Invertir</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('wallet-invesiones')}}" class="nav-link" style="color: #FFFFFF;">
                            <i class="feather icon-circle"></i>
                            <span class="title">Mis Inversiones</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{--FIN RANKING --}}
            {{-- INICIO LIQUIDAR --}}
            <li>
                <a href="{{route('liquidacion.user.comision')}}" class="nav-link text-white nav-toggle">
                    <i class="feather icon-activity"></i>
                    <span class="title">Liquidar</span>
                </a>
            </li>
            {{-- FIN LIQUIDAR --}}
            {{-- INICIO WALLET --}}
            <li class="nav-item">
                <a href="{{route('wallet-index')}}" class="nav-link text-white">
                    <i class="feather icon-bar-chart"></i>
                    <span class="title">Wallet</span>
                </a>
            </li>
            {{-- FIN WALLET --}}
            {{-- INICIO DE ORDENES --}}
            <li class="nav-item">
                <a href="javascript:;" class="nav-link text-white nav-toggle">
                    <i class="feather icon-activity"></i>
                    <span class="title">Ordenes</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu" style="background-color: #1b1b1b;">
                    <li class="nav-item">
                        <a href="{{route('personalorders')}}" class="nav-link text-white">
                            <span class="menu-title" data-i18n="Historial de Ordenes">
                                <i class="feather icon-circle"></i>
                                Ordenes Personales
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('networkorders')}}" class="nav-link text-white">
                            <span class="menu-title" data-i18n="Historial de Ordenes">
                                <i class="feather icon-circle"></i>
                                Ordenes en Red
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- FIN DE ORDENES --}}

            {{-- GEONOLOGIA --}}
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle" style="color: #FFFFFF;">
                    <i class="feather icon-users"></i>
                    <span class="title">Mi Red</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu" style="background-color: #1b1b1b;">
                    <li class="nav-item">
                        <a href="{{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}"
                            class="nav-link" style="color: #FFFFFF;">
                            <i class="feather icon-circle"></i>
                            <span class="title">Nuevo Usuario</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('directrecords')}}" class="nav-link text-white">
                            <i class="feather icon-circle"></i>
                            <span class="title">Registro Directo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('referraltree', ['matriz'])}}" class="nav-link" style="color: #FFFFFF;">
                            <i class="feather icon-circle"></i>
                            <span class="title">Árbol Binario</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('referraltree', ['tree'])}}" class="nav-link" style="color: #FFFFFF;">
                            <i class="feather icon-circle"></i>
                            <span class="title">Árbol Unilevel</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- FIN GENEALOGIA --}}


            {{-- FIN BOT BRAINBOW --}}
            {{--INICIO BILLETERA --}}

            {{-- FIN BILLETERA --}}

            {{-- TICKET --}}
            <li>


                {{-- CERRAR SESIÓN --}}
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link"
                    style="color: #FFFFFF;">
                    <i class="feather icon-log-out"></i>
                    <span class="title">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            {{-- FIN CERRAR SESIÓN --}}
        </ul>
    </div>
</div>