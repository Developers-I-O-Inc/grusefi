@extends('layouts/app2')
@section('title', 'Usuarios')
@section('title_top', 'Usuarios')
@section('subtitle_top', 'Control de Usuarios')
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
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar Usuarios" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        @can('admin_users')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Agregar Usuario</button>
                        @else
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" disabled data-bs-target="#kt_modal_add_user">No puedes realizar modificaciones</button>
                        @endcan
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-user-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Seleccionados
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-user-table-select="delete_selected">Borrar Seleccionados</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_users_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                @can('admin_users')
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_users_table .form-check-input" value="1" />
                                    </div>
                                @endcan
                            </th>
                            <th class="min-w-125px">id</th>
                            <th class="min-w-125px">N° Empleado</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Nombre</th>
                            <th class="min-w-125px">Apellidos</th>
                            <th class="min-w-125px">Teléfono</th>
                            <th class="min-w-125px">Dirección</th>
                            <th class="min-w-125px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_user_form">
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bolder">Agregar Usuario</h2>
                            <div id="kt_modal_add_user_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div class="fv-row mb-2">
                                    <label class="required fs-6 fw-bold mb-2">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Ingresa un nombre" name="name" id="name" autocomplete="off"/>
                                    <input type="text" class="form-control d-none" name="id_user" id="id_user" />
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="required fs-6 fw-bold mb-2">Apellidos</label>
                                    <input type="text" class="form-control" placeholder="Ingresa los apellidos" name="last_name" id="last_name" autocomplete="off"/>
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="required fs-6 fw-bold mb-2">Email</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el nombre con el que iniciará sesión el usuario" name="email" id="email" autocomplete="off"/>
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="required fs-6 fw-bold mb-2">Código de Empleado</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el código de empleado" name="employee_number" id="employee_number" autocomplete="off"/>
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="required fs-6 fw-bold mb-2">Último consecutivo</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el código de empleado" name="last_id" id="last_id" autocomplete="off"/>
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="fs-6 fw-bold mb-2">Dirección</label>
                                    <input type="text" class="form-control" placeholder="Ingresa la dirección del usuario" name="address" id="address" autocomplete="off"/>
                                </div>
                                <div class="fv-row mb-2">
                                    <label class="fs-6 fw-bold mb-2">Teléfono</label>
                                    <input type="text" class="form-control" placeholder="Ingresa un teléfono" name="phone" id="phone" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="kt_modal_add_user_cancel"
                                class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="kt_modal_add_user_submit" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--begin::Modal Permissions-->
        <div class="modal fade"  id="kt_modal_permission">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Permisos</h5>
                        <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                <label for="" class="form-label">Permiso</label>
                                <select id="select_permission" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_permission" data-placeholder="Selecciona un permiso" data-allow-clear="true">
                                    <option></option>
                                    @foreach($roles as $rol)
                                        <option value="{{$rol->name}}">{{$rol->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="d-none" id="user_id">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-sm btn-flex btn-light-primary" id="btn_add_permission">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>Agregar</button>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
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
                            <table class="table table-row-dashed fs-6 gy-5 table-row-gray-300" id="kt_users_permissions_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="">Permiso</th>
                                        <th class="">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn_save_permissions">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
        <!--begin::Modal COUNTRIES-->
        <div class="modal fade"  id="kt_modal_countries">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Estados</h5>
                        <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                <label for="" class="form-label">Estado</label>
                                <select id="select_country" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_countries" data-placeholder="Selecciona un estado" data-allow-clear="true">
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->nombre}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="d-none" id="user_id_country">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-sm btn-flex btn-light-primary" id="btn_add_country">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>Agregar</button>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
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
                            <table class="table table-row-dashed fs-6 gy-5 table-row-gray-300" id="kt_users_countries_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="">id</th>
                                        <th class="">Estado</th>
                                        <th class="">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn_save_countries">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
        <!--begin::Modal STANDDARDS-->
        <div class="modal fade"  id="kt_modal_standards">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Normas</h5>
                        <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                <label for="" class="form-label">Norma</label>
                                <select id="select_standard" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_standards" data-placeholder="Selecciona una norma" data-allow-clear="true">
                                    <option></option>
                                    @foreach($standards as $standard)
                                        <option value="{{$standard->id}}">{{$standard->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="d-none" id="user_id_standard">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-sm btn-flex btn-light-primary" id="btn_add_standard">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>Agregar</button>
                            </div>
                            <div class="fv-row mb-4">
                                <label class="required fs-6 fw-bold mb-2">Vigencia</label>
                                <input type="text" class="form-control" placeholder="Ingresa un nombre corto" name="validity" id="validity" autocomplete="off"/>
                            </div>

                        </div>
                        <div class="separator my-2"></div>
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
                            <table class="table table-row-dashed fs-6 gy-5 table-row-gray-300" id="kt_users_standards_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="">id</th>
                                        <th class="">Norma</th>
                                        <th class="">Vigencia</th>
                                        <th class="">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn_save_standards">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/admin/users.js')}}" type="module"></script>
@endsection
