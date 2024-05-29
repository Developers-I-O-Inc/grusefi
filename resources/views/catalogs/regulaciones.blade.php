@extends('layouts/app2')
@section('styles')
    <link href="{{asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('title', 'Regulaciones de Paises')
@section('title_top', 'Regulaciones de Paises')
@section('zones', 'active')
@section('subtitle_top', 'Control de Regulaciones de Paises')
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <input type="text" data-kt-regulacion-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar regulaciones" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-regulacion-table-toolbar="base">
                        <button type="button" class="btn btn-primary" id="btn_add">Agregar regulacion</button>
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-regulacion-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-regulacion-table-select="selected_count"></span>Seleccionados
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-regulacion-table-select="delete_selected">Borrar Seleccionados</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_regulaciones_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_regulaciones_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-60px">Opciones</th>
                            <th class="min-w-125px">id</th>
                            <th class="min-w-125px">País</th>
                            <th class="min-w-125px">Abreviación</th>
                            <th class="min-w-125px">Dict. Apartado #4</th>
                            <th class="min-w-125px">Dict. Apartado #5</th>
                            <th class="min-w-125px">Dict. Apartado #11</th>
                            <th class="min-w-125px">Nom. Dictamen</th>
                            <th class="min-w-125px">Nom. Certificado</th>
                            <th class="min-w-125px">Act. Embarque</th>
                            <th class="min-w-125px">Req. Inspector</th>
                            <th class="min-w-125px">Req. Huertas</th>
                            <th class="min-w-125px">Req. Estudio Análisis</th>
                            <th class="min-w-125px">Req. Impresión</th>
                            <th class="min-w-125px">Activo</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_regulacion" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_regulacion_form"
                        data-kt-redirect="../../demo6/dist/apps/regulaciones/list.html">
                        <div class="modal-header" id="kt_modal_add_regulacion_header">
                            <h2 class="fw-bolder">Agregar regulacion</h2>
                            <div id="kt_modal_add_regulacion_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body py-10 px-lg-17">
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_regulacion_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_regulacion_header"
                                data-kt-scroll-wrappers="#kt_modal_add_regulacion_scroll" data-kt-scroll-offset="300px">
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Pais</label>
                                    <select id="pais_id" name="pais_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_regulacion" data-placeholder="Selecciona un país" data-allow-clear="true">
                                        <option></option>
                                        @foreach($paises as $pais)
                                            <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control form-control-solid d-none" name="id_regulacion" id="id_regulacion" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Dictamen Apartado #4</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa un nombre" name="dictamen_apartado_4" id="dictamen_apartado_4" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Dictamen Apartado #5</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa un nombre" name="dictamen_apartado_5" id="dictamen_apartado_5" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Dictamen Apartado #11</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa un nombre" name="dictamen_apartado_11" id="dictamen_apartado_11" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Nombre País Dictamen</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa un nombre" name="nombre_pais_dictamen" id="nombre_pais_dictamen" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-bold mb-2">Nombre País Certificado</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa un nombre" name="nombre_pais_certificado" id="nombre_pais_certificado" />
                                </div>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="0" id="check_embarques" name="check_embarques"/>
                                    <label class="form-check-label" for="active">
                                        Activo para embarques
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="activo_embarques" id="activo_embarques" value="0"/>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="0" id="check_inspector" name="check_inspector"/>
                                    <label class="form-check-label" for="active">
                                        Requiere Inspector
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="rq_inspector" id="rq_inspector" value="0"/>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="0" id="check_huertas" name="check_huertas"/>
                                    <label class="form-check-label" for="active">
                                        Requiere Huertas
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="rq_huertas" id="rq_huertas" value="0"/>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="0" id="check_analisis" name="check_analisis"/>
                                    <label class="form-check-label" for="active">
                                        Requiere Estudios de Análisis
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="rq_estudios_analisis" id="rq_estudios_analisis" value="0"/>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="0" id="check_impresion" name="check_impresion"/>
                                    <label class="form-check-label" for="active">
                                        Requiere Impresión de Anexo
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="rq_impresion" id="rq_impresion" value="0"/>

                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="" id="active_check" name="active_check"/>
                                    <label class="form-check-label" for="active">
                                        Activo
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-solid d-none" name="activo" id="activo" value="0"/>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="kt_modal_add_regulacion_cancel"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="kt_modal_add_regulacion_submit" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/catalogs/regulaciones.js')}}" type="module"></script>
@endsection
