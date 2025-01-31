@extends('metronic.index')
@section('title', 'Embarques')
@section('title_top', 'Embarques')
@section('embarques', 'active')
@section('subtitle_top', 'Control de Embarques')
@section('content')
    <div id="kt_content_container bg-light-primary" class="container-xxl">
        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="stepper_embarques">
            <div class="d-flex justify-content-center bg-body rounded justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9 shadow-sm">
                <div class="px-6 px-lg-10 px-xxl-15 py-10">
                    <div class="stepper-nav">
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">General</h3>
                                <div class="stepper-desc fw-bold">Detalles generales del embarque</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Normas</h3>
                                <div class="stepper-desc fw-bold">Agregar normas o maquiladores del embarque</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">3</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Productos</h3>
                                <div class="stepper-desc fw-bold">Agregar los productos del embarque</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">4</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Consolidado</h3>
                                <div class="stepper-desc fw-bold">standardr embarque consolidado o mixto</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">5</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Trasporte</h3>
                                <div class="stepper-desc fw-bold">Agregar datos de transporte</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check ki-outline ki-double-check fs-2x"></i>
                                <span class="stepper-number">6</span>
                            </div>
                            <div class="stepper-tittle">
                                <h3 class="stepper-title">Completado</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row-fluid flex-center bg-body rounded shadow-sm">
                <form class="py-20 w-100 px-9" novalidate="novalidate" id="form_embarques">
                    <div data-kt-stepper-element="content" class="current">
                        <div class="w-100">
                            <div class="row mb-4">
                                @role(["Super Admin", "Admin"])
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Usuario TEF´s</label>
                                        <select id="tefs_id" name="tefs_id" class="form-select" data-control="select2" data-placeholder="Selecciona un usuario" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($users as $users)
                                                <option value="{{$users->id}}">{{$users->name.' '.$users->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">País</label>
                                        <select id="pais_id" name="pais_id" class="form-select" data-control="select2" data-placeholder="Selecciona un país" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($paises as $pais)
                                                <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Procedencia</label>
                                        <select id="municipio_id" name="municipio_id" class="form-select" data-control="select2" data-placeholder="Selecciona un municipio" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($lugares as $lugar)
                                                <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">País</label>
                                        <select id="pais_id" name="pais_id" class="form-select" data-control="select2" data-placeholder="Selecciona un país" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($paises as $pais)
                                                <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Procedencia</label>
                                        <select id="municipio_id" name="municipio_id" class="form-select" data-control="select2" data-placeholder="Selecciona un municipio" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($lugares as $lugar)
                                                <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endrole
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Cliente</label>
                                    <input type="text" class="form-control d-none" placeholder="Ingresa el número económico" name="vigencia_id" id="vigencia_id" value="{{$vigencia->id}}" />
                                    <select id="empaque_id" name="empaque_id" class="form-select" data-control="select2" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($empaques as $empaque)
                                            <option value="{{$empaque->id}}">{{$empaque->nombre_fiscal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Destinatario</label>
                                    <select id="destinatario_id" name="destinatario_id" class="form-select" data-control="select2" data-placeholder="Selecciona un destinatario" data-allow-clear="true">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Puerto de Entrada</label>
                                    <select id="puerto_id" name="puerto_id" class="form-select" data-control="select2" data-placeholder="Selecciona un puerto" data-allow-clear="true">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-bold mb-2">N° Económico</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el número económico" name="numero_economico" id="numero_economico" autocomplete="off" />
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Placas</label>
                                    <input type="text" class="form-control" placeholder="Ingresa las placas" name="placas_trasporte" id="placas_trasporte" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Lugar</label>
                                    <select id="lugar_id" name="lugar_id" class="form-select" data-control="select2" data-placeholder="Selecciona un municipio" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($lugares as $lugar)
                                            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Uso</label>
                                    <select id="uso_id" name="uso_id" class="form-select" data-control="select2" data-placeholder="Selecciona un uso" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($usos as $uso)
                                            <option value="{{$uso->id}}">{{$uso->uso}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="row mb-12">
                                <div class="col-9">
                                    <select id="select_standard" class="form-select" data-control="select2" data-placeholder="Selecciona una norma" data-allow-clear="true">
                                        <option></option>
                                        @foreach($standards as $standard)
                                            <option value="{{$standard->id}}">{{$standard->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-md-6 fv-row d-none">
                                        <input class="form-control" placeholder="Seleccione Fecha" id="edit_standards" name="edit_standards"/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-flex btn-light-success" id="btn_add_standard">
                                        <i class="ki-outline ki-plus fs-2"></i>
                                        </span>Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <table class="table table-row-bordered gy-5" id="kt_standards_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="">id</th>
                                            <th class="">Normas</th>
                                            <th class="">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">

                                    </tbody>
                                </table>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="row mb-12">
                                <div class="col-9">
                                    <select id="select_maquiladores" class="form-select" data-control="select2" data-placeholder="Selecciona un maquilador" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-flex btn-light-success" id="btn_add_maquilador">
                                       <i class="ki-outline ki-plus fs-2"></i>
                                        </span>Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <table class="table table-row-bordered gy-5" id="kt_maquiladores_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="">id</th>
                                            <th class="">Maquilador</th>
                                            <th class="">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="col-md-6 fv-row d-none">
                                <input class="form-control" placeholder="Seleccione Fecha" id="edit_products" name="edit_products"/>
                            </div>
                            <button class="btn btn-flex btn-light-success" id="btn_add_products">
                                <i class="ki-outline ki-plus fs-2"></i>
                                </span>Agregar Productos
                            </button>
                            <div class="form-check form-switch form-check-custom form-check-solid mt-5">
                                <input class="form-check-input" type="checkbox" value="" id="check_import"/>
                                <label class="form-check-label" for="check_import">
                                    Importar Excel
                                </label>
                            </div>
                            <div class="row mb-12">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <x-table-products />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bolder text-dark">Empaque Consolidado</h2>
                                <div class="text-muted fw-bold fs-6">Si el empaque esta consolidado, seleccione</div>
                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">Empaque</span>
                                </label>
                                <select id="consolidado_id" name="consolidado_id" class="form-select" data-control="select2" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <input class="form-check-input" type="checkbox" value="0" id="check_activo" name="check_activo"/>
                                <label class="form-check-label" for="activo">
                                    Consolidado
                                </label>
                            </div>
                            <input type="text" class="form-control d-none" name="consolidado" id="consolidado" value="0"/>
                        </div>

                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bolder text-dark">Trasporte</h2>
                                <div class="text-muted fw-bold fs-6">Ingrese los datos del transporte</div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Empresa Transportista</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el nombre de la empresa transportista" name="empresa_transporte" id="empresa_transporte" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Nombre del chofer</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el nombre del chofer" name="chofer" id="chofer" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-8 pb-lg-10">
                                <h2 class="fw-bolder text-dark">Embarque terminado!</h2>
                                <div class="text-muted fw-bold fs-6">Información almacenada correctamente</div>
                            </div>
                            <div class="mb-0">
                                <div class="fs-6 text-gray-600 mb-5">Alguna Información del embarque se genera directamente en la plantilla por país, si desea cambiar algún dato.
                                    <a href="{{route('plantillas_rpv')}}" class="link-success fw-bolder">ingresa aquí</a>
                                </div>
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                        <i class="ki-outline ki-information-5 fs-2qx text-warning"></i>
                                    </span>
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">Notificaciones!</h4>
                                            <div class="fs-6 text-gray-700">Si desea imprimir el formato para vizualizarlo
                                            <a href="#" class="fw-bolder link-success" id="link_dictamen" target="_blank">presione aquí</a></div>
                                            <div class="fs-6 text-gray-700">O si desea generar o editar el RPV
                                            <a href="#" class="fw-bolder link-success" id="link_consulta">presione aquí</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-10">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                            <span class="svg-icon svg-icon-4 me-1">
                                <i class="ki-outline ki-double-left fs-1"></i>
                            </span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label">Guardar
                                <i class="ki-outline ki-double-right fs-1"></i>
                                <span class="indicator-progress">Espera...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continuar
                            <i class="ki-outline ki-double-right fs-1"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_product_form">
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Agregar Productos</h2>
                            <div id="kt_modal_add_product_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                <x-fields_products :variedades="$variedades" :presentaciones="$presentaciones"/>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="button" id="cancel_modal"
                                class="btn btn-light me-3">Cancelar</button>
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
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/embarques.js')}}" type="module"></script>
@endpush
