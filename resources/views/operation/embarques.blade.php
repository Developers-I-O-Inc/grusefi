@extends('layouts/app2')
@section('styles')
    <link href="{{asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('title', 'Embarques')
@section('title_top', 'Embarques')
@section('embarques', 'active')
@section('subtitle_top', 'Control de Embarques')
@section('content')
    <div id="kt_content_container bg-light-primary" class="container-xxl">
        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="stepper_embarques">
            <div class="d-flex justify-content-center bg-body rounded justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9">
                <div class="px-6 px-lg-10 px-xxl-15 py-10">
                    <div class="stepper-nav">
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
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
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Marcas</h3>
                                <div class="stepper-desc fw-bold">Agregar marcas o maquiladores del embarque</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
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
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">4</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Consolidado</h3>
                                <div class="stepper-desc fw-bold">Marcar embarque consolidado o mixto</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
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
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">6</span>
                            </div>
                            <div class="stepper-tittle">
                                <h3 class="stepper-title">Completado</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row-fluid flex-center bg-body rounded">
                <form class="py-20 w-100 w-xl-900px px-9" novalidate="novalidate" id="form_embarques">

                    <div class="current" data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="row mb-12">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Fecha Embarque</label>
                                    <input class="form-control form-control-solid" placeholder="Seleccione Fecha" id="fecha_embarque" name="fecha_embarque"/>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">País</label>
                                    <select id="pais_id" name="pais_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un país" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($paises as $pais)
                                            <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Empaque</label>
                                    <select id="empaque_id" name="empaque_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($empaques as $empaque)
                                            <option value="{{$empaque->id}}">{{$empaque->nombre_fiscal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Destinatario</label>
                                    <select id="destinatario_id" name="destinatario_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un destinatario" data-allow-clear="true">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Usuario TEF´s</label>
                                    <select id="id_tefs" name="id_tefs" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un empaque" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($users as $users)
                                            <option value="{{$users->id}}">{{$users->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Inspector</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa el nombre de la categoría" name="inspector" id="inspector" />
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-md-4 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Puerto de Entrada</label>
                                    <select id="puerto_id" name="puerto_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un puerto" data-allow-clear="true">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-bold mb-2">N° Económico</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa el nombre de la categoría" name="numero_economico" id="numero_economico" />
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-bold mb-2">Placas</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Ingresa el nombre de la categoría" name="placas" id="placas" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="row mb-12">
                                <div class="col-9">
                                    <select id="select_marca" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona una marca" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                    <div class="col-md-6 fv-row d-none">
                                        <label class="required fs-6 fw-bold mb-2">Fecha Embarque</label>
                                        <input class="form-control form-control-solid" placeholder="Seleccione Fecha" id="edit_marcas" name="edit_marcas"/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-flex btn-light-primary" id="btn_add_marca">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                        </span>Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="kt_marcas_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="">id</th>
                                            <th class="">Marca</th>
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
                                    <select id="select_maquiladores" class="form-select form-select-solid" data-control="select2" data-placeholder="Selecciona un maquilador" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-flex btn-light-primary" id="btn_add_maquilador">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                        </span>Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <table class="table table-row-dashed fs-6 gy-5 table-row-gray-300" id="kt_maquiladores_table">
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

                            <div class="pb-10 pb-lg-12">

                                <h2 class="fw-bolder text-dark">Business Details</h2>


                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>

                            </div>


                            <div class="fv-row mb-10">

                                <label class="form-label required">Business Name</label>


                                <input name="business_name" class="form-control form-control-lg form-control-solid" value="Keenthemes Inc." />

                            </div>


                            <div class="fv-row mb-10">

                                <label class="d-flex align-items-center form-label">
                                    <span class="required">Shortened Descriptor</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
                                </label>


                                <input name="business_descriptor" class="form-control form-control-lg form-control-solid" value="KEENTHEMES" />


                                <div class="form-text">Customers will see this shortened version of your statement descriptor</div>

                            </div>


                            <div class="fv-row mb-10">

                                <label class="form-label required">Corporation Type</label>


                                <select name="business_type" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                    <option></option>
                                    <option value="1">S Corporation</option>
                                    <option value="1">C Corporation</option>
                                    <option value="2">Sole Proprietorship</option>
                                    <option value="3">Non-profit</option>
                                    <option value="4">Limited Liability</option>
                                    <option value="5">General Partnership</option>
                                </select>

                            </div>


                            <div class="fv-row mb-10">

                                <label class="form-label">Business Description</label>


                                <textarea name="business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>

                            </div>


                            <div class="fv-row mb-0">

                                <label class="fs-6 fw-bold form-label required">Contact Email</label>


                                <input name="business_email" class="form-control form-control-lg form-control-solid" value="corp@support.com" />

                            </div>

                        </div>

                    </div>


                    <div data-kt-stepper-element="content">

                        <div class="w-100">

                            <div class="pb-10 pb-lg-15">

                                <h2 class="fw-bolder text-dark">Billing Details</h2>


                                <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                <a href="#" class="text-primary fw-bolder">Help Page</a>.</div>

                            </div>


                            <div class="d-flex flex-column mb-7 fv-row">

                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">Name On Card</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
                                </label>

                                <input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe" />
                            </div>


                            <div class="d-flex flex-column mb-7 fv-row">

                                <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>


                                <div class="position-relative">

                                    <input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111" />


                                    <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                        <img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px" />
                                        <img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px" />
                                        <img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px" />
                                    </div>

                                </div>

                            </div>


                            <div class="row mb-10">

                                <div class="col-md-8 fv-row">

                                    <label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>


                                    <div class="row fv-row">

                                        <div class="col-6">
                                            <select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
                                                <option></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>


                                        <div class="col-6">
                                            <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
                                                <option></option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                                <option value="2031">2031</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-4 fv-row">

                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">CVV</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
                                    </label>


                                    <div class="position-relative">

                                        <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />


                                        <div class="position-absolute translate-middle-y top-50 end-0 me-3">

                                            <span class="svg-icon svg-icon-2hx">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M22 7H2V11H22V7Z" fill="black" />
                                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black" />
                                                </svg>
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="d-flex flex-stack">

                                <div class="me-5">
                                    <label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
                                    <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
                                </div>


                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                    <span class="form-check-label fw-bold text-muted">Save Card</span>
                                </label>

                            </div>

                        </div>

                    </div>


                    <div data-kt-stepper-element="content">

                        <div class="w-100">

                            <div class="pb-8 pb-lg-10">

                                <h2 class="fw-bolder text-dark">Your Are Done!</h2>


                                <div class="text-muted fw-bold fs-6">If you need more info, please
                                <a href="../../demo6/dist/authentication/sign-in/basic.html" class="link-primary fw-bolder">Sign In</a>.</div>

                            </div>


                            <div class="mb-0">

                                <div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as much an art as it is a science and probably warrants its own post, but for all advise is with what works for your great &amp; amazing audience.</div>



                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">


                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                        </svg>
                                    </span>



                                    <div class="d-flex flex-stack flex-grow-1">

                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                                            <div class="fs-6 text-gray-700">To start using great tools, please, please
                                            <a href="#" class="fw-bolder">Create Team Platform</a></div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                    <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                </svg>
                            </span>

                        </div>


                        <div>
                            <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label">Submit

                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                    </svg>
                                </span>

                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue

                            <span class="svg-icon svg-icon-4 ms-1 me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                </svg>
                            </span>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"
        integrity="sha512-axXaF5grZBaYl7qiM6OMHgsgVXdSLxqq0w7F4CQxuFyrcPmn0JfnqsOtYHUun80g6mRRdvJDrTCyL8LQqBOt/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> --}}
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/operation/embarques.js')}}" type="module"></script>
@endsection
