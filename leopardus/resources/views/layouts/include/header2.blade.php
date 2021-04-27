<div class="page-header navbar ">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="{{ url('/') }}">
        <img src="{{ asset('assets/img/logo-light.png') }}" alt="logo" class="logo-default" /> </a>

    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler visible-xs" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN PAGE ACTIONS -->
    <!-- DOC: Remove "hide" class to enable the page header actions -->

    <!-- END PAGE ACTIONS -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top hidden-xs">
      <!-- BEGIN HEADER SEARCH BOX -->
      <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

      <!-- END HEADER SEARCH BOX -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            {{--<a class="navbar-brand" href="{{route('login')}}">Inicia sesión</a>
            <a class="navbar-brand" href="{{route('autenticacion.new-register')}}">Registrate</a>--}}

        </ul>

      </div>

    </div>
  <!-- END HEADER INNER -->
  </div>
</div>
