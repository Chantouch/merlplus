@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Advertise</h3>
            <p class="text-muted m-b-30">Easy to managing your advertise</p>
            {!! Form::model($advertise, ['route' => ['admin.advertise.update', $advertise->id], 'method' => 'patch', 'files'=> true]) !!}
            @include('admin.advertise.fields')
            {!! Form::close() !!}
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
        $(function () {
            $('.summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false, // set focus to editable area after initializing summernote,
            });
        });
        let app = new Vue({
            el: '#app',
            data: {
                advertise_type: {!! $advertise_types !!},
                advertise: {
                    adv_type: {!! $advertise->ads_type->id !!},
                    is_video: {!! $advertise->is_video !!},
                }
            },
            created: function () {

            },
            methods: {
                isVideo() {
                    let vm = this;
                    $('.summernote').summernote({
                        height: 300, // set editor height
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