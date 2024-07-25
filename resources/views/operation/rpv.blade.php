@extends('layouts/app2')
@section('styles')
    <link href="{{asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plantilla_pdf.css')}}" rel="stylesheet" type="text/css" />
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
        <form id="form_plantilla">
            <div class="card">
                <div class="card-header pt-6 bg-light-primary rounded border-primary border border-dashed">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <select id="pais_id" name="pais_id" class="form-select" data-control="select2" data-placeholder="Selecciona un país" data-allow-clear="true">
                                <option></option>
                                @foreach($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-categoria-table-toolbar="base">
                            <button type="button" class="btn btn-primary" id="btn_add">Guardar</button>
                        </div>
                        <div class="d-flex justify-content-end mr-2" data-kt-categoria-table-toolbar="base">
                            <button type="button" class="btn btn-primary" id="btn_search">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="card table-responsive py-6">
                <table class="dxflGroup_Moderno dxflGroupSys dxflAGSys" style="border-collapse:separate;">
                    <tbody>
                        <tr>
                            <td id="ContentPlaceHolder1_ASPxFormLayout1_3_0" class="dxflHALSys dxflGroupCell_Moderno dxflChildInFirstRowSys dxflFirstChildInRowSys dxflLastChildInRowSys dxflLastChildSys dxflChildInLastRowSys">
                                <div class="dxflNestedControlCell_Moderno dxflCLLSys dxflItemSys dxflTextItemSys dxflItem_Moderno">
                                    <div id="template-container" class="watermark ">
                                        <div class="section template-header">
                                            <img class="logo-SNSICA" src="{{asset('img/SNSICA.png')}}" alt="Logo">
                                            <h2 class="title">Dictamen de verificacion (DV) <br> para la movilizacion de productos vegetales</h2>
                                            <div class="logo-unidad-verificacion">
                                                <img src="{{asset('img/logo.png')}}" alt="Logo Unidad de Verificación">
                                            </div>
                                        </div>
                                        <div class="section template-subheader">
                                            <div class="text-right m-b-xs">
                                                <span class="text-bold">Folio: </span>
                                                <input id="FolioRPV" type="text" name="FolioRPV" value="" maxlength="250" style="width: 250px;">
                                            </div>
                                            <h4 class="text-upper text-center"><span class="text-bold">A) Orden de servicio</span> (Para ser llenado por el cliente o usuario)</h4>
                                        </div>
                                        <div class="section">
                                            <div style="display: flex; align-items: center;">
                                                <div class="text-bold" style="width: 100px;">1 Inicio:</div>
                                                <div class="group-control" style="flex-grow: 1;">Lugar: <span class="disabled-input m-l-sm">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span></div>
                                                <div class="group-control m-l-md" style="width: 250px;">Fecha: <span class="disabled-input m-l-sm">XX/XX/XXXX</span></div>
                                                <div class="group-control m-l-md" style="width: 175px;">Hora: <span class="disabled-input m-l-sm">XX:XX x.x.</span></div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div class="text-bold">2 Servicio solicitado:</div>
                                            <div style="display: flex; align-items: center;">
                                                <div class="group-control" style="flex-grow: 1;">Dictamen de verificación: (<input id="ss_dictamen_verificacion" class="p_input" type="checkbox" name="ss_dictamen_verificacion" value="Prueba">)</div>
                                                <div class="group-control m-l-md" style="flex-grow: 1;">Certificado fitosanitario para la movilización nacional: (<input id="ss_certificado_movilizacion" type="checkbox" class="p_input" name="ss_certificado_movilizacion" value="">)</div>
                                                <div class="group-control m-l-md" style="flex-grow: 1;">Certificado fitosanitario internacional: (<input id="ss_certificado_internacional" type="checkbox" class="p_input" name="ss_certificado_internacional" value="">)</div>
                                            </div>
                                            <div class="m-t-xs" style="display: flex;">
                                                Otro(especifique):
                                                <input id="ss_otro" class="m-l-sm p_input" type="text" name="ss_otro" value="" maxlength="250" style="flex-grow: 1;">
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div class="text-bold">3 Datos para expedición de certificado fitosanitario:</div>
                                            <div style="display: flex;">
                                                <div style="width: 50%; padding-right: 16px;">
                                                    Nombre y dirección del remitente:
                                                    <div class="disabled-input m-t-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                </div>
                                                <div style="width: 50%;">
                                                    Nombre y dirección del destinatario:
                                                    <div class="disabled-input m-t-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width: 50%; padding-right: 16px;">
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <div style="width: 30%; padding-right: 16px;">
                                                            <div>Producto</div>
                                                            <input id="Producto" type="text" name="Producto" value="AGUACATE(Persea americana) Var. Hass" maxlength="100" style="width: 100%;">
                                                        </div>
                                                        <div style="width: 30%; padding-right: 16px;">
                                                            <div>Uso</div>
                                                            <input id="Uso" type="text" name="Uso" value="Consumo Humano" maxlength="100" style="width: 100%;">
                                                        </div>
                                                        <div style="width: 40%;">
                                                            Cantidad
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 50%;">
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <div style="width: 60%; padding-right: 16px;">
                                                            <div>Presentación</div>
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                        <div style="width: 40%;">
                                                            <div>Marcas distintivas</div>
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width: 50%; padding-right: 16px;">
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <div style="width: 60%; padding-right: 16px;">
                                                            <div>Punto de entrada</div>
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                        <div style="width: 40%;">
                                                            Medio de transporte y placas
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 50%;">
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <div style="width: 60%; padding-right: 16px;">
                                                            <div>Origen</div>
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                        <div style="width: 40%;">
                                                            <div>Procedencia</div>
                                                            <div class="disabled-input">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-t-md">
                                                <input id="LeyendaB" class="text-center" type="text" name="LeyendaB" value="B) LISTA DE VERIFICACIÓN(PARA SER LLENADO POR EL OFA O TEF)" maxlength="200" style="width: 100%;">
                                                <div class="m-t-xs" style="font-size: 11px;">
                                                    De conformidad con los artículos 68, 71, 84, 85, 91, 92, 94, 100, 101 de la Ley Federal sobre Metrología y Normalización;  97, 99, 100, 101 y 102 del Reglamento de la Ley Federal sobre Metrología y Normalización; 7 fracción XVIII, 13, 15, 22 fracción II, 27, 28, 35, 50 fracciones I, VII, 51, 53, 54, 55, 57 del Decreto por el que se reforman, adicionan y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal;  7, fracciones XIII y XIX, 22 fracciones I y III, 52, 56 de la Ley Federal de Sanidad Vegetal; Normas Oficiales Mexicanas, requisitos fitosanitarios del país importador y demás disposiciones legales aplicables, se realiza la verificación fitosanitaria del producto, lote o embarque.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section" style="display: flex; align-items: center;">
                                            <span class="text-bold m-r-sm">4 Indique la regulación o requisito que se evaluará:</span>
                                            <input id="Regulacion" type="text" name="Regulacion" value="" maxlength="500" style="flex-grow: 1;">
                                        </div>
                                        <div class="section">
                                            <div class="text-bold">5 De acuerdo al servicio solicitado y a la regulación o requisito que aplica, marque con una “X” los documentos que son requeridos para iniciar el proceso de verificación:</div>
                                            <div style="display: flex; flex-wrap: wrap; align-items: center;">
                                                <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                                    <span style="width: 250px;">(<input id="IsCFMN5" type="checkbox" name="IsCFMN5" value="">) Certificado Fitosanitario para la Movilización Nacional</span>
                                                    <input id="DetalleCFMN" type="text" name="DetalleCFMN" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsCDFINorma" type="checkbox" name="IsCDFINorma" value="">) Certificado Fitosanitario de cumplimiento de Norma</span>
                                                    <input id="DetalleCFINorma" type="text" name="DetalleCFINorma" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                                    <span style="width: 250px;">(<input id="IsCartillaFito" type="checkbox" name="IsCartillaFito" value="">) Cartilla Fitosanitaria</span>
                                                    <input id="DetalleCartillaFito" type="text" name="DetalleCartillaFito" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsTarjManejo" type="checkbox" name="IsTarjManejo" value="">) Tarjeta de Manejo Integrado de Moscas de la Fruta</span>
                                                    <input id="DetalleTarjManejo" type="text" name="DetalleTarjManejo" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                                    <span style="width: 250px;">(<input id="IsCopiaCFMN" type="checkbox" name="IsCopiaCFMN" value="">) Copia del CFMN expedido en el origen</span>
                                                    <input id="DetalleCopiaCFMN" type="text" name="DetalleCopiaCFMN" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsCopiaCFIImport" type="checkbox" name="IsCopiaCFIImport" value="">) Copia de Certificado Fitosanitario de Importación</span>
                                                    <input id="DetalleCopiaCFIImport" type="text" name="DetalleCopiaCFIImport" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                                    <span style="width: 250px;">(<input id="IsDiagFito" type="checkbox" name="IsDiagFito" value="">) Diagnóstico Fitosanitario</span>
                                                    <input id="DetalleDiagFito" type="text" name="DetalleDiagFito" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsCerHTLMF" type="checkbox" name="IsCerHTLMF" value="">) Certificado de HTLMF</span>
                                                    <input id="DetalleCerHTLMF" type="text" name="DetalleCerHTLMF" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                                    <span style="width: 250px;">(<input id="IsDictEvaluacion" type="checkbox" name="IsDictEvaluacion" value="">) Dictamen de Evaluación de la Conformidad</span>
                                                    <input id="DetalleDictEvaluacion" type="text" name="DetalleDictEvaluacion" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsCerFitoCuarentena" type="checkbox" name="IsCerFitoCuarentena" value="">) Certificado Fitosanitario de Tratamiento Cuarentenario</span>
                                                    <input id="DetalleCerFitoCuarentena" type="text" name="DetalleCerFitoCuarentena" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div style="width: 50%; padding-right: 16px;">(<input id="IsNingunDoc" type="checkbox" name="IsNingunDoc" value="">) Ningún documento</div>
                                                <div class="m-b-xs" style="display: flex; width: 50%;">
                                                    <span style="width: 250px;">(<input id="IsAvisoInicio" type="checkbox" name="IsAvisoInicio" value="">) Aviso de inicio de funcionamiento (Anotar # de Registro de Huerto o instalación)</span>
                                                    <input id="DetalleAvisoInicio" type="text" name="DetalleAvisoInicio" value="" maxlength="150" style="flex-grow: 1;">
                                                </div>
                                                <div style="width: 100%;">
                                                    <div style="display: flex;">
                                                        <span class="m-r-sm">(<input id="IsOtro" type="checkbox" name="IsOtro" value="">) Otro(especifique):</span>
                                                        <input id="DetalleOtro" type="text" name="DetalleOtro" value="" maxlength="500" style="flex-grow: 1;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div>
                                                <span class="text-bold">6 ¿El producto, lote o instalación se encuentra identificado, acondicionado y preparado  para realizar la verificación?</span>
                                                Si (<input type="radio" name="IsIdentificado" value="1" checked="checked">) No (<input type="radio" name="IsIdentificado" value="0">).
                                            </div>
                                            <p>Si su respuesta es No, cancele la verificación hasta que sea requerido nuevamente, de lo contrario continúe con el siguiente apartado.</p>
                                        </div>
                                        <div class="section">
                                            <div class="text-bold">7 De acuerdo con la regulación o requisito que aplica. ¿El tipo de verificación que se requiere es?</div>
                                            <div style="display: flex; align-items: center;">
                                                <div class="group-control" style="flex-grow: 1;">(<input id="ConstatacionOcular" type="checkbox" name="ConstatacionOcular" value="">) Constatación ocular</div>
                                                <div class="group-control m-l-md" style="flex-grow: 1;">(<input id="DiagnosticoFitosanitario" type="checkbox" name="DiagnosticoFitosanitario" value="">) Diagnostico fitosanitario</div>
                                                <div class="group-control m-l-md" style="flex-grow: 1;">(<input id="MuestreoSitio" type="checkbox" name="MuestreoSitio" value="">) Muestreo en sitio</div>
                                                <div class="group-control m-l-md" style="flex-grow: 1;">
                                                    (<input id="VerificacionOtro" type="checkbox" name="VerificacionOtro" value="">) Otro(especifique):
                                                    <input id="DetalleOtroVerificacion" type="text" name="DetalleOtroVerificacion" value="" maxlength="150" style="width: 350px; margin-left: 8px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div class="text-bold m-b-xs">8 De conformidad con el tipo de verificación anote las condiciones fitosanitarias a verificar y sus resultados (Marque con una X y complemente):</div>
                                            <div class="brd" style="display: flex; align-items: center;">
                                                <div class="text-center text-upper" style="width: 30%">Requisito fitosanitario a verificar</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%">
                                                    <div class="text-upper brd-b">Cumple</div>
                                                    <div style="display: flex;">
                                                        <div style="width: 25%;">SI</div>
                                                        <div class="brd-l brd-r" style="width: 25%;">NO</div>
                                                        <div class="brd-r" style="width: 25%;">N/A</div>
                                                        <div style="width: 25%;">%</div>
                                                    </div>
                                                </div>
                                                <div class="text-center text-upper" style="width: 40%">Observaciones</div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Toma de muestra</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="TomaMuestra" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="TomaMuestra" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="TomaMuestra" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantMuestra" type="text" name="CantMuestra" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionMuestra" type="text" name="ObservacionMuestra" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Plagas de importancia cuarentenaria</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="PlagaCuarentena" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="PlagaCuarentena" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="PlagaCuarentena" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantPlagaCuarentena" type="text" name="CantPlagaCuarentena" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionPlagaCuarentena" type="text" name="ObservacionPlagaCuarentena" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Plagas de importancia económica</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="PlagaEconomica" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="PlagaEconomica" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="PlagaEconomica" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantPlagaEconomica" type="text" name="CantPlagaEconomica" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionPlagaEconomica" type="text" name="ObservacionPlagaEconomica" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Tratamiento cuarentenario</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Tratamiento" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Tratamiento" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Tratamiento" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantTratamiento" type="text" name="CantTratamiento" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionTratamiento" type="text" name="ObservacionTratamiento" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Residuos vegetales</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="ResiduosVegetales" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="ResiduosVegetales" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="ResiduosVegetales" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantResiduosVegetales" type="text" name="CantResiduosVegetales" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionResiduos" type="text" name="ObservacionResiduos" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Suelo</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Suelo" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Suelo" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Suelo" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantSuelo" type="text" name="CantSuelo" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionSuelo" type="text" name="ObservacionSuelo" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Lavado</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Lavado" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Lavado" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Lavado" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantLavado" type="text" name="CantLavado" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionLavado" type="text" name="ObservacionLavado" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Cepillado</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Cepillado" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Cepillado" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Cepillado" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantCepillado" type="text" name="CantCepillado" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionCepillado" type="text" name="ObservacionCepillado" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Empaque nuevo</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="EmpaqueNvo" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="EmpaqueNvo" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="EmpaqueNvo" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantEmpaqueNvo" type="text" name="CantEmpaqueNvo" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionEmpaque" type="text" name="ObservacionEmpaque" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Etiquetas Fitosanitarias</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="EtiquetaFito" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="EtiquetaFito" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="EtiquetaFito" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantEtiquetaFito" type="text" name="CantEtiquetaFito" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionEtiqueta" type="text" name="ObservacionEtiqueta" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Diagnostico Fitosanitario</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Diagnostico" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Diagnostico" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Diagnostico" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantDiagnostico" type="text" name="CantDiagnostico" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionDiagnostico" type="text" name="ObservacionDiagnostico" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Materia extraña no sujeta a regulación</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="MateriaExt" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="MateriaExt" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="MateriaExt" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantMateriaExt" type="text" name="CantMateriaExt" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex;">
                                                    <input id="ObservacionMateriaExt" type="text" name="ObservacionMateriaExt" value="" maxlength="500" style="flex-grow: 1;">
                                                </div>
                                            </div>
                                            <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                                <div class="pd-sm" style="width: 30%;">Otra:</div>
                                                <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                                    <div class="pd-sm" style="width: 25%;">(<input type="radio" name="Otra" value="0">)</div>
                                                    <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="Otra" value="1">)</div>
                                                    <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="Otra" value="2">)</div>
                                                    <div class="pd-sm" style="width: 25%; display: flex;">
                                                        <input id="CantOtra" type="text" name="CantOtra" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="pd-sm" style="width: 40%; display: flex; flex-wrap: wrap;">
                                                    <div>Fecha de inspección: <span class="disabled-input m-b-xs" style="width: 150px;">XX/XX/XXXX</span></div>
                                                    <input id="ObservacionOtra" type="text" name="ObservacionOtra" value="" maxlength="500" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div class="text-bold">9 ¿El transporte para la movilización del Lote de producto (s) presenta o se encuentra? (Marque con una X y complemente):</div>
                                            <div style="display: flex; align-items: center;">
                                                <div class="group-control" style="width: 20%;">(<input id="IsResiduosVegetales" type="checkbox" name="IsResiduosVegetales" value="">) Sin residuos vegetales</div>
                                                <div class="group-control" style="width: 20%;">(<input id="IsResiduosSuelo" type="checkbox" name="IsResiduosSuelo" value="">) Sin residuos de suelo</div>
                                                <div class="group-control" style="width: 15%;">(<input id="IsLavado" type="checkbox" name="IsLavado" value="">) Lavado</div>
                                                <div class="group-control" style="width: 45%;">(<input id="IsLimpioCompletamente" type="checkbox" name="IsLimpioCompletamente" value="">) Limpio completamente</div>
                                            </div>
                                            <div style="display: flex; align-items: center;">
                                                <div class="group-control" style="width: 20%;">(<input id="IsRefrigerado" type="checkbox" name="IsRefrigerado" value="">) Refrigerado</div>
                                                <div class="group-control" style="width: 20%;">(<input id="IsEnlonado" type="checkbox" name="IsEnlonado" value="">) Enlonado</div>
                                                <div class="group-control" style="width: 15%;">(<input id="IsCajasSeca" type="checkbox" name="IsCajasSeca" value="">) Caja seca</div>
                                                <div class="group-control" style="width: 45%;">
                                                    (<input id="IsOtro11" type="checkbox" name="IsOtro11" value="">) Otro(especifique):
                                                    <input id="DetalleOtro11" type="text" name="DetalleOtro11" value="" maxlength="500" style="flex-grow: 1; margin-left: 8px;">
                                                </div>
                                            </div>
                                            <div class="m-t-md">
                                                <input id="LeyendaC" class="text-center" type="text" name="LeyendaC" value="C) DICTAMEN DE VERIFICACIÓN (PARA SER LLENADO POR EL TEF)" maxlength="300" style="width: 100%;">
                                                <div class="m-t-xs" style="font-size: 14px;">
                                                    De conformidad con la comprobación documental, la constatación ocular o comprobación mediante muestreo o análisis de laboratorio de prueba, se dictamina que el Lote de producto(s):
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <span class="text-bold">10 No requiere Certificado Fitosanitario por movilizarse en una zona bajo un mismo estatus fitosanitario por tratarse de un producto no regulado.</span>
                                            (<input id="IsReqCFI" type="checkbox" name="IsReqCFI" value="1">)
                                        </div>
                                        <div class="section">
                                            <div class="text-bold m-b-xs">
                                                11 Si Cumple (<input type="radio" name="IsCumple" value="1" checked="checked">) No cumple (<input type="radio" name="IsCumple" value="0">) con la normatividad,  requisitos aplicables y/o condición fitosanitaria evaluada.
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width: 100px;">Por lo que:</div>
                                                <div style="flex-grow: 1;">
                                                    <div style="display: flex;">
                                                        <div style="width: 25%;">(<input id="IsExpedirCFMN" type="checkbox" name="IsExpedirCFMN" value="">) Debe expedirse el CFMN</div>
                                                        <div style="width: 15%;">(<input id="IsCFMNFleje" type="checkbox" name="IsCFMNFleje" value="">) Aplica Fleje</div>
                                                        <div style="width: 35%; display: flex; padding-right: 16px;">Anote folios: <span class="disabled-input" style="flex-grow: 1; margin-left: 8px;">XXXXXXXXXXXXXXXXXXXXXX</span></div>
                                                        <div style="width: 25%;">(<input id="NoExpedirCFMN" type="checkbox" name="NoExpedirCFMN" value="">) No debe expedirse el CFMN</div>
                                                    </div>
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <div style="width: 25%;">(<input id="IsExpedirCFI" type="checkbox" name="IsExpedirCFI" value="">) Debe expedirse el CFI</div>
                                                        <div style="width: 15%;">(<input id="IsCFIFleje" type="checkbox" name="IsCFIFleje" value="">) Aplica Fleje</div>
                                                        <div style="width: 35%; display: flex; padding-right: 16px;">Anote folios: <span class="disabled-input" style="flex-grow: 1; margin-left: 8px;">XXXXXXXXXXXXXXXXXXXXXX</span></div>
                                                        <div style="width: 25%;">(<input id="NoExpedirCFI" type="checkbox" name="NoExpedirCFI" value="">) No debe expedirse el CFI</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section">
                                            <div style="display: flex; align-items: center;">
                                                <div class="text-bold" style="width: 100px;">12 Fin:</div>
                                                <div class="group-control" style="flex-grow: 1;">Lugar: <span class="disabled-input m-l-sm">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span></div>
                                                <div class="group-control m-l-md" style="width: 250px;">Fecha: <span class="disabled-input m-l-sm">XX/XX/XXXX</span></div>
                                                <div class="group-control m-l-md" style="width: 175px;">Hora: <span class="disabled-input m-l-sm">XX:XX x.x.</span></div>
                                            </div>
                                            <div class="m-t-sm text-center" style="display: flex;">
                                                <div style="width: 50%; padding-right: 16px;">
                                                    <h4 class="text-upper m-b-md">Solicitante</h4>
                                                    <span class="disabled-input" style="width: 80%;">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                                </div>
                                                <div style="width: 50%;">
                                                    <h4 class="text-upper m-b-md">OFA / UV / TEF</h4>
                                                    <span class="disabled-input" style="width: 80%;">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                                    <div class="m-t-xs">Nombre y Firma</div>
                                                </div>
                                            </div>
                                            <div class="m-t-md" style="display: flex; justify-content: flex-end;">
                                                <div class="m-r-sm">
                                                    Clave de aprobación:
                                                    <input id="CedulaAprobacion" type="text" name="CedulaAprobacion" value="" maxlength="50">
                                                </div>
                                                <div>
                                                    Vigencia:
                                                    <input id="Vigencia" type="text" name="Vigencia" value="" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section" style="font-size: 11px;">
                                            Cualquier declaración con falsedad que se manifieste en este dictamen de verificación, será sancionado conforme lo marca el título cuarto del Decreto por el que se reforma, adiciona y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal; el capítulo III del título cuarto de la Ley Federal de Sanidad Vegetal, sin perjuicio de las penas que correspondan cuando sean constitutivas de delito. Este dictamen de verificación es obligatorio para la expedición del Certificado Fitosanitario y formará parte del expediente del trámite correspondiente. Ningún Oficial Fitosanitario Autorizado, Unidad de Verificación, Tercero Especialista Fitosanitario, Persona Moral o Física y Organismo de Certificación deberán emitir certificados fitosanitarios sin el dictamen de verificación respectivo.
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/plantilla_rpv.js')}}" type="module"></script>
@endsection
