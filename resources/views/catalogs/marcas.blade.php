@extends('metronic.index')
@section('title', 'Marcas')
@section('title_top', 'Marcas')
@section('config', 'active')
@section('subtitle_top', 'Control de Marcas')
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <div class="card shadow-sm">
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
                        <input type="text" data-kt-marca-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar marcas" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-marca-table-toolbar="base">
                        <button type="button" class="btn btn-primary" id="btn_add">Agregar Marca</button>
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-marca-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-marca-table-select="selected_count"></span>Seleccionados
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-marca-table-select="delete_selected">Borrar Seleccionados</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_marcas_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_marcas_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">id</th>
                            <th class="min-w-125px">Empaque</th>
                            <th class="min-w-125px">Marca</th>
                            <th class="min-w-125px">Status</th>
                            <th class="min-w-125px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_marca" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_marca_form">
                        <div class="modal-header" id="kt_modal_add_marca_header">
                            <h2 class="fw-bolder">Agregar Marca</h2>
                            <div id="kt_modal_add_marca_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_marca_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_marca_header"
                                data-kt-scroll-wrappers="#kt_modal_add_marca_scroll" data-kt-scroll-offset="300px">
                                <div class="fv-row mb-4">
                                    <label class="required fs-6 fw-bold mb-2">Empaque</label>
                                    <select id="empaque_id" name="empaque_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_marca" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                        <option value=""></option>
                                         @foreach($empaques as $empaque)
                                            <option value="{{$empaque->id}}">{{$empaque->nombre_fiscal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-4">
                                    <label class="required fs-6 fw-bold mb-2">Nombre del marca</label>
                                    <input type="text" class="form-control" placeholder="Ingresa un nombre" name="nombre" id="nombre" autocomplete="off" />
                                    <input type="text" class="form-control d-none" name="id_marca" id="id_marca" />
                                </div>
                                <div class="fv-row mb-7">
                                    <input class="form-check-input" type="checkbox" value="1" id="check_activo" name="check_activo" checked/>
                                    <label class="form-check-label" for="activo">
                                        Activo
                                    </label>
                                </div>
                                <input type="text" class="form-control d-none" name="activo" id="activo" value="1"/>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="kt_modal_add_marca_cancel"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="kt_modal_add_marca_submit" class="btn btn-primary">
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
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/catalogs/marcas.js')}}" type="module"></script>
@endpush
