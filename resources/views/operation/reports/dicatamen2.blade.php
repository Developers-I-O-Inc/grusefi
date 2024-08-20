<!DOCTYPE html>
<html>
<head>
    <title>PDF Report</title>
    <style>
        /* table {
            table-layout: fixed !important;
            width: 100% !important;
            border: red;
        } */

        .card table {
            position: relative;
            z-index: 1;
        }
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
            /* box-shadow: 0px 3px 4px #AAA; */
        }

        #template-container * {
            box-sizing: border-box;
            font-size: 0.1 rem;

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

        /* .template-header .logo-SNSICA { */
        .logo-SNSICA {
            /* height: 48px;
            min-height: 48px;
            max-height: 48px; */
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

        .template-header .title {
            text-transform: uppercase;
            text-align: center;
            flex-grow: 1;
            margin: 0px 40px;
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

        .template-subheader {
        }


        .section {
            margin-bottom: 224px;
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

        @page {
            margin: 10px; /* Puedes ajustar este valor según tus necesidades */
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
        table{
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 0%;
            margin-bottom: 0;
        }
        .font-p{
            font-size: 8.2px;
            font-weight: bold;
            text-align: left;
        }
        .font-g{
            font-size: 8px;
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
            font-size: 8px;
            text-align: center;
        }
        .font-rr{
            font-size: 8px;
            text-align: right;
        }
        /* table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        } */
        .prueba td{
            font-size: 8px;
            font-style: italic;
        }
        .encabezado_principal td{
            font-weight: bold;
        }
        .pregunta1{
            width: 7%;
        }
        .r_lugar{
            font-size: 8px;
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
            font-size: 8px;
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
            font-size: 8px;
        }
        .table_datos_expedicion{
            border: 1px solid black;
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
            font-size: 8px;
        }
        .td_datos_3{
            border-right: 1px solid black;
            border-left: 0;
            font-size: 8px;
        }
        .td_datos{
            width: 50%;
            font-size: 8px;
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
                <td colspan="2" style="text-align:center; border:1px;">Dictamen de verificacion (DV) <br> para la movilizacion de productos vegetales</td>

                <td rowspan="2" style="width: 8%; text-align:right"><img src="{{public_path('img/logo.png')}}" class="logo-unidad-verificacion" alt="Logo Unidad de Verificación"></td>
            </tr>
            <tr class="prueba">
                <td style="text-align:left;"><b>A) ORDEN DE SERVICIO</b> ((PARA SER LLENADO POR EL CLIENTE O USUARIO)</td>
                <td style="text-align:center;"><b>FOLIO:</b> UV-220724-16-VMRE-006-293-0096-24</td>
            </tr>
        </table>
        <table class="table_1">
            <tr>
                <td class="pregunta1 font-p">1. INICIO:</td>
                <td class="r_lugar font-g">Lugar:</td>
                <td class="rr_lugar font-g">ZAPOTILTIC, JALISCO, MÉXICO </td>
                <td class="r_lugar font-g">Fecha:</td>
                <td class="rr_lugar font-g">15/08/2024</td>
                <td class="r_lugar font-g">Hora:</td>
                <td class="rr_lugar font-g">08:00:00 Hrs</td>
            </tr>
        </table>
        <table class="table_2">
            <tr>
                <td class="pregunta2 font-p">2. Servicio Solicitado:</td>
                <td class="r_servicio font-g">Dictamen de Verificación ( X ) </td>
                <td class="r_servicio font-g">Certificado Fitosanitario para la Movilización Nacional ( ) </td>
                <td class="r_servicio font-g">Certificado Fitosanitario Internacional ( X )</td>
            </tr>
        </table>
        <table class="table_3">
            <tr>
                <td class="r_otro font-g">Otro (ESPECIFIQUE): </td>
                <td class="rr_otro"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="pregunta3 font-p">3. Datos para expedición de certificado fitosanitario:</td>
            </tr>
        </table>
        <table class="table_datos_expedicion">
            <tr>
                <td colspan="3" class="td_datos font-g">Nombre y dirección del remitente</td>
                <td colspan="2" class="td_datos font-g">Nombre y dirección del destinatario</td>
            </tr>
            <tr>
                <td colspan="3" class="td_datos font-g">FRESHJAL S. DE R.L. DE C.V.</td>
                <td colspan="2" class="td_datos font-g">LA HUERTA IMPORTS</td>
            </tr>
            <tr>
                <td colspan="3" class="td_datos font-g">KM. 3.7 CARRETERA CD. GUZMÁN - ZAPOTILTIC CP: 49600 ZAPOTILTIC, JALISCO</td>
                <td colspan="2" class="td_datos font-g">809 MCPHERSON DRIVE CORBEIL, ONTARIO. CANADA. P0H 1K0</td>
            </tr>
            <tr class="tr_datos">
                <td class="td_datos_2 font-g">Producto</td>
                <td class="td_datos_2 font-g">Uso</td>
                <td class="td_datos_2 font-g">Cantidad</td>
                <td class="td_datos_2 font-g">Presentación</td>
                <td class="td_datos_2 font-g">Marcas Distintivas</td>
            </tr>
            <tr>
                <td class="td_datos_3 font-g">AGUACATE(Persea americana) Var. Hass</td>
                <td class="td_datos_3 font-g">CONSUMO HUMANO</td>
                <td class="td_datos_3 font-g">18.0800 Toneladas</td>
                <td class="td_datos_3 font-g">: 1600 CAJAS DE CARTON DE 11.3 KGS. C/U </td>
                <td class="td_datos_3 font-g">LUCKY7'S</td>
            </tr>
            <tr>
                <td colspan="2" class="font-g td_datos_2">Punto de entrada </td>
                <td class="font-g td_datos_2">Medio de transporte y placas</td>
                <td class="font-g td_datos_2">Origen</td>
                <td class="font-g td_datos_2">Procedencia</td>
            </tr>
            <tr>
                <td colspan="2" class="td_datos_3 font-g">TORONTO, CANADA</td>
                <td class="td_datos_3 font-g">TRAILER PLACAS: 82-UL-6R
                    345</td>
                <td class="td_datos_3 font-g">ATENGUILLO, ZAPOTLÁN EL
                    GRANDE, CUAUTLA, MAZAMITLA,
                    TAMAZULA DE GORDIANO, JALISCO;
                    MÉXICO</td>
                <td class="td_datos_3 font-g">ZAPOTILTIC, JALISCO, MÉXICO</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p pregunta2">B) lista de verificación</td>
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
        <table>
            <tr>
                <td class="font-p">4. Indique la regulación o requisito que evaluará:</td>
                <td class="font-g">INCISO B) DEL AVISO 108 DEL 19 DE OCTUBRE DEL 2018 Y CIRCULAR 080 DEL 27 DE SEPTIEMBRE DEL 2017</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">5. De acuerdo al servicio solicitado y a la regulación o requisito que aplica, marque con una “X” los documentos que son requeridos para iniciar el proceso de verificación:</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-mm td_incisos_left"> (X) Certificado Fitosanitario para la Movilización Nacional</td>
                <td class="font-mm_right td_incisos">1899312, 1899333, 24-2415002961, 24-2415475598, 24-2415616408,24-2415285894</td>
                <td class="font-mm td_incisos_right"> (X) Cartilla Fitosanitaria</td>
                <td class="font-mm_right td_incisos">PFA-PAGU-22-061-190674</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ( ) Copia del CFMN expedido en el origen</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right"> (X)Certificado de cumplimiento de Norma</td>
                <td class="font-mm_right td_incisos">EMP0414121293/2016</td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left">( ) Diagnóstico Fitosanitario</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right">( ) Tarjeta de Manejo Integrado de Moscas de la Fruta</td>
                <td class="font-mm_right td_incisos"></td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left">( ) Dictamen de Evaluación de la Conformidad</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right">( ) Copia de Certificado Fitosanitario de Importación</td>
                <td class="font-mm_right td_incisos"></td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ( ) Ningún documento</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right"> ( ) Certificado Fitosanitario de Tratamiento Cuarentenario</td>
                <td class="font-mm_right td_incisos"></td>
            </tr>
            <tr>
                <td class="font-mm td_incisos_left"> ( ) Otro (especifique):</td>
                <td class="font-mm_right td_incisos"></td>
                <td class="font-mm td_incisos_right"> (X) Aviso de inicio de funcionamiento (Anotar # registro del huerto o instalacion).</td>
                <td class="font-mm_right td_incisos">ANEXO</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">6. El producto o lote se encuentra identificado, acondicionado y preparado para realizar la verificación?: Si ( X ) No ( ). Si su respuesta es No, cancele la verificación hasta que
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
                <td class="font-g td_tipo_verificacion"> (X) Constatación ocular</td>
                <td class="font-g td_tipo_verificacion"> ( ) Diagnóstico Fitosanitario</td>
                <td class="font-g td_tipo_verificacion"> (X) Muestreo en sitio</td>
                <td class="font-g td_tipo_verificacion"> ( ) Otro especifique:</td>
                <td class="font-g"> </td>
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
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">10%</td>
                <td class="font-g">DE 4 CAJAS EN BASE A PROCEDIMIENTO TECNICO DE TOMA DE MUESTRA DE SIAR A.C.</td>
            </tr>
            <tr>
                <td class="font-g">Plagas de importancia cuarentenaria</td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">0.0</td>
                <td class="font-g">LIBRE DE PLAGAS DE INTERES CUARENTENARIO: Barrenador pequeño del hueso (Conotrachelus aguacatae y C. persea); Barrenador grande del hueso (Heilipus lauri);
                    Barrenador de ramas (Copturus aguacatae) y la Palomilla barrenadora del hueso del aguacate (Stenoma catenifer)</td>
            </tr>
            <tr>
                <td class="font-g">Plagas de importancia económica</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Tratamiento cuarentenario</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Residuos vegetales</td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">0.0</td>
                <td class="font-g">LIBRE DE RESIDUOS VEGETALES</td>
            </tr>
            <tr>
                <td class="font-g">Toma de Muestra</td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">0.0</td>
                <td class="font-g">LIBRE DE SUELO</td>
            </tr>
            <tr>
                <td class="font-g">Lavado</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Cepillado</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Empaque nuevo</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Etiquetas fitosanitarias</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Diagnostico fitosanitario</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-g"></td>
            </tr>
            <tr>
                <td class="font-g">Materia extraña no sujeta a regulación</td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-g">LIBRE DE PLAGAS CONTAMINANTES</td>
            </tr>
            <tr>
                <td class="font-g">Otra</td>
                <td class="font-cc">X</td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-cc"></td>
                <td class="font-g">FECHA INSPECCIÓN: DEL 02 AL 15 DE AGOSTO DEL 2024 SE CONSTATÓ QUE LAS TARIMAS FUERON TRATADAS DE ACUERDO
                    A LA NIMF No. 15</td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="4" class="pregunta3 font-p">9. El transporte para la movilización del Lote de producto (s) presenta o se encuentra? (Marque con una X y complemente): </td>
            </tr>
            <tr>
                <td class="font-g">( ) Sin Residuos vegetales o de cosecha</td>
                <td class="font-g">( ) Sin residuos de suelo </td>
                <td class="font-g">( ) Lavado </td>
                <td class="font-g">( X ) Limpio completamente</td>
            </tr>
            <tr>
                <td class="font-g">( X ) Refrigerado</td>
                <td class="font-g">( ) Enlonado</td>
                <td class="font-g">( ) Caja seca</td>
                <td class="font-g">( ) Otro especifique:
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p">C) DICTAMEN DE VERIFICACION</td>
                <td class="font-g">D) DICTAMEN DE VERIFICACIÓN (PARA SER LLENADO POR EL TEF)</td>
            </tr>
            <tr>
                <td colspan="2" class="font-g">De conformidad con la comprobación documental, la constatación ocular o comprobación mediante muestreo o análisis de laboratorio de prueba, se dictamina que el Lote de
                    producto (s)</td>
            </tr>
            <tr>
                <td colspan="2" class="font-p">10. No requiere Certificado Fitosanitario por movilizarse en una zona bajo un mismo estatus fitosanitario o por tratarse de un producto no regulado ( )
                </td>
            </tr>
            <tr>
                <td colspan="2" class="font-p">11 Si Cumple ( X ) No Cumple ( ) con la normatividad, requisitos aplicables y/o requisito fitosanitario evaluado.
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
                <td class="font-g">( ) Debe expedirse el CFMN</td>
                <td class="font-g">( ) Aplica Fleje</td>
                <td class="font-g">Anote Folios</td>
                <td class="font-g"></td>
                <td class="font-g">( ) No debe expedirse el CFMN</td>
            </tr>
            <tr>
                <td class="font-g" style="width: 8%"></td>
                <td class="font-g">( X ) Debe expedirse el CFI </td>
                <td class="font-g">( ) Aplica Fleje </td>
                <td class="font-g">Anote Folios</td>
                <td class="font-g"></td>
                <td class="font-g">( ) No debe expedirse el CFI</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-p" style="width: 8%">12. FIN</td>
                <td class="font-g"style="width: 8%">Lugar:</td>
                <td class="font-g">ZAPOTILTIC, JALISCO, MÉXICO</td>
                <td class="font-g">Fecha</td>
                <td class="font-g">15/08/2024</td>
                <td class="font-g">Hora</td>
                <td class="font-g">10:39 Hrs.</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="font-cc">SOLICITANTE</td>
                <td class="font-cc">OFA/UV/TEF</td>
            </tr>
            <tr>
                <td class="font-cc" style="height: 40px; text-aling=">________________________________</td>
                <td class="font-cc" style="height: 40px; text-aling=">________________________________</td>
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
                <td class="font-rr">LAVE DE APROBACION: </td>
                <td class="font-rr">V-220724-16-VMRE-006</td>
                <td class="font-rr">VIGENCIA</td>
                <td class="font-rr">21/07/2026</td>
            </tr>
        </table>
        <table class="table_datos_expedicion">
            <tr>
                <td class="font-mm">
                    Cualquier declaración con falsedad que se manifieste en este dictamen de verificación, será sancionado conforme lo marca el título cuarto del Decreto por el que se reforma, adiciona y derogan diversas disposiciones de la Ley Federal de
                    Sanidad Vegetal; el capítulo III del título cuarto de la Ley Federal de Sanidad Vegetal, sin perjuicio de las penas que correspondan cuando sean constitutivas de delito. Este dictamen de verificación es o bligatorio para la expedición del
                    Certificado Fitosanitario y formará parte del expediente del trámite correspondiente. Ningún Oficial Fitosanitario Autorizado, Unidad de Verificación, Tercero Especialista Fitosanitario, Persona Moral o Física y Organismo de Certificación deberán
                    emitir certificados fitosanitarios sin el dictamen de verificación respectivo. NOTA: si se realizó verificacion a productos que no requieren certificado fitosanitario para su movilizacion, el usuario y el verificador indican
                    <br>
                    <em>"BAJO PROTESTA DE DECIR VERDAD QUE EN ESTE EMBARQUE NO SE OCULTAN PRODUCTOS REGULADOS O CUARENTENADOS Y POR NINGUN MOTIVO SE TRANSPORTAN PRODUCTOS ILICITOS"</em>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
