@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/dropzone-master/dist/dropzone.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('css/custom.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.page') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_page') !!}</p>
            {!! Form::open(['route' => ['admin.ref.page.store'], 'method' => 'POST', 'files'=> true]) !!}
            @include('ref.page.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jasny-bootstrap.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/summernote/dist/summernote.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/dropzone-master/dist/dropzone.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/sweetalert/sweetalert.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/sweetalert/jquery.sweet-alert.custom.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/post.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/dropZone.js') !!}"></script>
@stop

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tags: [],
                tag_lists: [],
                api_url: '/api/v1/',
                images: '',
            },
            created: function () {
                this.tagList();
            },
            methods: {
                tagList: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/tag')
                        .then((response) => {
                            vm.tag_lists = response.data;
                        })
                        .catch((response) => {

                        })
                },
                previewImage: function (event) {
                    // Reference to the DOM input element
                    let input = event.target;
                    // Ensure that you have a file before attempting to read it
                    if (input.files && input.files[0]) {
                        // create a new FileReader to read this image and convert to base64 format
                        let reader = new FileReader();
                        // Define a callback function to run, when FileReader finishes its job
                        reader.onload = (e) => {
                            // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                            // Read image as base64 and set to imageData
                            this.images = e.target.result
                        };
                        // Start the reader job - read file as a data url (base64 format)
                        reader.readAsDataURL(input.files[0]);
                    }
                },
                removeImage: function () {
                    let vm = this;
                    vm.images = '';
                },
            },
            watch: {
                tags: function (nv) {
                    this.tags = nv;
                }
            }
        });
        $(function () {
            $(".select2").select2();
        })
    </script>
@stop