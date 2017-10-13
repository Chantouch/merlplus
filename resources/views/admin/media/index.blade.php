@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/dropzone-master/dist/dropzone.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('style')
    <style>
        .input-hidden {
            position: absolute;
            left: -9999px;
        }

        input[type=radio]:checked + label > img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #090;
        }

        /* Stuff after this is only to make things more pretty */
        input[type=radio] + label > img {
            border: 1px dashed #444;
            width: 150px;
            height: 120px;
            transition: 500ms all;
        }

        input[type=radio]:checked + label > img {
            transform: rotateZ(-10deg) rotateX(10deg);
        }

    </style>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">
                {!! __('admin.media') !!}
            </h3>
            <p class="text-muted m-b-10">{!! __('admin.easy_to_managing_your_media') !!}</p>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#media-library" aria-controls="media-library" role="tab" data-toggle="tab"
                       aria-expanded="true" @click.prevent="fetchMediaLibrary">
                        <span class="visible-xs"><i class="ti-home"></i></span>
                        <span class="hidden-xs"> {!! __('admin.media_library') !!}</span>
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#upload-files" aria-controls="upload-files" role="tab" data-toggle="tab"
                       aria-expanded="false">
                        <span class="visible-xs"><i class="ti-user"></i></span>
                        <span class="hidden-xs">{!! __('admin.upload_file') !!}</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="media-library">
                    @include('admin.media.table')
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="upload-files">
                    {!! Form::open([ 'route' => [ 'admin.media-library.store' ], 'files' => true, 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                    {!! Form::close() !!}
                    <p class="m-t-20">{!! __('admin.maximum_upload_file_size') !!}</p>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="insert-media" disabled>
                       {!! __('admin.insert_media') !!}
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.media.edit-media')
@stop
@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/sweetalert/sweetalert.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/sweetalert/jquery.sweet-alert.custom.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/dropzone-master/dist/dropzone.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/dropZone.js') !!}"></script>
@stop
@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                mediaLibrary: {},
                mediaLibraryDetails: {
                    id: '',
                    alt_text: '',
                    caption: '',
                    description: '',
                    title: '',
                    uploaded_at: '',
                    limit_name: '',
                    mime_type: '',
                    url: ''
                }
            },
            created: function () {
                this.fetchMediaLibrary();
            },
            methods: {
                fetchMediaLibrary() {
                    let vm = this;
                    vm.$http.get('/api/v1/media-library').then(response => {
                        vm.mediaLibrary = response.data;
                    })
                },
                editMedia: function ($id) {
                    let vm = this;
                    $('#edit-media').modal({
                        'show': true,
                        'backdrop': false,
                    });
                    vm.$http.get('/api/v1/media-library/' + $id).then(response => {
                        vm.mediaLibraryDetails.id = response.data.id;
                        vm.mediaLibraryDetails.url = response.data.url;
                        vm.mediaLibraryDetails.uploaded_at = response.data.uploaded_at;
                        vm.mediaLibraryDetails.limit_name = response.data.limit_name;
                        vm.mediaLibraryDetails.mime_type = response.data.mime_type;
                        vm.mediaLibraryDetails.alt_text = response.data.alt_text;
                        vm.mediaLibraryDetails.caption = response.data.caption;
                        vm.mediaLibraryDetails.description = response.data.description;
                        vm.mediaLibraryDetails.title = response.data.title;
                    })
                },
                editMediaLibraryDetail: function ($id) {
                    let vm = this;
                    let input = vm.mediaLibraryDetails;
                    vm.$http.patch('/api/v1/media-library/' + $id, input).then((response) => {
                        $.toast({
                            heading: 'Welcome to my Elite admin',
                            text: 'Media details updated!',
                            position: 'top-right',
                            loaderBg: '#002eff',
                            icon: 'info',
                            hideAfter: 3000,
                            stack: 6
                        });
                    });
                    vm.fetchMediaLibrary();
                },
                deleteMediaLibrary: function ($id) {
                    let vm = this;
                    console.log($id);
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            vm.$http.delete('/api/v1/media-library/' + $id).then(response => {
                                swal("Deleted!", response.data.data, "success");
                                $('#edit-media').modal('toggle');
                            }).catch(err => {

                            });
                            vm.fetchMediaLibrary();
                        } else {
                            swal("Cancelled", "Your file is safe :)", "error");
                        }
                    });
                }
            },
            watch: {}
        });

    </script>
@stop