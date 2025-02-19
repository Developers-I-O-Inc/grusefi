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
                            <button type="button" class="btn btn-active-dark active " data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" id="btn_search">
                                <i class="ki-outline ki-magnifier fs-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="card table-responsive py-6">
                <x-table-rpv :embarque="true" :vigencias="$vigencias" :puertos="$puertos" :lugares="$lugares" :empaques="$empaques" :usos="$usos"></x-table-rpv>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/new_dv_template.js')}}" type="module"></script>
@endpush
