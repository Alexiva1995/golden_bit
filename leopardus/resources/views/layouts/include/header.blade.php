{{-- <div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="top-menu visible-xs" style="float:left;">
      <ul class="nav navbar-nav ">
        <li class="dropdown dropdown-user dropdown-dark " style="display:flex; align-items:center;">
          <img
            src="{{(!empty(Auth::user()->icono_paquete)) ? asset('assets/'.Auth::user()->icono_paquete) : asset('assets/img/logo-light.png')}}"
height="40" alt="{{Auth::user()->paquete}}">
</li>
<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
  @include('layouts.include.notifications')
</li>
</ul>
</div>
<div class="page-logo">
  <a href="{{ url('/') }}">
    <img src="{{ asset('assets/img/logo-light.png') }}" alt="logo" class="logo-default" height="45" />
  </a>
  <div class="menu-toggler sidebar-toggler">
    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
  </div>
</div>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
</a>
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
      <li class="dropdown dropdown-user dropdown-dark hidden-xs" style="display:flex; align-items:center;">
        <img
          src="{{(!empty(Auth::user()->icono_paquete)) ? asset('assets/'.Auth::user()->icono_paquete) : asset('assets/img/logo-light.png')}}"
          height="40" alt="{{Auth::user()->paquete}}">
      </li>
      <li class="separator hide"> </li>
      <!-- BEGIN NOTIFICATION DROPDOWN -->
      <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
      <li class="dropdown dropdown-extended dropdown-dark hidden-xs" id="header_notification_bar">
      <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
        notificaciones
        @include('layouts.include.notifications')
      </li>

      <li class="dropdown dropdown-extended dropdown-dark hidden-xs">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
          data-close-others="true">
          <span class="username"> {{ Auth::user()->display_name }} </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
          <li>
            <a href="{{ route('admin.user.edit') }}">
              <i class="icon-settings"></i> Profile Edit </a>

          </li>
          <li>
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="icon-key"></i> Logout </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>

        </ul>
      </li>

      <!-- END QUICK SIDEBAR TOGGLER -->
    </ul>
  </div>
  <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END PAGE TOP -->
</div>
<!-- END HEADER INNER -->
</div> --}}

<style>
  .text-small3{
    font-size: 1.74em !important;
  }

  @media screen and (max-width: 600px){
    .text-small3{
      font-size: 1.3em !important;
    }
  }

  @media screen and (max-width: 400px){
    .text-small3{
      font-size: 0.8em !important;
    }
  }
  
</style>

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar floating-nav navbar-with-menu navbar-light navbar-shadow" style="position:absolute">
   <div class="navbar-wrapper" style="background-color: #FFFFFF;">
      <div class="navbar-container content">
         <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
               <ul class="nav navbar-nav">
                  <li class="nav-item mobile-menu d-xl-none mr-auto">
                     <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                        <i class="ficon feather icon-menu"></i>
                     </a>
                  </li>
                  {{--<li class="nav-item">
                     <h2 class="text-small3" style="padding: 1.4rem 0.5rem 1.35rem;">{{$title}}</h2>
                  </li>--}}
               </ul>
               <ul class="nav navbar-nav bookmark-icons">
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('mioficina/admin')}}" data-toggle="tooltip" data-placement="top" title="Balance General"><i class="ficon feather icon-home" style="color: black;"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('mioficina/tienda')}}" data-toggle="tooltip" data-placement="top" title="Inversiones"><i class="ficon feather icon-shopping-cart" style="color: black;"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('mioficina/admin/transactions/networkorders')}}" data-toggle="tooltip" data-placement="top" title="Mi Negocio"><i class="ficon feather icon-activity" style="color: black;"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{route('referraltree', ['matriz'])}}" data-toggle="tooltip" data-placement="top" title="Mi Red"><i class="ficon feather icon-users" style="color: black;"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('mioficina/admin/wallet/')}}" data-toggle="tooltip" data-placement="top" title="Billetera"><i class="ficon feather icon-trending-up" style="color: black;"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('mioficina/admin/info/activacion')}}" data-toggle="tooltip" data-placement="top" title="Informes"><i class="ficon feather icon-file-text" style="color: black;"></i></a></li>
               </ul> 
            </div>
            <ul class="nav navbar-nav float-right">
               {{-- buscar --}}
               {{-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i
                      class="ficon feather icon-search"></i></a>
                  <div class="search-input">
                    <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                    <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="template-list">
                    <div class="search-input-close"><i class="feather icon-x"></i></div>
                    <ul class="search-list"></ul>
                  </div>
               </li> --}}
               {{-- notificaciones --}}
               {{-- @include('layouts.include.notifications') --}}

               <li class="dropdown dropdown-user nav-item">
                  <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                     <div class="user-nav d-sm-flex d-none">
                        <span class="user-name text-bold-600" style="color: black;">
                           {{ Auth::user()->display_name }}
                        </span>
                        <span class="user-status" style="color: black;">
                           @if (Auth::user()->status == 1)
                              Activo
                           @else
                              Inactivo
                           @endif
                        </span>
                     </div>
                     <span><img class="round" src="{{ asset('avatar/'.Auth::user()->avatar) }}" alt="avatar" height="40" width="40"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="{{ route('admin.user.edit') }}">
                        <i class="feather icon-user"></i>
                        Editar Perfil
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="feather icon-power"></i> Salir 
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                     </form>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>
<!-- END: Header-->