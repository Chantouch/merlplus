@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/dropzone-master/dist/dropzone.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    {!! Form::open(['route' => ['admin.article.store'], 'method' => 'POST', 'files'=> true, 'class'=>'form-horizontal']) !!}
    @include('article.fields')
    {!! Form::close() !!}
    @include('article.add-media')
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
@stop

@section('scripts')
    <script>

        let app = new Vue({
            el: '#app',
            data: {
                tag_lists: [],
                api_url: '/api/v1/',
                status: false,
                edit: true,
                article: {
                    status: 'draft',
                    category: [],
                    tags: [],
                },
                images: '',
                categories: [],
                newCat: {
                    'newcategory': '',
                    'parent_cat': ''
                },
                showCat: false,
                formErrors: {},
                item: {
                    category: [1]
                },
                newTag: {
                    'name': ''
                },
                mediaLibrary: {},
                posted_at: {
                    date: '',
                    time: '',
                    now_label: 'Immediately',
                    schedule: '',
                    edit: true,
                    now: ''
                },
                visibility: false,
                mediaLibraryDetails: {
                    id: '',
                    alt_text: '',
                    caption: '',
                    description: '',
                    title: '',
                    url: ''
                },
                mediaLibraryDetailsChecked: false,
            },
            created: function () {
                this.tagList();
                this.categoryList();
                //this.getMediaLibrary();
            },
            methods: {
                tagList: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/tag').then((response) => {
                        vm.tag_lists = response.data;
                    })
                },
                categoryList: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/category').then((response) => {
                        this.categories = response.data;
                    })
                },
                toastMessage: function ($message, $type, $loaderBg) {
                    $.toast({
                        heading: 'Welcome to my Elite admin',
                        text: $message,
                        position: 'top-right',
                        loaderBg: $loaderBg,
                        icon: $type,
                        hideAfter: 3000,
                        stack: 6
                    });
                },
                showStatus: function () {
                    let vm = this;
                    vm.status = true;
                    vm.edit = false;
                },
                cancelStatus: function () {
                    let vm = this;
                    vm.status = false;
                    vm.edit = true;
                },
                changeStatus: function () {
                    let vm = this;
                    vm.status = false;
                    vm.edit = true;
                },
                newTags: function () {
                    let vm = this;
                    let input = this.newTag;
                    vm.$http.post('/api/v1/tag', input).then(response => {
                        if (response.data.fail) {
                            vm.formErrors = response.data.errors;
                        } else {
                            this.newTag = {
                                'name': ''
                            };
                            vm.formErrors = '';
                            $.toast({
                                heading: 'Welcome to my Elite admin',
                                text: 'Tag ' + response.data.name + ' added successfully',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 6
                            });
                            vm.tagList();
                        }
                    })
                },
                newCategory: function () {
                    let vm = this;
                    let input = this.newCat;
                    vm.$http.post('/api/v1/category', input).then(response => {
                        if (response.data.fail) {
                            vm.formErrors = response.data.errors;
                        } else {
                            this.newCat = {
                                'name': '',
                                'parent': ''
                            };
                            vm.formErrors = '';
                            this.showCat = false;
                            alert('Category ' + response.data.name + ' added successfully');
                            vm.categoryList();
                        }
                    })
                },
                showCategory: function () {
                    this.showCat = true;
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
                addMedia: function (e) {
                    e.preventDefault();
                    $('#add-media').modal({
                        'show': true,
                        'backdrop': false,
                    });
                    this.getMediaLibrary();
                },
                getMediaLibrary: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/media-library').then((response) => {
                        vm.mediaLibrary = response.data;
                    });
                },
                editMediaLibraryDetail: function ($id) {
                    let vm = this;
                    let input = vm.mediaLibraryDetails;
                    vm.$http.patch('/api/v1/media-library/' + $id, input).then((response) => {
                        vm.toastMessage(response.data, 'info', '#ff6849');
                        this.getMediaLibrary();
                    }).catch(error => {

                    })
                },
                schedulePost: function () {
                    let vm = this;
                    vm.posted_at.schedule = true;
                    vm.posted_at.edit = false;
                    let now = new Date();
                    let day = ("0" + now.getDate()).slice(-2);
                    let month = ("0" + (now.getMonth() + 1)).slice(-2);
                    vm.posted_at.date = now.getFullYear() + "-" + (month) + "-" + (day);
                    let h = now.getHours();
                    let m = now.getMinutes();
                    if (h < 10) h = '0' + h;
                    if (m < 10) m = '0' + m;
                    vm.posted_at.time = h + ':' + m;
                    vm.posted_at.now = vm.posted_at.date + ' ' + vm.posted_at.time;
                },
                mediaLibraryDetail: function ($id) {
                    let vm = this;
                    vm.$http.get('/api/v1/media-library/' + $id).then(response => {
                        vm.mediaLibraryDetailsChecked = true;
                        vm.mediaLibraryDetails = response.data;
                    }).catch(error => {

                    })
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
                            }).catch(err => {

                            });
                            vm.getMediaLibrary();
                        } else {
                            swal("Cancelled", "Your file is safe :)", "error");
                        }
                    });
                },

                copyText: function () {
                    let vm = this;
                    vm.$refs.url.select();
                    let copied = document.execCommand('copy');
                    if (copied) {
                        vm.toastMessage('Url copied, Please pasted insert image url', 'info', '#3720ff');
                    }
                }
            },
            watch: {
                tags: function (nv) {
                    this.tags = nv;
                },
            }
        });
    </script>
@stop