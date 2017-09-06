@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <div class="col-md-12">
                <h3 class="box-title m-b-0">Upload Media Files </h3>
                <p class="text-muted m-b-30"> Drop files anywhere to upload</p>
                {!! Form::open([ 'route' => [ 'admin.media-library.store' ], 'files' => true, 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
                <div class="fallback">
                    <input name="file" type="file" multiple/>
                </div>
                {!! Form::close() !!}
                <p class="m-t-20">Maximum upload file size: 100 MB.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop

@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jasny-bootstrap.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/summernote/dist/summernote.min.js') !!}"></script>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                advertise_type: {!! $advertise_types !!},
                advertise: {
                    adv_type: '',
                    is_video: false,
                }
            },
            created: function () {

            },
            methods: {
                isVideo() {
                    let vm = this;
                    $('.summernote').summernote({
                        height: 350, // set editor height
                        minHeight: null, // set minimum height of editor
                        maxHeight: null, // set maximum height of editor
                        focus: false, // set focus to editable area after initializing summernote,
                    });
                }
            },
            watch: {}
        });
        $(function () {
            $(".select2").select2();
        })
    </script>
@stop