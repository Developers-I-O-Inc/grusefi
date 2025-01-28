@extends('metronic.index')
@section('styles')
    <style>
        table {
            table-layout: fixed !important;
            width: 100% !important;
        }
        .watermark{
            position: relative;
        }
        .watermark::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 85%;
            height: 85%;
            background: url('/img/marca_agua.jpg') no-repeat center center;
            background-size: contain;
            transform: translate(-50%, -50%); /* Centra la imagen */
            filter: grayscale(100%);
            opacity: 0.1;
            z-index: 0; /* Cambiado de 0 a -1 */
            pointer-events: none; /* Añadido */
        }

        .card table {
            position: relative;
            z-index: 1;
        }
        .logo-unidad-verificacion {
            width: 96px;
            min-width: 96px;
            max-width: 96px;
            height: 96px;
            min-height: 96px;
            max-height: 96px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #ContentPlaceHolder1_ASPxFormLayout1_3_0 > div {
            display: block;
            padding: 16px 0px;
            margin: 0px -16px;
        }

        #template-container {
            display: block;
            font-size: 16px;
            background: #FFF;
            color: #333;
            padding: 16px;
            box-shadow: 0px 3px 4px #AAA;
        }

        #template-container * {
            box-sizing: border-box;
        }

        #template-container input[type=checkbox] {
            margin: 4px 4px 0px 4px;
        }

        #template-container input[type=text],
        .disabled-input {
            padding: 4px;
            /*border: 1px solid #DDD;*/
            border: none;
            border-bottom: 1px solid #BBB;
            outline: none;
        }

        #template-container input[type=text] {
            border-color: #005c87;
        }

        #template-container input[type=text],
        #template-container input[type=text]:active,
        #template-container input[type=text]:focus {
            animation: editable_input 1.5s ease-in-out infinite;
            /*border-width: 2px;*/
        }

        .disabled-input {
            height: 25px;
            font-size: 16px;
            line-height: 18px;
            font-weight: 500;
            /*text-align: center;*/
            overflow: hidden;
            word-break: break-all;
        }

        .template-header {
            display: flex;
            align-items: center;
        }

        .template-header .logo-SNSICA {
            height: 128px;
            min-height: 128px;
            max-height: 128px;
        }

        .template-header .title {
            text-transform: uppercase;
            text-align: center;
            flex-grow: 1;
            margin: 0px 40px;
        }

        .template-header .logo-unidad-verificacion {
            width: 96px;
            min-width: 96px;
            max-width: 96px;
            height: 96px;
            min-height: 96px;
            max-height: 96px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

            .template-header .logo-unidad-verificacion > img {
                max-width: 100%;
                max-height: 100%;
            }

        .template-subheader {
        }


        .section {
            margin-bottom: 24px;
        }

        .group-control {
            display: inline-flex;
            align-items: center;
        }

            .group-control > span.disabled-input {
                flex-grow: 1;
            }

        .text-upper {
            text-transform: uppercase;
        }

        .text-bold {
            font-weight: 700;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .m-l-xs {
            margin-left: 8px;
        }

        .m-t-xs {
            margin-top: 8px;
        }

        .m-r-xs {
            margin-right: 8px;
        }

        .m-b-xs {
            margin-bottom: 8px;
        }

        .m-l-sm {
            margin-left: 16px;
        }

        .m-t-sm {
            margin-top: 16px;
        }

        .m-r-sm {
            margin-right: 16px;
        }

        .m-b-sm {
            margin-bottom: 16px;
        }

        .m-l-md {
            margin-left: 24px;
        }

        .m-t-md {
            margin-top: 24px;
        }

        .m-r-md {
            margin-right: 24px;
        }

        .m-b-md {
            margin-bottom: 24px;
        }



        @keyframes editable_input {
            0% {
                border-bottom-color: #B3E5FC;
            }

            50% {
                border-bottom-color: #02d155;
            }

            100% {
                border-bottom-color: #B3E5FC;
            }
        }

        .brd {
            border: 1px solid #CCC;
        }

        .brd-l {
            border-left: 1px solid #CCC;
        }

        .brd-t {
            border-top: 1px solid #CCC;
        }

        .brd-r {
            border-right: 1px solid #CCC;
        }

        .brd-b {
            border-bottom: 1px solid #CCC;
        }

        .pd-sm {
            padding: 4px 8px;
        }
    </style>
@endsection
@section('title', 'Plantillas RPV')
@section('title_top', 'Plantillas RPV')
@section('config', 'active')
@section('subtitle_top', 'Control de Plantillas RPV')
@section('content')
    <div id="kt_content_container bg-light-primary" class="container-xxl">
        @if (Session::has('message_type') && Session::has('message'))
            <div class="alert alert-dismissible bg-light-warning border border-warning d-flex align-items-center p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-warning me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                    </svg>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-warning">Alerta</h4>
                    <span>{{Session::get('message')}}</span>
                    <span>{{Session::get('pais_id')." - ".Session::get('variedad_id')}}</span>
                </div>
            </div>
        @endif
        <form id="form_plantilla">
            <div class="card">
                <div class="card-body bg-light-primary rounded border-primary border border-dashed">
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <input type="text" id="plantilla_id" name="plantilla_id" class="d-none">
                            <select id="pais_id" name="pais_id" class="form-select" data-control="select2" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                <option value=""></option>
                                @foreach($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <select id="variedad_id" name="variedad_id" disabled class="form-select" data-control="select2" data-placeholder="Selecciona una variedad" data-allow-clear="true">
                                <option value=""></option>
                                @foreach($variedades as $variedad)
                                    <option value="{{$variedad->id}}">{{$variedad->variedad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 offset-3 fv-row px-6">
                            <a type="button" class=" btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-8 me-1 d-none" id="btn_imprimir" href="/operation/imprimir_dictamen/1" target="_blank">Imprimir</a>
                        </div>
                        <div class="col-md-1 fv-row px-10">
                            @can('admin_plantillas')
                                <button type="button" class="btn btn-primary btn-sm nav-link fw-bolder px-4 ms-1 d-none" id="btn_add">Guardar</button>
                                <button type="button" class="btn btn-primary btn-sm nav-link fw-bolder px-4 me-10 d-none" id="btn_edit">Editar</button>
                            @else
                                <button type="button" disabled class="btn btn-secondary btn-sm nav-link fw-bolder px-4 me-1 d-none" id="btn_add">Guardar</button>
                                <button type="button" disabled class="btn btn-secondary btn-sm nav-link fw-bolder px-4 me-1 d-none" id="btn_edit">Editar</button>
                            @endcan
                        </div>
                        <div class="col-md-1 fv-row">
                            <button type="button" class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" id="btn_search">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="card table-responsive py-6">
                <x-table-rpv :vigencias="$vigencias"></x-table-rpv>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/plantilla_rpv.js')}}" type="module"></script>
@endpush
