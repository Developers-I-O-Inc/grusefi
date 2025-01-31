<!DOCTYPE html>
<html lang="es" >
    <head><base href=""/>
        <title>Grusefi | @yield('title')</title>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <link href="{{asset('assets/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/icons/style.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
        @yield('styles')
        <script>
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed" >
        @include("metronic/partials/theme-mode/_init")
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
            @include("metronic/layout/aside/_base")
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include("metronic/layout/header/_base")
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div id="kt_content_container" class=" container-xxl ">
                        @yield('content')
                    </div>
				</div>
                @include("metronic/partials/_scrolltop")
			</div>
		</div>
	</div>
    @include("metronic/layout/_footer")
    <script src="{{asset('assets/js/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    @stack('scripts')
    </body>
</html>
