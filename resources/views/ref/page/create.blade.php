@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Page</h3>
            <p class="text-muted m-b-30">Easy to managing your page</p>
            {!! Form::open(['route' => ['admin.ref.page.store'], 'method' => 'POST', 'files'=> true]) !!}
            @include('ref.page.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tags: [],
                tag_lists: [],
                api_url: '/api/v1/'
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
                }
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