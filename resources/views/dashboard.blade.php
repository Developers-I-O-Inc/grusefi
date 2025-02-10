
@extends('metronic.index')
@section('title', 'Dashboard')
@section('subtitle', 'Menú Principal')
@section('content')
<div id="kt_content_container" class="container-xxl">
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">Vigencia de Normas</h3>
                </div>
                <div class="card-body pt-0">
                    @if(count($users_standards) > 0 && Auth::user()->hasRole(['tefs']))
                        @foreach($users_standards as $standards)
                            <div class="d-flex align-items-center bg-light-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} rounded p-5 mb-7">
                                <i class="ki-outline ki-award text-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} fs-2qx me-2"></i>
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">{{$standards->name}}</a>
                                    <span class="text-muted fw-bold d-block">Vence en {{$standards->days_remaining}} días</span>
                                </div>
                                <span class="fw-bolder text-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} py-1">{{$standards->validity}}</span>
                            </div>
                        @endforeach
                    @else
                        @if(!Auth::user()->hasRole(['Super Admin']))
                            <div class="card bg-light-danger h-md-100" dir="ltr">
                                <div class="card-body d-flex flex-column flex-center">
                                    <div class="mb-2">
                                        <h1 class="fw-semibold text-danger text-center lh-lg">
                                            No tienes normas <br> asignadas
                                            <span class="fw-bolder"> Pide a un administrador que las asigne</span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
