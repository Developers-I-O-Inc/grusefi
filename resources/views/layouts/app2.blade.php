<!DOCTYPE html>
<html lang="es">
<head>
    <base href="">
    <title>Grusefi | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<style>
    .progress {
    width: 158.4px;
    height: 26.4px;
    border-radius: 26.4px;
    background: repeating-linear-gradient(135deg,#3876ff 0 13.2px,rgba(56,118,255,0.75) 0 26.4px) left/0%   100% no-repeat,
            repeating-linear-gradient(135deg,rgba(56,118,255,0.2) 0 13.2px,rgba(56,118,255,0.1) 0 26.4px) left/100% 100%;
    animation: progress-p43u5e 1.6s infinite;
    }

    @keyframes progress-p43u5e {
    100% {
        background-size: 100% 100%;
    }
    }
</style>
<body id="kt_body"class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed">
    <div class="d-flex flex-column flex-root">
        {{-- MENU LATERAL --}}
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <div class="aside-logo py-8" id="kt_aside_logo">
                    <a href="/dashboard" class="d-flex align-items-center">
                        <img alt="Logo" src="{{asset('img/logo.png')}}" class="h-85px logo" />
                    </a>
                </div>
                <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
                    <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper"
                        data-kt-scroll="true" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                        data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
                        <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold"
                            id="#kt_aside_menu" data-kt-menu="true">
                            @can(["ver_zonas"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link menu-center @yield("zones")" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-geo-alt"></i>
                                        </span>
                                        <span class="menu-title center">Zona Geográfica</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Zonas</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/paises">
                                                {{-- <span class="menu-icon"><i class="bi bi-tag fs-2"></i></span> --}}
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Paises</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/estados">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Estados</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/municipios">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Municipios</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/localidades">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Localidades</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can(["ver_configuacion"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link menu-center @yield("config")" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-wrench"></i>
                                        </span>
                                        <span class="menu-title center">Configuración</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item center">
                                            <div class="menu-content text-center">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Configuración General</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/calibres">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Calibres</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/categorias">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Categorías</span>
                                            </a>
                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Clientes</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion">
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="/catalogs/empaques">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Nuevo</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="/catalogs/destinatarios">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Destinatarios</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="/catalogs/marcas">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Marcas</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/floraciones">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Floraciones</span>
                                            </a>
                                        </div> --}}
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/presentaciones">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Presentaciones</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/puertos">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Puntos de Entrada</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/regulaciones">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Regulaciones del País</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/tipo_cultivos">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Tipo de Cultivos</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/usos">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Usos</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/variedades">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Variedades</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can(["ver_plantillas"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link menu-center  @yield("purchases")" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-file-earmark"></i>
                                        </span>
                                        <span class="menu-title">Plantillas</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Plantillas</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/operation/plantillas_rpv">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">DV</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can(["ver_embarques"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link menu-center  @yield("purchases")" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-box"></i>
                                        </span>
                                        <span class="menu-title">Embarques</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Embarques</span>
                                            </div>
                                        </div>
                                        @can(['admin_embarques'])
                                            <div class="menu-item">
                                                <a class="menu-link" href="/operation/embarques">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Nuevo</span>
                                                </a>
                                            </div>
                                        @endcan
                                        <div class="menu-item">
                                            <a class="menu-link" href="/operation/embarques_admin">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Generar RPV</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can(["ver_admin"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link @yield('admin') menu-center" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-shield-lock fs-2"></i>
                                        </span>
                                        <span class="menu-title">Administración</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Administración</span>
                                            </div>
                                        </div>
                                        @role('Super Admin')
                                            <div class="menu-item">
                                                <a class="menu-link" href="/admin/permissions">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Permisos</span>
                                                </a>
                                            </div>
                                        @endrole
                                        <div class="menu-item">
                                            <a class="menu-link" href="/admin/roles">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Roles</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/admin/users">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Usuarios</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="/catalogs/vigencias">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Vigencias</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can(["ver_reportes"])
                                <div data-kt-menu-trigger="hover" data-kt-menu-placement="right-start"
                                    class="menu-item py-2">
                                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-file-earmark-lock fs-2"></i>
                                        </span>
                                        <span class="menu-title">Reportes</span>
                                    </span>
                                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                        <div class="menu-item">
                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Reportes</span>
                                            </div>
                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Ventas</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion">
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-in.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Fechas</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-up.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Sucursal</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Ventas</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion">
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-in.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Fechas</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-up.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Sucursal</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Ventas</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion">
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-in.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Fechas</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="../../demo6/dist/authentication/flows/basic/sign-up.html">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Sucursal</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="aside-footer flex-column-auto" id="kt_aside_footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btm-sm btn-icon btn-active-color-primary"
                            data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                            data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-dismiss="click" title="Quick actions">
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                        fill="black" />
                                    <rect x="6" y="12" width="7" height="2" rx="1"
                                        fill="black" />
                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
                                </svg></span>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Ayuda</div>
                            </div>
                            <div class="separator mb-3 opacity-75"></div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Nuevo Ticket</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Reportar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                {{-- END MENU LATERAL --}}
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                {{-- TOP BAR --}}
                <div id="kt_header" style="" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="d-flex align-items-center d-lg-none ms-n1 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                                id="kt_aside_mobile_toggle">
                                <span class="svg-icon svg-icon-2x mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="/dashboard" class="d-lg-none">
                                <img alt="Logo" src="{{asset('img/logo.png')}}" class="h-30px" />
                            </a>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <div class="d-flex align-items-center" id="kt_header_nav">
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                   <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
                                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">@yield('title_top')</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-dark">@yield('subtitle_top')</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <div class="d-flex align-items-stretch flex-shrink-0">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="d-flex align-items-center">
                                            <a href="#"
                                                class="btn btn-sm btn-bg-light btn-color-gray-500 btn-active-color-primary me-2"
                                                id="" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                                data-bs-trigger="hover" title="Select dashboard daterange">
                                                <span class="fw-bold me-1" id="kt_dashboard_daterangepicker_title" id="prueba">Hoy es:</span>
                                                <span class="fw-bolder" id="kt_dashboard_daterangepicker_date">
                                                    @php
                                                        use Carbon\Carbon;
                                                        Carbon::setLocale('es');
                                                        $fecha = Carbon::now()->translatedFormat('j \d\e F \d\e Y');
                                                        echo $fecha
                                                    @endphp
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center ms-1 ms-lg-3">
                                        <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px pulse pulse-success"
                                            id="kt_drawer_chat_toggle">
                                            <i class="bi bi-app-indicator fs-2"></i>
                                            <span class="pulse-ring w-45px h-45px"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                            data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                            data-kt-menu-placement="bottom-end">
                                            <img src="{{ Auth::user()->profile_photo_url }}" alt="image" />
                                        </div>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
                                                    <div class="symbol symbol-50px me-5">
                                                        <img alt="Logo" src="{{ Auth::user()->profile_photo_url }}" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                                            <span
                                                                class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                        </div>
                                                        <a href="#"
                                                            class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator my-2"></div>
                                            @can(["ver_admin"])
                                                <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                    <a href="#" class="menu-link px-5">
                                                        <span class="menu-title">Administración</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                        <div class="menu-item px-3">
                                                            <a href="/admin/roles" class="menu-link px-5">Roles</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="/admin/users" class="menu-link px-5">Usuarios</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                            <div class="menu-item px-5">
                                                <a href="user/profile" class="menu-link px-5">Mi Perfil</a>
                                            </div>
                                            <div class="separator my-2"></div>
                                            <div class="menu-item px-5">
                                                <form method="POST" action="{{ route('logout') }}" x-data>
                                                    @csrf
                                                    <button type="submit" @click.prevent="$root.submit();"
                                                    class="menu-link px-5 btn btn-white"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="black"/>
                                                        <path d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.83785 8.12683 9.12683 7.69401 8.69401C7.3043 8.3043 6.67836 8.28591 6.26643 8.65206L3.34084 11.2526C2.89332 11.6504 2.89332 12.3496 3.34084 12.7474L6.26643 15.3479C6.67836 15.7141 7.3043 15.6957 7.69401 15.306C8.12683 14.8732 8.09458 14.1621 7.62435 13.7703L5.86875 12.3073C5.67684 12.1474 5.67684 11.8526 5.86875 11.6927Z" fill="black"/>
                                                        <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
                                                        </svg></span>Cerrar Sesión</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TOP BAR --}}
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
                </div>
                {{-- FOOTER --}}
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2024©</span>
                            <a href="#" target="_blank"
                                class="text-gray-800 text-hover-primary">DEVELOPERS</a>
                        </div>
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">Acerca de</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" target="_blank"
                                    class="menu-link px-2">Soporte</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                    transform="rotate(90 13 6)" fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
    </div>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
    @yield('scripts')
</body>

</html>
