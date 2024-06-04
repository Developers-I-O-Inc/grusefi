@extends('layouts/app2')
@section('title', 'Dicatemn de Verificación')
@section('title_top', 'Dictamen de Verificación')
@section('subtitle_top', 'Nuevo Documento')
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="py-5" id="prueba">
                sdkjfhksdjfkhjhjk
            </div>
        </div>
        <div class="card">
            <div class="py-5">
                <textarea id="kt_docs_tinymce_hidden" name="kt_docs_tinymce_hidden" class="tox-target">
                    <h1>Quick and Simple TinyMCE 5 Integration</h1>
                    <p>Here goes the&#160;
                    <a href="#">Minitial content of the editor</a>. Lorem Ipsum is simply dummy text of the&#160;
                    <em>printing and typesetting</em>&#160;industry.</p>
                    <blockquote>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</blockquote>
                    <h3 style="text-align: right;">Flexible &amp; Powerful</h3>
                    <p style="text-align: right;">
                    <strong>Lorem Ipsum has been the industry's</strong>&#160;standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                    <ul>
                        <li id="prueba">List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                        <li>List item 4</li>
                    </ul>
                </textarea>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/hidden.js')}}"></script>
    {{-- <script src="assets/js/custom/documentation/editors/tinymce/hidden.js"></script> --}}
    {{-- <script src="assets/plugins/custom/tinymce/tinymce.bundle.js"></script> --}}
    {{-- <script src="{{asset('assets/js/admin/roles.js')}}"></script> --}}
@endsection
