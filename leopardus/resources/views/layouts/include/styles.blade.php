<!-- BEGIN: Vendor CSS-->

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">

@stack('vendor_css')

<!-- END: Vendor CSS-->



<!-- BEGIN: Theme CSS-->

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">

@stack('theme_css')



<!-- BEGIN: Page CSS-->

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-analytics.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/card-analytics.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/tour/tour.css')}}">

<style>
    .dropdown-item:hover{
        background: #C8AD77 !important;
        color: #ffffff !important;
    }
</style>

@stack('page_css')

<!-- END: Page CSS-->



<!-- BEGIN: Custom CSS-->

<link rel="stylesheet" type="text/css" href="{{('assets/css/style.css')}}">

<style>

	#video_background {
		position: absolute;
		bottom: 0px;
		right: 0px;
		min-width: 100%;
		min-height: 100%;
		width: auto;
		height: auto;
		z-index: -1000;
		overflow: hidden;
	}
	#video_pattern {
		background:#fff;
		position: fixed;
		opacity: 0.8;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: -1;
	}

    #diseng {

        border-radius: 50%;

        height: 120px;

        width: 120px;

        background-repeat: no-repeat !important;

        background-size: contain !important;

        background-position: center center !important;

        margin: 0 auto;

        border: 1px solid #00646d;

    }



    .bg-orange-alt {

        background: #00646d;

        border-color: #00646d;

    }



    .bg-orange-alt-2 {

        background: rgba(207, 96, 70, 0.5)

    }



    .bg-blue-alt-2 {

        background: rgba(62, 135, 175, 0.5)

    }



    .text-alt-blue {

        color: #3e87af;

    }



    .text-alt-orange {

        color: #00646d;

    }



    .custom-control-input:checked~.custom-control-label::before {

        border-color: #00646d;

        background-color: #00646d;

    }

    .app-content .wizard > .steps > ul > li.current .step, .app-content .wizard.wizard-circle > .steps > ul > li::before, .app-content .wizard.wizard-circle > .steps > ul > li::after{
        background: #C8AD77 ;
        border-color:  #C8AD77 ;
    }
    
    .app-content .wizard > .steps > ul > li.done .step{
        border-color:  #C8AD77 ;
    }

    .app-content .wizard > .steps > ul > li.current > a{
        color: #1f2b48
    }

    .app-content .wizard > .actions > ul > li > a[href="#previous"]{
        background: #C8AD77;
        /* color: white; */
    }

    .app-content .wizard > .actions > ul > li > a{
        background: #C8AD77;
    }

    .bg-blue-dark{
        background: #1f2b48 !important;
    }

    .input-group-text{
        background: #C8AD77;
        color: #1f2b48;
        border-color: #C8AD77;
    }
    .b-blue{
        border-color: #C8AD77;
    }

    .fondoBoxDashboard{
        height: 100% !important;
        background-repeat: no-repeat !important;
        background-position: center center !important;
        background-size: cover !important;
    }

    .main-menu{
        height: 200% !important;
    }

    .main-menu .nav-item.hover{
        background: #C8AD77;
    }

    .main-menu.menu-light .navigation > li.open > a, .main-menu.menu-light .navigation > li.sidebar-group-active > a{
        background: #C8AD77 !important;
    }

</style>

@stack('custom_css')

<!-- END: Custom CSS-->