<!DOCTYPE html>
<html>
<head>
    <title>Dictamen de Verificación</title>
    <style>
        .logo-unidad-verificacion {
            width: 64px;
            min-width: 64px;
            max-width: 64px;
            height: 64px;
            min-height: 64px;
            max-height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #template-container {
            background: #FFF;
            color: #333;
            padding: 16px;
        }

        .logo-SNSICA {
            width: 64px;
            min-width: 64px;
            max-width: 64px;
            height: 64px;
            min-height: 64px;
            max-height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .template-header .logo-unidad-verificacion {
            width: 64px;
            min-width: 64px;
            max-width: 64px;
            height: 64px;
            min-height: 64px;
            max-height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .template-header .logo-unidad-verificacion > img {
            max-width: 100%;
            max-height: 100%;
        }

        @page {
            margin: 10px; /* Puedes ajustar este valor según tus necesidades */
        }


        table{
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 0%;
            margin-bottom: 0;
        }
        .font-p{
            font-size: 7.2px;
            font-weight: bold;
            text-align: left;
        }
        .font-g-title{
            font-size: 7px;
            text-align: left;
            font-weight: bold;
        }
        .font-g{
            font-size: 7px;
            text-align: left
        }
        .font-mm{
            font-size: 6px;
            text-align: justify;
        }
        .font-mm_right{
            font-size: 6px;
            text-align: right;
        }
        .font-cc{
            font-size: 7px;
            text-align: center;
        }
        .font-rr{
            font-size: 7px;
            text-align: right;
        }
        /* table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        } */
        .prueba td{
            font-size: 7px;
            font-style: italic;
        }
        .encabezado_principal td{
            font-weight: bold;
        }
        .pregunta1{
            width: 7%;
        }
        .r_lugar{
            font-size: 7px;
            width: 8%;
            text-align: right;
        }
        .rr_lugar{
            width: auto;
        }
        .pregunta2{
            width: 14%;
        }
        .r_servicio{
            font-size: 7px;
            width: auto;
            text-align: center;
        }
        .r_otro{
            width: 12%;
        }
        .rr_otro{
            width: 88%;
        }
        .pregunta3{
            font-size: 7px;
        }
        .table_datos_expedicion{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table_datos_expedicion_1{
            border: 1px solid black;
            border-bottom: 0;
            border-collapse: collapse;
        }
        .tr_datos{
            border-right: 1px solid black;
            border-top: 0;
            border-bottom: 0;
            border-left: 0;
        }
        .td_datos_2{
            border-right: 1px solid black;
            border-top: 1px solid black;
            border-left: 0;
            font-size: 7px;
        }
        .td_datos_3{
            border-right: 1px solid black;
            border-left: 0;
            font-size: 7px;
        }
        .td_datos{
            width: 50%;
            font-size: 7px;
            text-align: left;
            border-right: 1px solid black;
            border-top: 0;
            border-bottom: 0;
            border-left: 0;
        }
        .td_incisos_left{
            width: 21%;
            padding: 0%;
        }
        .td_incisos_right{
            width: 29%;
            padding: 0%;
        }
        .td_tipo_verificacion{
            width: 16%;
        }
        .resultados{
            border-right: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
            border-collapse: collapse;
        }
        .resultados tr{
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .resultados td{
            border-right: 1px solid black;
            border-left: 1px solid black;
        }

    </style>
</head>

<body>
    <div id="template-container">
        <table>
            <tr class="encabezado_principal">
                <td rowspan="2" style="width: 8%;"><img class="logo-SNSICA" src="{{public_path('img/SNSICA.png')}}" alt="Logo"></td>
                <td colspan="2" style="text-align:center; border:1px;">Dictamen de verificación (DV)</td>

                <td rowspan="2" style="width: 8%; text-align:right"><img src="{{public_path('img/logo.png')}}" class="logo-unidad-verificacion" alt="Logo Unidad de Verificación"></td>
            </tr>
            <tr class="prueba">
                <td style="text-align:left;"><b>A) ORDEN DE SERVICIO</b> (PARA SER LLENADO POR EL CLIENTE O USUARIO)</td>
                <td style="text-align:center;"><b>FOLIO:</b> {{$embarque->folio_embarque}}</td>
            </tr>
        </table>
        <table class="table_1">
            <tr>
                <td class="pregunta1 font-p">1. INICIO:</td>
                <td class="r_lugar font-g">Lugar:</td>
                <td class="rr_lugar font-g">{{$embarque->lugar_inicial}}, MÉXICO </td>
                <td class="r_lugar font-g">Fecha:</td>
                <td class="rr_lugar font-g">{{substr($embarque->fecha_embarque, 0, 10)}}</td>
                <td class="r_lugar font-g">Hora:</td>
                <td class="rr_lugar font-g">{{substr($embarque->fecha_embarque, 11)}} Hrs</td>
            </tr>
        </table>
        <table class="table_2">
            <tr>
                <td class="pregunta2 font-p">2. Servicio Solicitado:</td>
                <td class="r_servicio font-g">Dictamen de Verificación ({{$plantilla->ss_dictamen_verificacion ? 'X' : ' '}}) </td>
                <td class="r_servicio font-g">Certificado Fitosanitario para la Movilización Nacional ({{$plantilla->ss_certificado_movilizacion ? 'X' : ' '}}) </td>
                <td class="r_servicio font-g">Certificado Fitosanitario Internacional ( {{$plantilla->ss_certificado_internacional ? 'X' : ' '}} )</td>
            </tr>
        </table>
        <table class="table_3">
            <tr>
                <td class="r_otro font-g">Otro (ESPECIFIQUE): </td>
                <td class="rr_otro font-g">{{$plantilla->ss_otro}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="pregunta3 font-p">3. Datos para expedición de certificado fitosanitario:</td>
            </tr>
        </table>
        <table class="table_datos_expedicion_1" style="width: 100%">
            <tr>
                <td class="td_datos font-g-title">Nombre y dirección del remitente</td>
                <td class="td_datos font-g-title">Nombre y dirección del destinatario</td>
            </tr>
            <tr>
                <td class="td_datos font-g">{{$embarque->nombre_fiscal}}</td>
                <td class="td_datos font-g">{{$embarque->destinatario}}</td>
            </tr>
            <tr>
                <td class="td_datos font-g">{{$embarque->domicilio_empaque}}</td>
                <td class="td_datos font-g">{{$domicilio_destinatario[0]->domicilio}}</td>
            </tr>
        </table>
        <table class="table_datos_expedicion" style="width: 100%">
            <tr class="tr_datos">
                <td class="td_datos_2 font-g-title">Producto</td>
                <td class="td_datos_2 font-g-title">Uso</td>
                <td class="td_datos_2 font-g-title">Cantidad</td>
                <td class="td_datos_2 font-g-title" style="width: 25%">Presentación</td>
                <td class="td_datos_2 font-g-title" style="width: 25%">Marcas Distintivas</td>
            </tr>
            <tr>
                <td class="td_datos_3 font-g">
                    @if($count_productos <= 6)
                        @foreach($embarques_productos as $producto)
                            <p style="margin: 0 0;">{{$producto->variedad}} <em>({{$producto->nombre_cientifico}})</em></p>
                        @endforeach
                    @else
                        <p style="margin: 0 0;">
                            {{$embarques_productos[0]->variedad}} <em>({{$embarques_productos[0]->nombre_cientifico}})</em>
                        </p>
                        <p style="margin: 0 0;">
                            {{$embarques_productos[1]->variedad}} <em>({{$embarques_productos[1]->nombre_cientifico}})</em>
                        </p>
                        <p style="margin: 0 0;">
                            {{$embarques_productos[2]->variedad}} <em>({{$embarques_productos[2]->nombre_cientifico}})</em>
                        </p>
                    @endif
                </td>
                <td class="td_datos_3 font-g">{{$embarque->uso}}</td>
                <td class="td_datos_3 font-g">
                    @if($count_productos <= 6)
                        @foreach($quantities as $cant)
                            @if ($cant->total_kilos >= 1000)+
                                <p style="margin: 0 0;">{{number_format($cant->total_kilos/1000, 2) . ' Toneladas'}}</p>
                            @else
                                <p style="margin: 0 0;">{{$cant->total_kilos . ' KG'}}</p>
                            @endif
                        @endforeach
                    @else
                        <p style="margin: 0 0;">
                            {{$quantities[0]->total_kilos >= 1000 ? number_format($quantities[0]->total_kilos/1000, 2) . ' Toneladas' : $quantities[0]->total_kilos . ' KG'}}<br>
                        </p>
                        <p style="margin: 0 0;">
                            {{$quantities[1]->total_kilos >= 1000 ? number_format($quantities[1]->total_kilos/1000, 2) . ' Toneladas' : $quantities[1]->total_kilos . ' KG'}}<br>
                        </p>
                        <p style="margin: 0 0;">
                            {{$quantities[2]->total_kilos >= 1000 ? number_format($quantities[2]->total_kilos/1000, 2) . ' Toneladas' : $quantities[2]->total_kilos . ' KG'}}<br>
                        </p>
                    @endif
                </td>
                <td class="td_datos_3 font-g">
                    @if($count_productos <= 6)
                        @foreach($presentations as $presentation)
                        <p style="margin: 0 0;">{{($presentation->cantidad_total).' '.($presentation->cantidad_total == 1 ? ($presentation->presentacion.' '.$presentation->peso.' KG') : $presentation->plural.' '.$presentation->peso.' KG')}}</p>
                        @endforeach
                    @else
                        <p style="margin: 0 0;">
                            {{($presentations[0]->cantidad_total).' '.($presentations[0]->cantidad_total == 1 ? $presentations[0]->presentacion : $presentations[0]->plural).' '.$presentations[0]->peso.' KG'}}<br>
                        </p>
                        <p style="margin: 0 0;">
                            {{($presentations[1]->cantidad_total).' '.($presentations[1]->cantidad_total == 1 ? $presentations[1]->presentacion : $presentations[1]->plural).' '.$presentations[1]->peso.' KG'}}<br>
                        </p>
                        <p style="margin: 0 0;">
                            {{($presentations[2]->cantidad_total).' '.($presentations[2]->cantidad_total == 1 ? $presentations[2]->presentacion : $presentations[2]->plural).' '.$presentations[2]->peso.' KG'}}<br>
                        </p>
                    @endif
                </td>
                <td class="td_datos_3 font-g">
                    @foreach($marcas as $marca)
                        {{$marca->nombre}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="2" class="font-g-title td_datos_2">Punto de entrada </td>
                <td class="font-g-title td_datos_2">Medio de transporte y placas</td>
                <td class="font-g-title td_datos_2">Origen</td>
                <td class="font-g-title td_datos_2">Procedencia</td>
            </tr>
            <tr>
                <td colspan="2" class="td_datos_3 font-g">{{$embarque->puerto}}</td>
                <td class="td_datos_3 font-g">{{$embarque->transporte}}</td>
                <td class="td_datos_3 font-g">ATENGUILLO, ZAPOTLÁN EL
                    GRANDE, CUAUTLA, MAZAMITLA,
                    TAMAZULA DE GORDIANO, JALISCO;
                    MÉXICO</td>
                <td class="td_datos_3 font-g">{{$procedencia[0]->procedencia}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p pregunta2">B) Lista de verificación</td>
                <td class="font-g">B) LISTA DE VERIFICACIÓN(PARA SER LLENADO POR EL OFA O TEF)</td>
            </tr>
        </table>
        <table class="table_datos_expedicion">
            <tr>
                <td class="font-mm">
                    De conformidad con los artículos 68, 71, 84, 85, 91, 92, 94, 100, 101 de la Ley Federal sobre Metrología y Normalización; 97, 99, 100, 101 y 102 del Reglamento de la Ley Federal sobre Metrología y Normalización; 7 fracción XVIII, 13, 15, 22
                    fracción II, 27, 28, 35, 50 fracciones I, VII, 51, 53, 54, 55, 57 del Decreto por el que se reforman, adicionan y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal; 7, fracciones XIII y XIX, 22 fracciones I y III, 52, 56 de la Ley
                    Federal de Sanidad Vegetal; Normas Oficiales Mexicanas, requisitos fitosanitarios del país importador y demás disposiciones legales aplicables, se realiza la verificación fitosanitaria del producto, lote o embarque.
                </td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td style="width: 30%;" class="font-p">4. Indique la regulación o requisito que evaluará:</td>
                <td style="width: 70%;" class="font-g">{{ $standards->map(function($standard) { return $standard->name . ', ' . $standard->observations; })->implode(', ') }}</td>

            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">5. De acuerdo al servicio solicitado y a la regulación o requisito que aplica, marque con una “X” los documentos que son requeridos para iniciar el proceso de verificación:</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-mm td_incisos_left"> ({{$plantilla->dr_certificado_movilizacion ? 'X' : ' '}}) Certificado Fitosanitario para la Movilización Nacional</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_certificado_movilizacion_t}}</td>
                <td class="font-mm td_incisos_right"> ({{$plantilla->dr_cartilla_fitosanitaria ? 'X' : ' '}}) Cartilla Fitosanitaria</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_cartilla_fitosanitaria_t}}</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ({{$plantilla->dr_copiacfmn ? 'X' : ' '}}) Copia del CFMN expedido en el origen</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_copiacfmn_t}}</td>
                <td class="font-mm td_incisos_right"> ({{$plantilla->dr_certificado_cumplimiento ? 'X' : ' '}}) Certificado de cumplimiento de Norma</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_certificado_cumplimiento_t}}</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left">({{$plantilla->dr_diagnostico_fitosanitario ? 'X' : ' '}}) Diagnóstico Fitosanitario</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_diagnostico_fitosanitario_t}}</td>
                <td class="font-mm td_incisos_right">({{$plantilla->dr_tarjeta_moscas ? 'X' : ' '}}) Tarjeta de Manejo Integrado de Moscas de la Fruta</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_tarjeta_moscas_t}}</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left">({{$plantilla->dr_tvaluacion_conformidad ? 'X' : ' '}}) Dictamen de Evaluación de la Conformidad</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_tvaluacion_conformidad_t}}</td>
                <td class="font-mm td_incisos_right">({{$plantilla->dr_copia_certificado ? 'X' : ' '}}) Copia de Certificado Fitosanitario de Importación</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_copia_certificado_t}}</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ({{$plantilla->dr_ninguno ? 'X' : ' '}}) Ningún Documento</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right"> ({{$plantilla->dr_tratamiento_cuarentenario ? 'X' : ' '}}) Certificado Fitosanitario de Tratamiento Cuarentenario</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_tratamiento_cuarentenario_t}}</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ({{$plantilla->dr_otro ? 'X' : ' '}}) Otro (especifique):</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_otro_t}}</td>
                <td class="font-mm td_incisos_right"> ({{$plantilla->dr_aviso ? 'X' : ' '}}) Aviso de inicio de funcionamiento (Anotar # registro del huerto o instalacion).</td>
                <td class="font-mm_right td_incisos">{{$plantilla->dr_aviso_t}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">6. ¿El producto o lote se encuentra identificado, acondicionado y preparado para realizar la verificación?: {{$plantilla->pv ? 'SI(X) NO( )' : 'SI( ) NO(X)'}}. Si su respuesta es No, cancele la verificación hasta que
                    sea requerido nuevamente, de lo contrario continúe con el siguiente apartado.</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">7. De acuerdo con la regulación o requisito que aplica. ¿El tipo de verificación que se requiere es?:</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-g td_tipo_verificacion"> ({{$plantilla->tv_constatacion_ocular ? 'X' : ' '}}) Constatación ocular</td>
                <td class="font-g td_tipo_verificacion"> ({{$plantilla->tv_diagnostico_fitosanitario ? 'X' : ' '}}) Diagnóstico Fitosanitario</td>
                <td class="font-g td_tipo_verificacion"> ({{$plantilla->tv_muestreo_sitio ? 'X' : ' '}}) Muestreo en sitio</td>
                <td class="font-g td_tipo_verificacion"> ({{$plantilla->tv_otro ? 'X' : ' '}}) Otro especifique:</td>
                <td class="font-g">{{$plantilla->tv_otro_t}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">8. De conformidad con el tipo de verificación, anote los requisitos fitosanitarios a verificar y sus resultados (Marque con una X y complemente)</td>
            </tr>
        </table>
        <table class="resultados">
            <tr >
                <td rowspan="2" class="font-p" style="text-align: center; width:20%">REQUISITO FITOSANITARIO A VERIFICAR </td>
                <td colspan="3" class="font-p" style="text-align: center; width:17%">CUMPLE</td>
                <td rowspan="2" class="font-p" style="text-align: center; width:8%">% O CANTIDAD </td>
                <td rowspan="2" class="font-p" style="text-align: center; width:65%">OBSERVACIONES</td>
            </tr>
            <tr>
                <td class="font-p" style="text-align: center;">SI</td>
                <td class="font-p" style="text-align: center;">NO</td>
                <td class="font-p" style="text-align: center;">N/A</td>
            </tr>
            <tr>
                <td class="font-g">Toma de Muestra</td>
                <td class="font-cc">{{$plantilla->cf_c_toma_muestra == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_toma_muestra == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_toma_muestra == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_toma_muestra_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_toma_muestra_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Plagas de importancia cuarentenaria</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_cuarentenaria == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_cuarentenaria == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_cuarentenaria == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_cuarentenaria_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_plagas_cuarentenaria_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Plagas de importancia económica</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_economica == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_economica == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_economica == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_plagas_economica_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_plagas_economica_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Tratamiento cuarentenario</td>
                <td class="font-cc">{{$plantilla->cf_c_tratamiento_cuarentenario == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_tratamiento_cuarentenario == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_tratamiento_cuarentenario == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_tratamiento_cuarentenario_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_tratamiento_cuarentenario_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Residuos vegetales</td>
                <td class="font-cc">{{$plantilla->cf_c_residuos_vegetales == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_residuos_vegetales == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_residuos_vegetales == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_residuos_vegetales_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_residuos_vegetales_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Suelo</td>
                <td class="font-cc">{{$plantilla->cf_c_suelo == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_suelo == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_suelo == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_suelo_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_suelo_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Lavado</td>
                <td class="font-cc">{{$plantilla->cf_c_lavado == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_lavado == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_lavado == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_lavado_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_lavado_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Cepillado</td>
                <td class="font-cc">{{$plantilla->cf_c_cepillado == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_cepillado == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_cepillado == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_cepillado_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_cepillado_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Empaque nuevo</td>
                <td class="font-cc">{{$plantilla->cf_c_empaque_nuevo == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_empaque_nuevo == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_empaque_nuevo == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_empaque_nuevo_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_empaque_nuevo_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Etiquetas fitosanitarias</td>
                <td class="font-cc">{{$plantilla->cf_c_etiquetas_fitosanitarias == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_etiquetas_fitosanitarias == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_etiquetas_fitosanitarias == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_etiquetas_fitosanitarias_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_etiquetas_fitosanitarias_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Diagnostico fitosanitario</td>
                <td class="font-cc">{{$plantilla->cf_c_diagnostico_fitosanitario == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_diagnostico_fitosanitario == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_diagnostico_fitosanitario == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_diagnostico_fitosanitario_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_diagnostico_fitosanitario_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Materia extraña no sujeta a regulación</td>
                <td class="font-cc">{{$plantilla->cf_c_materia_regulacion == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_materia_regulacion == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_materia_regulacion == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_materia_regulacion_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_materia_regulacion_o}}</td>
            </tr>
            <tr>
                <td class="font-g">Otra</td>
                <td class="font-cc">{{$plantilla->cf_c_otra == 0 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_otra == 1 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_otra == 2 ? 'X' : ' '}}</td>
                <td class="font-cc">{{$plantilla->cf_c_otra_p}}</td>
                <td class="font-g">{{$plantilla->cf_c_otra_o}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="4" class="pregunta3 font-p">9. El transporte para la movilización del Lote de producto (s) presenta o se encuentra? (Marque con una X y complemente): </td>
            </tr>
            <tr>
                <td class="font-g">({{$plantilla->tm_residuos_vegetales ? 'X' : ' '}}) Sin Residuos vegetales o de cosecha</td>
                <td class="font-g">({{$plantilla->tm_sn_residuos_vegetales ? 'X' : ' '}}) Sin residuos de suelo </td>
                <td class="font-g">({{$plantilla->tm_lavado ? 'X' : ' '}}) Lavado </td>
                <td class="font-g">({{$plantilla->tm_limpio ? 'X' : ' '}}) Limpio completamente</td>
            </tr>
            <tr>
                <td class="font-g">({{$plantilla->tm_refrigerado ? 'X' : ' '}}) Refrigerado</td>
                <td class="font-g">({{$plantilla->tm_enlonado ? 'X' : ' '}}) Enlonado</td>
                <td class="font-g">({{$plantilla->tm_caja_seca ? 'X' : ' '}}) Caja seca</td>
                <td class="font-g">({{$plantilla->tm_otro ? 'X' : ' '}}) Otro especifique:  {{$plantilla->tm_otro_t}}
                </td>
            </tr>
        </table>
        <table>
            <tr>
                {{-- <td class="font-p">C) DICTAMEN DE VERIFICACION</td> --}}
                <td colspan="2"  class="font-g" style="text-align: center;">C) DICTAMEN DE VERIFICACIÓN (PARA SER LLENADO POR EL TEF)</td>
            </tr>
            <tr>
                <td colspan="2" class="font-g">De conformidad con la comprobación documental, la constatación ocular o comprobación mediante muestreo o análisis de laboratorio de prueba, se dictamina que el Lote de
                    producto (s)</td>
            </tr>
            <tr>
                <td colspan="2" class="font-p">10. No requiere Certificado Fitosanitario por movilizarse en una zona bajo un mismo estatus fitosanitario o por tratarse de un producto no regulado ({{$plantilla->no_requiere_certificado ? 'X' : ' '}})
                </td>
            </tr>
            <tr>
                <td colspan="2" class="font-p">11. {{$plantilla->cfe_si_cumple ? 'Si cumple (X) No Cumple ( )' : 'Si Cumple ( ) No Cumple (X)'}} con la normatividad, requisitos aplicables y/o requisito fitosanitario evaluado.
                </td>
            </tr>
            <tr>
                <td colspan="2" class="font-g">En caso de no cumplir, anote el incumplimiento:
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-g" style="width: 8%">Por lo que:</td>
                <td class="font-g">({{$plantilla->cfe_debe_CFMN ? 'X' : ' '}}) Debe expedirse el CFMN</td>
                <td class="font-g">({{$plantilla->cfe_aplica_flete_CFMN ? 'X' : ' '}}) Aplica Flete</td>
                <td class="font-g">Anote Folios</td>
                <td class="font-g">{{$plantilla->cfe_folios_CFMN}}</td>
                <td class="font-g">({{$plantilla->cfe_no_debe_CFMN ? 'X' : ' '}}) No debe expedirse el CFMN</td>
            </tr>
            <tr>
                <td class="font-g" style="width: 8%"></td>
                <td class="font-g">({{$plantilla->cfe_debe_CFI ? 'X' : ' '}}) Debe expedirse el CFI </td>
                <td class="font-g">({{$plantilla->cfe_aplica_flete_CFI ? 'X' : ' '}}) Aplica Flete </td>
                <td class="font-g">Anote Folios</td>
                <td class="font-g">{{$plantilla->cfe_folios_CFI}}</td>
                <td class="font-g">({{$plantilla->cfe_no_debe_CFI ? 'X' : ' '}}) No debe expedirse el CFI</td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="font-p" style="width: 5%">12. FIN</td>
                <td class="font-g"style="width: 8%">Lugar:</td>
                <td class="font-g" style="width: 45%">{{$embarque->lugar}}</td>
                <td class="font-g">Fecha</td>
                <td class="font-g">{{substr($embarque->fecha_termino, 0, 10)}}</td>
                <td class="font-g">Hora</td>
                <td class="font-g">{{substr($embarque->fecha_termino, 11)}} Hrs</td>
            </tr>
        </table>
        <table style="margin-top: 3px;">
            <tr>
                <td class="font-cc">SOLICITANTE</td>
                <td class="font-cc">OFA/UV/TEF</td>
            </tr>
            <tr>
                <td class="font-cc" style="height: 20px; text-align: center; padding: 0; margin: 0;">________________________________</td>
                <td class="font-cc" style="height: 20px; text-align: center; padding: 0; margin: 0;">________________________________</td>
            </tr>
            <tr>
                <td class="font-cc" style="text-align: center; padding: 0; margin: 0;"></td>
                <td class="font-cc" style="text-align: center; padding: 0; margin: 0;">{{$embarque->tefs}}</td>
            </tr>
            <tr>
                <td class="font-cc">NOMBRE Y FIRMA</td>
                <td class="font-cc">NOMBRE Y FIRMA</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td style="width: 40%"></td>
                <td class="font-rr">CLAVE DE APROBACIÓN: </td>
                <td class="font-rr">{{$vigencias->clave_aprobacion}}</td>
                <td class="font-rr">VIGENCIA</td>
                <td class="font-rr">{{$vigencias->vigencia}}</td>
            </tr>
        </table>
        <table class="table_datos_expedicion">
            <tr>
                <td class="font-mm">
                    Cualquier declaración con falsedad que se manifieste en este dictamen de verificación, será sancionado conforme lo marca el título cuarto del Decreto por el que se reforma,
                    adiciona y derogan diversas disposiciones de la Ley Federal de Sanidad Vegetal; el capítulo III del título cuarto de la Ley Federal de Sanidad Vegetal, sin perjuicio de
                    las penas que correspondan cuando sean constitutivas de delito. Este dictamen de verificación es obligatorio para la expedición del Certificado Fitosanitario y formará
                    parte del expediente del trámite correspondiente.  Ningún Oficial Fitosanitario Autorizado, Unidad de Verificación, Tercero Especialista Fitosanitario, Persona Moral o
                    Física y Organismo de Certificación deberán emitir certificados fitosanitarios sin el dictamen de verificación respectivo.
                    <br>
                    <b>NOTA</b>: si se realizo verificación a productos que no requieren certificado fitosanitario para su movilización, el usuario y el verificador indican
                    <em>"BAJO PROTESTA DE DECIR VERDAD QUE EN ESTE EMBARQUE NO SE OCULTAN PRODUCTOS REGULADOS O CUARENTENADOS Y POR NINGUN MOTIVO SE TRANSPORTAN PRODUCTOS ILICITOS"</em>
                </td>
            </tr>
        </table>
        <table style="margin-top: 10px;">
            <tr>
            <td class="font-mm">
                ORIGINAL: Archivo local o usuario  Copia: SADER
                @if($embarque->pais_id == 1)
                    <br>
                    Nota ingresada, no pertenece al formato original: "La UI opera como tipo A y declara tener la capacidad y competencia técnica de acuerdo a su acreditación UVFITO-004 y
                    aprobación UV-240122-09-VCMREMN-001 para prestar los servicios de inspección y certificación, por lo que los trabajos realizados son de manera imparcial y en apego al
                    código de ética de la empresa, además se le comunica al cliente que la información se maneja de forma confidencial y que los costos generados del servicio serán sufragados
                    por este.
                    <br>
                    <b>UV-240122-09-VCMREMN-001 ES LA CLAVE DE APROBACIÓN PARA PRODUCTOS DE MOVILIZACIÓN NACIONAL.</b>
                @else
                    <br>
                    Nota ingresada, no pertenece al formato original: "La UI opera como tipo A y declara tener la capacidad y competencia técnica de acuerdo a su acreditación UVFITO-004 y
                    aprobación UV-240122-09-VMRE-001 para prestar los servicios de inspección y certificación, por lo que los trabajos realizados son de manera imparcial y en apego al código
                    de ética de la empresa, además se le comunica al cliente que la información se maneja de forma confidencial y que los costos generados del servicio serán sufragados por este.
                    <br>
                    <b>UV-240122-09-VMRE-001 ES LA CLAVE DE APROBACIÓN PARA PRODUCTOS QUE VAN A HACER EXPORTADOS.</b>
                @endif
            </td>
            </tr>
        </table>
    </div>
</body>
</html>
