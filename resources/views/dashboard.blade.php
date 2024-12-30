
@extends('layouts/app2')
@section('title', 'Dashboard')
@section('title_top', 'Dashboard')
@section('subtitle_top', 'Menú Principal')
@section('content')
<div id="kt_content_container" class="container-xxl">
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">Vigencia de Normas</h3>
                </div>
                <div class="card-body pt-0">
                    @foreach($users_standards as $standards)
                        <div class="d-flex align-items-center bg-light-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} rounded p-5 mb-7">
                            <span class="svg-icon svg-icon-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} me-5">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"></path>
                                        <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"></path>
                                    </svg>
                                </span>
                            </span>
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">{{$standards->name}}</a>
                                <span class="text-muted fw-bold d-block">Vence en {{$standards->days_remaining}} días</span>
                            </div>
                            <span class="fw-bolder text-{{$standards->days_remaining > 30 ? 'success' : 'danger'}} py-1">{{$standards->validity}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
