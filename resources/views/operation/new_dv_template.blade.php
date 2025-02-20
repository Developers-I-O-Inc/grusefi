@extends('metronic.index')
@section('title', 'Nuevo DV')
@section('config', 'active')
@section('subtitle', 'Crear DV - Plantilla')
@section('content')
    <div id="kt_content_container bg-light-primary" class="container-xxl">
        <form id="form_plantilla" class="form" action="#">
            <div class="card">
                <div class="card-header pt-6 bg-light-primary rounded border-primary border border-dashed">
                    <div class="card-title mb-5">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"></i>
                            <div class="row">
                            <div class="col-4">
                                <input type="text" id="plantilla_id" name="plantilla_id" class="d-none">
                                <select id="pais_id" name="pais_id" class="form-select" data-control="select2" data-placeholder="Selecciona un país">
                                    <option value=""></option>
                                    @foreach($paises as $pais)
                                        <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <select id="municipio_id" name="municipio_id" disabled class="form-select" data-control="select2" data-placeholder="Selecciona una municipio/lugar">
                                    <option value=""></option>
                                    @foreach($municipios as $municipio)
                                        <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                @role(["Super Admin", "Admin"])
                                        <select id="tefs_id" name="tefs_id" class="form-select" data-control="select2" data-placeholder="Selecciona un usuario" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($users as $users)
                                                <option value="{{$users->id}}">{{$users->name.' '.$users->last_name}}</option>
                                            @endforeach
                                        </select>
                                @endrole
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-toolbar mb-5">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-primary me-3 d-none" id="btn_save">
                                <i class="ki-outline ki-document fs-2"></i>Guardar DV
                            </button>
                            <button type="button" class="btn btn-active-dark active " id="btn_search">
                                <i class="ki-outline ki-magnifier fs-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="card py-6">
                <x-table-rpv :embarque="true" :vigencias="$vigencias" :puertos="$puertos" :lugares="$lugares" :empaques="$empaques" :usos="$usos" :products="true"></x-table-rpv>
            </div>
        </form>
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
        <div class="modal fade" id="kt_modal_standards" tabindex="-1" aria-hidden="true">
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
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/new_dv_template.js')}}" type="module"></script>
@endpush
