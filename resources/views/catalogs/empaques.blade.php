@extends('layouts/app2')
@section('styles')
    <link href="{{asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">

@endsection
@section('title', 'Clientes')
@section('title_top', 'Clientes')
@section('config', 'active')
@section('subtitle_top', 'Control de Clientes')
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
                        <input type="text" data-kt-empaque-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar clientes" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-empaque-table-toolbar="base">
                        <button type="button" class="btn btn-primary" id="btn_add">Agregar Cliente</button>
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-empaque-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-empaque-table-select="selected_count"></span>Seleccionados
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-empaque-table-select="delete_selected">Borrar Seleccionados</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_empaques_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_empaques_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-85px">id</th>
                            <th class="min-w-85px">Opciones</th>
                            <th class="min-w-125px">Nom. Corto</th>
                            <th class="min-w-125px">Nombre Fiscal</th>
                            <th class="min-w-125px">Domicilio_fiscal</th>
                            <th class="min-w-125px">Num_ext</th>
                            <th class="min-w-125px">Num_int</th>
                            <th class="min-w-125px">CP</th>
                            <th class="min-w-125px">RFC</th>
                            <th class="min-w-125px">Telefonos</th>
                            <th class="min-w-125px">Imagen</th>
                            <th class="min-w-125px">Nombre_embarque</th>
                            <th class="min-w-125px">Domicilio_documentacion</th>
                            <th class="min-w-125px">Codigo</th>
                            <th class="min-w-125px">Exportacion</th>
                            <th class="min-w-125px">Asociado</th>
                            <th class="min-w-125px">Status</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_empaque" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-950px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_empaque_form" enctype="multipart/form-data">
                        <div class="modal-header" id="kt_modal_add_empaque_header">
                            <h2 class="fw-bolder">Agregar Empaque</h2>
                            <div id="kt_modal_add_empaque_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <br>
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_empaque_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_empaque_header"
                                data-kt-scroll-wrappers="#kt_modal_add_empaque_scroll" data-kt-scroll-offset="300px">

                                <div class="overflow-hidden position-relative card-rounded">
                                    <div class="ribbon ribbon-triangle ribbon-top-start border-primary"></div>
                                    <div class="card card-bordered">
                                        <div class="card-header ribbon ribbon-top ribbon-vertical">
                                            <div class="card-title">DATOS FISCALES</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-4">
                                                <div class="col-md-2 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Nombre Corto</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa un nombre" name="nombre_corto" id="nombre_corto" autocomplete="off" />
                                                    <input type="text" class="form-control d-none" name="id_empaque" id="id_empaque" />
                                                </div>
                                                <div class="col-md-5 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Nombre Fiscal</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa el nombre fiscal del empaque" name="nombre_fiscal" id="nombre_fiscal" autocomplete="off"/>
                                                </div>
                                                <div class="col-md-5 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Domicilio Fiscal</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa el domicilio fiscal del empaque" name="domicilio_fiscal" id="domicilio_fiscal" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-5 fv-row">
                                                    <div class="row fv-row fv-plugins-icon-container">
                                                        <div class="col-md-6 fv-row">
                                                            <label class="required fs-6 fw-bold form-label mb-2">RFC</label>
                                                            <input type="text" class="form-control" placeholder="RFC" name="rfc" id="rfc" autocomplete="off" />
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                        <div class="col-md-6 fv-row">
                                                            <label class="required fs-6 fw-bold form-label mb-2">Teléfonos(s)</label>
                                                            <input type="text" class="form-control" minlength="3" maxlength="15" placeholder="Ingrese Teléfono" id="telefonos" name="telefonos" autocomplete="off">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 fv-row">
                                                    <label class="required fs-6 fw-bold form-label mb-2">Número</label>
                                                    <div class="row fv-row fv-plugins-icon-container">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" placeholder="Exterior" name="num_ext" id="num_ext" autocomplete="off"/>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" placeholder="Interior" name="num_int" id="num_int" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 fv-row fv-plugins-icon-container">
                                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Código Postal</span>
                                                    </label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" minlength="3" maxlength="6" placeholder="Código Postal" id="cp" name="cp" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Municipio</label>
                                                    <select id="municipio_id" name="municipio_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_empaque" data-placeholder="Selecciona un municipio" data-allow-clear="true">
                                                        <option value=""></option>
                                                        @foreach($municipios as $municipio)
                                                            <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Localidad</label>
                                                    <select id="localidad_id" name="localidad_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_empaque" data-placeholder="Selecciona una localidad" data-allow-clear="true">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden position-relative card-rounded">
                                    <div class="ribbon ribbon-triangle ribbon-top-start border-primary">
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-header ribbon ribbon-top ribbon-vertical">
                                            <div class="card-title">DATOS DOCUMENTACIÓN ELECTRÓNICA</div>
                                        </div>
                                        <div class="card-body"  >
                                            <div class="row mb-4">
                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Nombre para Embarcar</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa nombre para embarcar" name="nombre_embarque" id="nombre_embarque" autocomplete="off" />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Domicilio</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa domicilio" name="domicilio_documentacion" id="domicilio_documentacion" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Registro Sader</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa SADER" name="sader" id="sader" autocomplete="off"/>
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Código</label>
                                                    <input type="text" class="form-control" placeholder="Ingresa código" name="codigo" id="codigo" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Municipio</label>
                                                    <select id="municipio_id2" name="municipio_id2" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_empaque" data-placeholder="Selecciona un municipio" data-allow-clear="true">
                                                        <option value=""></option>
                                                        @foreach($municipios as $municipio)
                                                            <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="required fs-6 fw-bold mb-2">Localidad</label>
                                                    <select id="localidad_doc_id" name="localidad_doc_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_empaque" data-placeholder="Selecciona una localidad" data-allow-clear="true">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="fv-row mb-7">
                                                <input class="form-check-input" type="checkbox" value="Física" id="check_tipo" name="check_tipo"/>
                                                <label class="form-check-label" for="activo">
                                                    Física
                                                </label>
                                                <input type="text" class="form-control d-none" name="tipo" id="tipo" value="Moral"/>
                                            </div>
                                            <div class="fv-row mb-7">
                                                <input class="form-check-input" type="checkbox" value="0" id="check_exportacion" name="check_exportacion"/>
                                                <label class="form-check-label" for="activo">
                                                    Empaque Activo para Exportación
                                                </label>
                                            </div>
                                            <input type="text" class="form-control d-none" name="exportacion" id="exportacion" value="0"/>

                                            <div class="fv-row mb-7">
                                                <input class="form-check-input" type="checkbox" value="0" id="check_asociado" name="check_asociado"/>
                                                <label class="form-check-label" for="activo">
                                                    Empaque Asociado
                                                </label>
                                            </div>
                                            <input type="text" class="form-control d-none" name="asociado" id="asociado" value="0"/>
                                            <div class="fv-row mb-7">
                                                <input class="form-check-input" type="checkbox" value="1" id="check_activo" name="check_activo" checked/>
                                                <label class="form-check-label" for="activo">
                                                    Activo
                                                </label>
                                            </div>
                                            <input type="text" class="form-control d-none" name="activo" id="activo" value="1"/>
                                        </div>
                                    </div>
                                </div>
                                <br></br>
                                <div class="fv-row mb-7 text-center">
                                    <div id="image_empaque" class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url(/img/gen006.svg)">
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="imagen" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="imagen_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="cancel"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="remove"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="kt_modal_add_empaque_cancel"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="kt_modal_add_empaque_submit" class="btn btn-primary">
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
    <script src="{{asset('assets/js/catalogs/empaques.js')}}" type="module"></script>
@endsection
