<!DOCTYPE html>
<html>
    <!-- Mirrored from www.pchain.org/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 May 2020 21:33:00 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
        <title>GoldenBit</title>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="renderer" content="webkit"/>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5shiv.js"></script>
        <script type="text/javascript" src="js/respond.js"></script>
        <![endif]-->
    	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('flatic.png') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('templateHome/css/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('templateHome/css/swiper3.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('templateHome/css/animate.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('templateHome/css/aos.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('templateHome/css/style.css') }}"/>
    </head>
    <body>
        <div class="motop clearfix">

            <div class="mologo">
                <a href="index.html">
                    <img class="l1" src="{{ asset('assets/imgLanding/logo-dashboard.png') }}">

                </a>
            </div>
            <!-- mologo.end -->
            <div class="monav">
                <span class="s1"></span>
                <span class="s2"></span>
                <span class="s3"></span>
            </div>
            <!-- monav.end -->
        </div>

        <div class="navdown">
            <ul>
                <li>
                    <a class="link" href="{{route('login')}}">
                        Entrar
                    </a>
                </li>
                <li>
                    <a class="link" href="{{ route('autenticacion.new-register') }}">
                       Registrarme
                    </a>
                </li>
            </ul>

            {{--<div class="mo-language">
                <a class="ch" href="#">中文</a>/
                <a class="en" href="#">English</a>/
                <a class="hw" href="#">한국어</a>
            </div>--}}
        </div>
        <!-- navdown.end -->

        <div class="hd">
            <div class="head content clearfix">
                <div class="logo">
                    <a href="index.html">
                        <img class="logo1" src="{{ asset('assets/imgLanding/brainbow_png.png') }}" style="width: 65%;">
                        <img class="logo2" src="{{ asset('assets/imgLanding/brainbow_png.png') }}" style="width: 65%;">
                    </a>
                </div>
                <div class="nav">
                    <ul class="clearfix">
                        <li>
                            <a href="{{route('login')}}">Entrar</a>
                        </li>
                        <li>
                            <a href="{{ route('autenticacion.new-register') }}">Registrarme</a>
                        </li>
                    </ul>
                    {{--<div class="language">
                        <a class="ch on" href="#">English<i></i></a>
                        <div class="con clearfix">
                            <a href="#">한국어</a>
                            <a href="#">中文</a>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>

        @yield('content')

        <div class="goTop"><img class="img1" src="{{ asset('templateHome/images/top.png') }}"><img class="img2" src="{{ asset('templateHome/images/top2.png') }}"></div>

        <div class="popup">
            <div class="bg"></div>
            <div class="videopop">
                <div class="video">
                    <video src="#" width="100%" controls="controls">
                        Your browser does not support the video tag.
                    </video>
                    <div class="close">
                        <img src="images/close.png">
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('templateHome/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/swiper3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/slick.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/swiper.animate1.0.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/sine-waves.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/wow.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/aos.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/all.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/lazyload.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('templateHome/js/main.js') }}"></script>
    </body>
</html>
