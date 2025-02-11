@extends('metronic.index')
@section('title', 'Embarques')
@section('zones', 'active')
@section('subtitle', 'Aperturar un documento DV')
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <div class="card shadow-sm">
            <form class="w-100 px-9" novalidate="novalidate" id="form_embarques">
                <div class="card-body">
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
                                <i class="ki-outline ki-message-question ms-1 fs-5" id="pp_procedencia" tabindex="0"></i>
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
                                <i class="ki-outline ki-message-question ms-1 fs-5" id="pp_procedencia" tabindex="0"></i>
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
                            <input type="text" class="form-control d-none" placeholder="Ingresa el número económico" name="vigencia_id" id="vigencia_id" value="{{$vigencias->id}}" />
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
                </div>
                <div class="card-footer">
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-estado-table-toolbar="base">
                            <button type="submit" id="btn_submit" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Espere un momento...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/embarques_small.js')}}" type="module"></script>
@endpush
