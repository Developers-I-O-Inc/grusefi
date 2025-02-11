@props(['embarque' => false, 'vigencias' => $vigencias, 'puertos' => []])
<style>
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
<div class="rounded" id="kt_block_ui_1_target">
    <table class="dxflGroup_Moderno dxflGroupSys dxflAGSys" style="border-collapse:separate;">
        <tbody>
            <tr>
                <td id="ContentPlaceHolder1_ASPxFormLayout1_3_0" class="dxflHALSys dxflGroupCell_Moderno dxflChildInFirstRowSys dxflFirstChildInRowSys dxflLastChildInRowSys dxflLastChildSys dxflChildInLastRowSys">
                    <div class="dxflNestedControlCell_Moderno dxflCLLSys dxflItemSys dxflTextItemSys dxflItem_Moderno">
                        <div id="template-container" class="watermark ">
                            <div class="section template-header">
                                <img class="logo-SNSICA" src="{{asset('img/SNSICA.png')}}" alt="Logo">
                                <h2 class="title">Dictamen de verificación (DV) <br> para la movilización de productos vegetales</h2>
                                <div class="logo-unidad-verificacion">
                                    <img src="{{asset('img/logo.png')}}" alt="Logo Unidad de Verificación">
                                </div>
                            </div>
                            <div class="section template-subheader">
                                <div class="text-right m-b-xs">
                                    <span class="text-bold">Folio: </span>
                                    <input id="FolioRPV" type="text" name="FolioRPV" value="XXXXXXXXXXXXXXXX" maxlength="250" style="width: 250px;" readonly>
                                </div>
                                <h4 class="text-upper text-center"><span class="text-bold">A) Orden de servicio</span> (Para ser llenado por el cliente o usuario)</h4>
                            </div>
                            <div class="section">
                                <div style="display: flex; align-items: center;">
                                    <div class="text-bold" style="width: 100px;">1 Inicio:</div>
                                    <div class="group-control" style="flex-grow: 1;">Lugar: <span class="disabled-input m-l-sm">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span></div>
                                    <div class="group-control m-l-md" style="width: 250px;">Fecha: <span class="disabled-input m-l-sm" id="fecha_embarque">XX/XX/XXXX</span></div>
                                    <div class="group-control m-l-md" style="width: 175px;">Hora: <span class="disabled-input m-l-sm" id="hora_embarque">XX:XX x.x.</span></div>
                                </div>
                            </div>
                            <div class="section">
                                <div class="text-bold">2 Servicio solicitado:</div>
                                <div style="display: flex; align-items: center;">
                                    <div class="group-control" style="flex-grow: 1;">Dictamen de verificación: (<input id="ss_dictamen_verificacion" class="p_input" type="checkbox" name="ss_dictamen_verificacion" value="Prueba">)</div>
                                    <div class="group-control" style="flex-grow: 1;">Certificado fitosanitario para la movilización nacional: (<input id="ss_certificado_movilizacion" type="checkbox" class="p_input" name="ss_certificado_movilizacion" value="">)</div>
                                    <div class="group-control" style="flex-grow: 1;">Certificado fitosanitario internacional: (<input id="ss_certificado_internacional" type="checkbox" class="p_input" name="ss_certificado_internacional" value="">)</div>
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
                                        @if($embarque)
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="nombre_fiscal"></span>
                                            </div>
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="domicilio_empaque"></span>
                                            </div>
                                        @else
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                            </div>
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="width: 50%;">
                                        Nombre y dirección del destinatario:
                                        @if($embarque)
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="destinatario"></span>
                                            </div>
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="destinatario_domicilio"></span>
                                            </div>
                                        @else
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                            </div>
                                            <div class="m-t-xs" style="display: flex;">
                                                <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 50%; padding-right: 16px;">
                                        <div class="m-t-xs" style="display: flex;">
                                            <div style="width: 30%; padding-right: 16px; text-align: center;">
                                                <div>Productos</div>
                                                @if($embarque)
                                                    <button type="button" class="btn btn-icon btn-light-success pulse pulse-success" data-embarque="0" id="btn_products" >
                                                        <span class="svg-icon svg-icon-1"><i class="ki-outline ki-exit-right-corner fs-2"></i></span>
                                                        <span class="pulse-ring w-45px h-45px"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-light-success pulse pulse-success" data-embarque="0" id="btn_import" >
                                                        <span class="svg-icon svg-icon-1"><i class="ki-outline ki-file-up fs-2"></i></span>
                                                        <span class="pulse-ring w-45px h-45px"></span>
                                                    </button>
                                                @else
                                                    <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                                @endif
                                            </div>
                                            <div style="width: 40%; padding-right: 6px;">
                                                <div>Uso</div>
                                                <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                            </div>
                                            <div style="width: 30%;">
                                                Cantidad
                                                <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 50%; padding-right: 16px; text-align: center;" >
                                        <div class="m-t-xs" style="display: flex;">
                                            <div style="width: 70%; padding-right: 16px;">
                                                <div>Presentación</div>
                                                <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                            </div>
                                            <div style="width: 30%;">
                                                <div>Marcas distintivas</div>
                                                <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 50%; padding-right: 16px;">
                                        <div class="m-t-xs" style="display: flex;">
                                            <div style="width: 50%; padding-right: 16px;">
                                                <div>Puerto de entrada</div>
                                                @if($embarque)
                                                    <div class="m-t-xs" style="display: flex;">
                                                        {{-- <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="puerto"></span> --}}
                                                        <select id="puerto_id" name="puerto_id" class="form-select" data-control="select2" data-placeholder="Selecciona un puerto" data-allow-clear="true">
                                                            <option value=""></option>
                                                            @if(isset($puertos))
                                                                @foreach($puertos as $puerto)
                                                                    <option value="{{$puerto->id}}">{{$puerto->nombre}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                @else
                                                <div class="m-t-xs" style="display: flex;">
                                                    <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div style="width: 50%;">
                                                Medio de transporte y placas
                                                @if($embarque)
                                                    <div class="m-t-xs" style="display: flex;">
                                                        <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="transporte"></span>
                                                    </div>
                                                @else
                                                <div class="m-t-xs" style="display: flex;">
                                                    <span class="disabled-input m-b-xs">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                                </div>
                                                @endif
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
                                    <input id="LeyendaB" class="text-center" type="text" name="LeyendaB" disabled value="B) LISTA DE VERIFICACIÓN(PARA SER LLENADO POR EL OFA O TEF)" maxlength="200" style="width: 100%;">
                                    <div class="m-t-xs" style="font-size: 11px;">
                                        De conformidad con los artículos 68, 71, 84, 85, 91, 92, 94, 100, 101 de la Ley Federal sobre Metrología y Normalización;  97, 99, 100, 101 y 102 del Reglamento de la Ley Federal sobre Metrología y Normalización; 7 fracción XVIII, 13, 15, 22 fracción II, 27, 28, 35, 50 fracciones I, VII, 51, 53, 54, 55, 57 del Decreto por el que se reforman, adicionan y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal;  7, fracciones XIII y XIX, 22 fracciones I y III, 52, 56 de la Ley Federal de Sanidad Vegetal; Normas Oficiales Mexicanas, requisitos fitosanitarios del país importador y demás disposiciones legales aplicables, se realiza la verificación fitosanitaria del producto, lote o embarque.
                                    </div>
                                </div>
                            </div>
                            <div class="section" style="display: flex; align-items: center;">
                                <span class="text-bold m-r-sm">4 Indique la regulación o requisito que se evaluará:</span>
                                @if($embarque)
                                    <button type="button" class="btn btn-icon btn-light-success pulse pulse-success" id="btn_standards" data-embarque="0">
                                        <span class="svg-icon svg-icon-1"><i class="ki-outline ki-exit-right-corner fs-2"></i></span>
                                        <span class="pulse-ring w-45px h-45px"></span>
                                    </button>
                                @else
                                    <div class="disabled-input" style="margin-top:18px">XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                                @endif
                            </div>
                            <div class="section">
                                <div class="text-bold">5 De acuerdo al servicio solicitado y a la regulación o requisito que aplica, marque con una “X” los documentos que son requeridos para iniciar el proceso de verificación:</div>
                                <div style="display: flex; flex-wrap: wrap; align-items: center;">
                                    <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                        <span style="width: 250px;">(<input id="dr_certificado_movilizacion" type="checkbox" name="dr_certificado_movilizacion" value="" class="p_input">) Certificado Fitosanitario para la Movilización Nacional</span>
                                        <input id="dr_certificado_movilizacion_t" type="text" name="dr_certificado_movilizacion_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_certificado_cumplimiento" type="checkbox" name="dr_certificado_cumplimiento" value="" class="p_input">) Certificado Fitosanitario de cumplimiento de Norma</span>
                                        <input id="dr_certificado_cumplimiento_t" type="text" name="dr_certificado_cumplimiento_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                        <span style="width: 250px;">(<input id="dr_cartilla_fitosanitaria" type="checkbox" name="dr_cartilla_fitosanitaria" value="" class="p_input">) Cartilla Fitosanitaria</span>
                                        <input id="dr_cartilla_fitosanitaria_t" type="text" name="dr_cartilla_fitosanitaria_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_tarjeta_moscas" type="checkbox" name="dr_tarjeta_moscas" value="" class="p_input">) Tarjeta de Manejo Integrado de Moscas de la Fruta</span>
                                        <input id="dr_tarjeta_moscas_t" type="text" name="dr_tarjeta_moscas_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                        <span style="width: 250px;">(<input id="dr_copiacfmn" type="checkbox" name="dr_copiacfmn" value="" class="p_input">) Copia del CFMN expedido en el origen</span>
                                        <input id="dr_copiacfmn_t" type="text" name="dr_copiacfmn_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_copia_certificado" type="checkbox" name="dr_copia_certificado" value="" class="p_input">) Copia de Certificado Fitosanitario de Importación</span>
                                        <input id="dr_copia_certificado_t" type="text" name="dr_copia_certificado_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                        <span style="width: 250px;">(<input id="dr_diagnostico_fitosanitario" type="checkbox" name="dr_diagnostico_fitosanitario" value="" class="p_input">) Diagnóstico Fitosanitario</span>
                                        <input id="dr_diagnostico_fitosanitario_t" type="text" name="dr_diagnostico_fitosanitario_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_certificado_htlmf" type="checkbox" name="dr_certificado_htlmf" value="" class="p_input">) Certificado de HTLMF</span>
                                        <input id="dr_certificado_htlmf_t" type="text" name="dr_certificado_htlmf_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%; padding-right: 16px;">
                                        <span style="width: 250px;">(<input id="dr_tvaluacion_conformidad" type="checkbox" name="dr_tvaluacion_conformidad" value="" class="p_input">) Dictamen de Evaluación de la Conformidad</span>
                                        <input id="dr_tvaluacion_conformidad_t" type="text" name="dr_tvaluacion_conformidad_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_tratamiento_cuarentenario" type="checkbox" name="dr_tratamiento_cuarentenario" value="" class="p_input">) Certificado Fitosanitario de Tratamiento Cuarentenario</span>
                                        <input id="dr_tratamiento_cuarentenario_t" type="text" name="dr_tratamiento_cuarentenario_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div style="width: 50%; padding-right: 16px;">(<input id="dr_ninguno" type="checkbox" name="dr_ninguno" value="" class="p_input">) Ningún documento</div>
                                    <div class="m-b-xs" style="display: flex; width: 50%;">
                                        <span style="width: 250px;">(<input id="dr_aviso" type="checkbox" name="dr_aviso" value="" class="p_input">) Aviso de inicio de funcionamiento (Anotar # de Registro de Huerto o instalación)</span>
                                        <input id="dr_aviso_t" type="text" name="dr_aviso_t" value="" maxlength="150" style="flex-grow: 1;" class="p_input">
                                    </div>
                                    <div style="width: 100%;">
                                        <div style="display: flex;">
                                            <span class="m-r-sm">(<input id="dr_otro" type="checkbox" name="dr_otro" value="" class="p_input">) Otro(especifique):</span>
                                            <input id="dr_otro_t" type="text" name="dr_otro_t" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <div>
                                    <span class="text-bold">6 ¿El producto, lote o instalación se encuentra identificado, acondicionado y preparado para realizar la verificación?</span>
                                    Si (<input type="radio" name="pv" value="1" checked="checked" class="p_input">) No (<input type="radio" name="pv" value="0" class="p_input">).
                                </div>
                                <p>Si su respuesta es No, cancele la verificación hasta que sea requerido nuevamente, de lo contrario continúe con el siguiente apartado.</p>
                            </div>
                            <div class="section">
                                <div class="text-bold">7 De acuerdo con la regulación o requisito que aplica. ¿El tipo de verificación que se requiere es?</div>
                                <div style="display: flex; align-items: center;">
                                    <div class="" style="flex-grow: 1;">(<input id="tv_constatacion_ocular" type="checkbox" name="tv_constatacion_ocular" value="" class="p_input">) Constatación ocular</div>
                                    <div class="m-l-md" style="flex-grow: 1;">(<input id="tv_diagnostico_fitosanitario" type="checkbox" name="tv_diagnostico_fitosanitario" value="" class="p_input">) Diagnostico fitosanitario</div>
                                    <div class="m-l-md" style="flex-grow: 1;">(<input id="tv_muestreo_sitio" type="checkbox" name="tv_muestreo_sitio" value="" class="p_input">) Muestreo en sitio</div>
                                    <div class="m-l-md" style="flex-grow: 1;">
                                        (<input id="tv_otro" type="checkbox" name="tv_otro" value="" class="p_input">) Otro(especifique):
                                        <input id="tv_otro_t" type="text" name="tv_otro_t" value="" maxlength="150" style="width: 350px; margin-left: 8px;" class="p_input">
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
                                            <div style="width: 25%;">% O CANTIDAD</div>
                                        </div>
                                    </div>
                                    <div class="text-center text-upper" style="width: 40%">Observaciones</div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Toma de muestra</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_toma_muestra" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_toma_muestra" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_toma_muestra" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_toma_muestra_p" type="text" name="cf_c_toma_muestra_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_toma_muestra_o" type="text" name="cf_c_toma_muestra_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Plagas de importancia cuarentenaria</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_plagas_cuarentenaria" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_plagas_cuarentenaria" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_plagas_cuarentenaria" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_plagas_cuarentenaria_p" type="text" name="cf_c_plagas_cuarentenaria_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_plagas_cuarentenaria_o" type="text" name="cf_c_plagas_cuarentenaria_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Plagas de importancia económica</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_plagas_economica" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_plagas_economica" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_plagas_economica" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_plagas_economica_p" type="text" name="cf_c_plagas_economica_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_plagas_economica_o" type="text" name="cf_c_plagas_economica_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Tratamiento cuarentenario</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_tratamiento_cuarentenario" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_tratamiento_cuarentenario" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_tratamiento_cuarentenario" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_tratamiento_cuarentenario_p" type="text" name="cf_c_tratamiento_cuarentenario_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_tratamiento_cuarentenario_o" type="text" name="cf_c_tratamiento_cuarentenario_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Residuos vegetales</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_residuos_vegetales" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_residuos_vegetales" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_residuos_vegetales" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_residuos_vegetales_p" type="text" name="cf_c_residuos_vegetales_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_residuos_vegetales_o" type="text" name="cf_c_residuos_vegetales_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Suelo</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_suelo" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_suelo" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_suelo" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_suelo_p" type="text" name="cf_c_suelo_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_suelo_o" type="text" name="cf_c_suelo_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Lavado</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_lavado" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_lavado" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_lavado" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_lavado_p" type="text" name="cf_c_lavado_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_lavado_o" type="text" name="cf_c_lavado_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Cepillado</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_cepillado" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_cepillado" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_cepillado" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_cepillado_p" type="text" name="cf_c_cepillado_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_cepillado_o" type="text" name="cf_c_cepillado_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Empaque nuevo</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_empaque_nuevo" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_empaque_nuevo" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_empaque_nuevo" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_empaque_nuevo_p" type="text" name="cf_c_empaque_nuevo_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_empaque_nuevo_o" type="text" name="cf_c_empaque_nuevo_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Etiquetas Fitosanitarias</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_etiquetas_fitosanitarias" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_etiquetas_fitosanitarias" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_etiquetas_fitosanitarias" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_etiquetas_fitosanitarias_p" type="text" name="cf_c_etiquetas_fitosanitarias_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_etiquetas_fitosanitarias_o" type="text" name="cf_c_etiquetas_fitosanitarias_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Diagnostico Fitosanitario</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_diagnostico_fitosanitario" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_diagnostico_fitosanitario" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_diagnostico_fitosanitario" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_diagnostico_fitosanitario_p" type="text" name="cf_c_diagnostico_fitosanitario_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_diagnostico_fitosanitario_o" type="text" name="cf_c_diagnostico_fitosanitario_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Materia extraña no sujeta a regulación</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_materia_regulacion" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_materia_regulacion" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_materia_regulacion" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_materia_regulacion_p" type="text" name="cf_c_materia_regulacion_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex;">
                                        <input id="cf_c_materia_regulacion_o" type="text" name="cf_c_materia_regulacion_o" value="" maxlength="500" style="flex-grow: 1;" class="p_input">
                                    </div>
                                </div>
                                <div class="brd-l brd-r brd-b" style="display: flex; align-items: center;">
                                    <div class="pd-sm" style="width: 30%;">Otra:</div>
                                    <div class="text-center brd-l brd-r" style="width: 30%; display: flex;">
                                        <div class="pd-sm" style="width: 25%;">(<input type="radio" name="cf_c_otra" value="0" class="p_input">)</div>
                                        <div class="pd-sm brd-l brd-r" style="width: 25%;">(<input type="radio" name="cf_c_otra" value="1" class="p_input">)</div>
                                        <div class="pd-sm brd-r" style="width: 25%;">(<input type="radio" name="cf_c_otra" value="2" class="p_input">)</div>
                                        <div class="pd-sm" style="width: 25%; display: flex;">
                                            <input id="cf_c_otra_p" type="text" name="cf_c_otra_p" value="" maxlength="50" style="flex-grow: 1; max-width: 100%;" class="p_input">
                                        </div>
                                    </div>
                                    <div class="pd-sm" style="width: 40%; display: flex; flex-wrap: wrap;">
                                        <input id="cf_c_otra_o" type="text" name="cf_c_otra_o" value="" maxlength="500" style="width: 100%;" class="p_input">
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <div class="text-bold">9 ¿El transporte para la movilización del Lote de producto (s) presenta o se encuentra? (Marque con una X y complemente):</div>
                                <div style="display: flex; align-items: center;">
                                    <div class="group-control" style="width: 20%;">(<input class="p_input" id="tm_residuos_vegetales" type="checkbox" name="tm_residuos_vegetales" value="">) Sin residuos vegetales</div>
                                    <div class="group-control" style="width: 20%;">(<input class="p_input" id="tm_sn_residuos_vegetales" type="checkbox" name="tm_sn_residuos_vegetales" value="">) Sin residuos de suelo</div>
                                    <div class="group-control" style="width: 15%;">(<input class="p_input" id="tm_lavado" type="checkbox" name="tm_lavado" value="">) Lavado</div>
                                    <div class="group-control" style="width: 45%;">(<input class="p_input" id="tm_limpio" type="checkbox" name="tm_limpio" value="">) Limpio completamente</div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div class="group-control" style="width: 20%;">(<input class="p_input" id="tm_refrigerado" type="checkbox" name="tm_refrigerado" value="">) Refrigerado</div>
                                    <div class="group-control" style="width: 20%;">(<input class="p_input" id="tm_enlonado" type="checkbox" name="tm_enlonado" value="">) Enlonado</div>
                                    <div class="group-control" style="width: 15%;">(<input class="p_input" id="tm_caja_seca" type="checkbox" name="tm_caja_seca" value="">) Caja seca</div>
                                    <div class="group-control" style="width: 45%;">
                                        (<input id="tm_otro" type="checkbox" name="tm_otro" value="" class="p_input">) Otro(especifique):
                                        <input id="tm_otro_t" type="text" name="tm_otro_t" value="" maxlength="500" style="flex-grow: 1; margin-left: 8px;" class="p_input">
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
                                (<input id="no_requiere_certificado" type="checkbox" name="no_requiere_certificado" value="1" class="p_input">)
                            </div>
                            <div class="section">
                                <div class="text-bold m-b-xs">
                                    11 Si Cumple (<input type="radio" name="cfe_si_cumple" value="1" checked="checked" class="p_input">) No cumple (<input type="radio" name="cfe_si_cumple" value="0" class="p_input">) con la normatividad,  requisitos aplicables y/o condición fitosanitaria evaluada.
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 100px;">Por lo que:</div>
                                    <div style="flex-grow: 1;">
                                        <div style="display: flex;">
                                            <div style="width: 25%;">(<input id="cfe_debe_CFMN" type="checkbox" name="cfe_debe_CFMN" value="" class="p_input">) Debe expedirse el CFMN</div>
                                            <div style="width: 15%;">(<input id="cfe_aplica_flete_CFMN" type="checkbox" name="cfe_aplica_flete_CFMN" value="" class="p_input">) Aplica Fleje</div>
                                            <div style="width: 35%; display: flex; padding-right: 16px;">Anote folios:
                                                <input id="cfe_folios_CFMN" type="text" name="cfe_folios_CFMN" maxlength="50" class="p_input">
                                            </div>
                                            <div style="width: 25%;">(<input id="cfe_no_debe_CFMN" type="checkbox" name="cfe_no_debe_CFMN" value="" class="p_input">) No debe expedirse el CFMN</div>
                                        </div>
                                        <div class="m-t-xs" style="display: flex;">
                                            <div style="width: 25%;">(<input id="cfe_debe_CFI" type="checkbox" name="cfe_debe_CFI" value="" class="p_input">) Debe expedirse el CFI</div>
                                            <div style="width: 15%;">(<input id="cfe_aplica_flete_CFI" type="checkbox" name="cfe_aplica_flete_CFI" value="" class="p_input">) Aplica Fleje</div>
                                            <div style="width: 35%; display: flex; padding-right: 16px;">Anote folios:
                                                <input id="cfe_folios_CFI" type="text" name="cfe_folios_CFI" maxlength="50" class="p_input">
                                            </div>
                                            <div style="width: 25%;">(<input id="cfe_no_debe_CFI" type="checkbox" name="cfe_no_debe_CFI" value="" class="p_input">) No debe expedirse el CFI</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <div style="display: flex; align-items: center;">
                                    <div class="text-bold" style="width: 100px;">12 Fin:</div>
                                    <div class="group-control" style="flex-grow: 1;">Lugar:
                                        @if($embarque)
                                        <div class="m-t-xs" style="display: flex;">
                                            <span class="disabled-input m-b-xs" style="flex-grow: 1; border-bottom: 1px solid #BBB;" name="lugar"></span>
                                        </div>
                                        @else
                                        <span class="disabled-input m-l-sm" id=>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</span>
                                        @endif
                                    </div>
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
                                        <input id="clave_aprobacion" type="text" name="clave_aprobacion" value="{{$vigencias != null ? $vigencias[0]->clave_aprobacion : ''}}" maxlength="50" class="p_input">
                                    </div>
                                    <div>
                                        Vigencia:
                                        <input id="vigencia" type="text" name="vigencia" value="{{$vigencias != null ? $vigencias[0]->vigencia : ''}}" maxlength="50" class="p_input">
                                    </div>
                                </div>
                            </div>
                            <div class="section" style="font-size: 11px;">
                                Cualquier declaración con falsedad que se manifieste en este dictamen de verificación, será sancionado conforme lo standard el título cuarto del Decreto por el que se reforma, adiciona y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal; el capítulo III del título cuarto de la Ley Federal de Sanidad Vegetal, sin perjuicio de las penas que correspondan cuando sean constitutivas de delito. Este dictamen de verificación es obligatorio para la expedición del Certificado Fitosanitario y formará parte del expediente del trámite correspondiente.  Ningún Oficial Fitosanitario Autorizado, Unidad de Verificación, Tercero Especialista Fitosanitario, Persona Moral o Física y Organismo de Certificación deberán emitir certificados fitosanitarios sin el dictamen de verificación respectivo.
                                <br>
                                <br>
                                <b>NOTA</b> si se realizo verificación a productos que no requieren certificado fitosanitario para su movilización, el usuario y el verificador indican <i>“BAJO PROTESTA DE DECIR VERDAD QUE EN ESTE EMBARQUE NO SE OCULTAN PRODUCTOS REGULADOS O CUARENTENADOS Y POR NINGUN MOTIVO SE TRANSPORTAN PRODUCTOS ILICITOS”</i>
                            </div>
                            <div class="section" style="font-size: 11px;">
                                ORIGINAL: Archivo local o usuario  Copia: SADER
                                {{-- @if($embarque->pais_id == 1)
                                    Nota ingresada, no pertenece al formato original: "La UI opera como tipo A y declara tener la capacidad y competencia técnica de acuerdo a su acreditación UVFITO-004 y aprobación UV-240122-09-VCMREMN-001 para prestar los servicios de inspección y certificación, por lo que los trabajos realizados son de manera imparcial y en apego al código de ética de la empresa, además se le comunica al cliente que la información se maneja de forma confidencial y que los costos generados del servicio serán sufragados por este.
                                    UV-240122-09-VCMREMN-001 ES LA CLAVE DE APROBACIÓN PARA PRODUCTOS DE MOVILIZACIÓN NACIONAL.
                                @else
                                    Nota ingresada, no pertenece al formato original: "La UI opera como tipo A y declara tener la capacidad y competencia técnica de acuerdo a su acreditación UVFITO-004 y aprobación UV-240122-09-VMRE-001 para prestar los servicios de inspección y certificación, por lo que los trabajos realizados son de manera imparcial y en apego al código de ética de la empresa, además se le comunica al cliente que la información se maneja de forma confidencial y que los costos generados del servicio serán sufragados por este.
                                    UV-240122-09-VMRE-001 ES LA CLAVE DE APROBACIÓN PARA PRODUCTOS QUE VAN A HACER EXPORTADOS.
                                @endif --}}
                            </div>
                        </div>

                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

