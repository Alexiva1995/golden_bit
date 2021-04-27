<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->name }}</title>

    <!-- Styles -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"  rel="stylesheet"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"  rel="stylesheet"/>
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"  rel="stylesheet"/>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"  rel="stylesheet"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"  rel="stylesheet"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components"/>
    <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/themes/default.min.css') }}" rel="stylesheet" id="style_color"/>
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/celest.css') }}" rel="stylesheet"/>

    <link href="{{ asset('assets/css/style_tree_graphic.css') }}" rel="stylesheet" type="text/css" />

    <!--DATATABLES-->

    <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('flaticon.png') }}">  
</head>
<body>

</body>
</html>



    @yield('styles')
</head>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    @include('layouts.include.header')
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container ">
        <!-- BEGIN SIDEBAR -->
        @if(Auth::user()->rol_id == 0)
        @include('layouts.include.sidebar')
        @else
         @include('layouts.include.sidebar2')
        @endif
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content row">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                  <!-- BEGIN PAGE TITLE -->
                  <div class="page-title">
                    <h1>{{ $title }}
                    </h1>
                  </div>
                  <!-- END PAGE TITLE -->
                  <!-- BEGIN PAGE TOOLBAR
                  <div class="page-toolbar">
                    <div class="btn-group btn-theme-panel">
                      <a href="javascript:;" class="btn">
                        <i class="icon-settings"></i>
                      </a>
                    </div>
                  </div>
                  END PAGE TOOLBAR -->
                </div>
                <!-- END PAGE HEAD-->


                @yield('content')
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('assets/scripts/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('assets/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/demo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/ui-buttons.min.js') }}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <!--DATATABLES-->
    <script type="text/javascript" language="javascript" src="{{ asset('assets/datatables/datatables.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
