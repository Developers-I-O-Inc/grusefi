@extends('metronic.index')
@section('title', 'DV')
@section('embarques', 'active')
@section('subtitle', 'Control de DV´S registrados')
@section('content')
    <div id="kt_content_container" class="container-xxl">
        @if (session('success'))
        <div class="alert alert-dismissible bg-light-success border border-success border-3 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
                <i class="ki-outline ki-check text-success fs-2"></i>
            </span>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1">Éxito!</h5>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-outline ki-cross text-success fs-2x"></i>
            </button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-dismissible bg-light-danger border border-danger border-3 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                <i class="ki-outline ki-cross-square text-danger fs-2"></i>
            </span>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1">Error!</h5>
                <span>{{ session('error') }}</span>
                @if (session('details'))
                    <ul>
                        @foreach (session('details') as $detail)
                            <li>{{ $detail }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-outline ki-cross text-danger fs-2x"></i>
            </button>
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end me-4" data-kt-admin-table-toolbar="base">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <i class="ki-outline ki-calendar-8 fs-1"></i>
                            </span>
                            <input type="text" class="form-control form-control-solid w-250px ps-15" placeholder="Selecciona Fechas" id="dates"/>
                            <input type="text" value="0" id="dates_filter" class="d-none">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end" data-kt-admin-table-toolbar="base">
                        <button type="button" class="btn btn-primary" id="btn_search">Buscar</button>
                    </div>
                    <div class="d-flex justify-content-end px-1" data-kt-admin-table-toolbar="base">
                        <button type="button" class="btn btn-primary d-none" id="btn_save">Guardar</button>
                    </div>
                    <div class="d-flex justify-content-end px-1" data-kt-admin-table-toolbar="base">
                        <button type="button" class="btn btn-primary d-none" id="btn_finish">Terminar DV</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="accordion" id="kt_accordion_1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                            <button class="accordion-button fs-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                Embarques
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body">
                                <div class="card card-p-0 card-flush">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <div class="card-title">
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <span class="svg-icon fs-1 position-absolute ms-4">
                                                    <i class="ki-outline ki-magnifier fs-1"></i>
                                                </span>
                                                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar embarque" />
                                            </div>
                                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                                        </div>
                                        <div class="card-toolbar flex-row-fluid justify-content-end">
                                            <button type="button" class="btn btn-light-success" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-outline ki-exit-down fs-2"></i>
                                                Exportar
                                            </button>
                                            <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-export="copy">
                                                    Copiar
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                                    Exportar a Excel
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-export="csv">
                                                    Exportar a CSV
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                                    Exportar a PDF
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-row-bordered gy-5" id="kt_admin_table">
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="">ID</th>
                                                        <th class="">Estatus</th>
                                                        <th class="">Folio</th>
                                                        <th class="">Empaque</th>
                                                        <th class="">Destinatario</th>
                                                        <th class="">Puerto</th>
                                                        <th class="">Tefs</th>
                                                        <th class="">Fecha Embarque</th>
                                                        <th class="">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="kt_accordion_1_header_2">
                            <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                            Documento Dictamen de Verificación (DV)
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body">
                                <form id="form_rpv">
                                    <x-table-rpv :embarque="true" :vigencias="null"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_product_form">
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Productos del Embarque</h2>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7">Productos seleccionados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">Agregar Productos</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
                                            <div class="row">
                                                <div class="card-toolbar">
                                                    <div class="d-flex justify-content-end align-items-center d-none"
                                                        data-kt-user-permission-toolbar="selected">
                                                        <div class="fw-bolder me-5">
                                                            <span class="me-2" data-kt-user-permissio-select="selected_count"></span>Seleccionados
                                                        </div>
                                                        <button href="#" class="btn btn-link btn-color-danger btn-active-color-primary me-5 mb-2">Eliminar</button>
                                                    </div>
                                                </div>
                                                <x-table-products />
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                                            <x-fields_products :variedades="$variedades" :presentaciones="$presentaciones"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="btn_add_product" class="btn btn-primary">
                                <span class="indicator-label">Agregar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_edit_standards" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Normas del Embarque</h2>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                <div class="card-body">
                                    <x-standards-table :standards="$standards"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
                            <button type="button" id="btn_save_standards" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Archivos del Embarque</h2>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                <div class="card-body">
                                   <h1>Este modulo esta en construcción, aquí se podran subir todos los documentos firmados</h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
                            <button type="button" id="btn_upload" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Espere un momento...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="import_products" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Importar Excel</h2>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                <input type="file" name="file_import" class="form-control form-control-solid" />
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="cancel_modal"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                <span class="indicator-label">Agregar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_cancel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="form_cancel" method="POST">
                        @csrf
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Cancelar Embarque</h2>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                <label class="fs-6 fw-bold mb-2">Observaciones</label>
                                <textarea class="form-control" data-kt-autosize="true" id="observations" name="observations"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="cancel_modal"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                <span class="indicator-label">Agregar</span>
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
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/datatables/datatables_fixedcolumns.js')}}"></script>
    <script src="{{asset('assets/js/datatables/fixedColumns.dataTables.js')}}"></script>
    <script src="{{asset('assets/js/operation/embarques_admin.js')}}" type="module"></script>
@endpush
