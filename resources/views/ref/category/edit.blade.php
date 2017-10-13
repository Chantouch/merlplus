@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.category') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_category') !!}</p>
            {!! Form::model($category, ['route' => ['admin.ref.category.update', $category->id], 'method' => 'patch', 'files'=> true]) !!}
            @include('ref.category.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jasny-bootstrap.js') !!}"></script>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tags: {!! $category->tags->pluck('id') !!},
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