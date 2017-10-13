@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.ads_type') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_advertise_type') !!}</p>
            {!! Form::open(['route' => ['admin.advertise-type.store'], 'method' => 'POST', 'files'=> true]) !!}
            @include('admin.advertise-type.fields')
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
            data: {},
            created: function () {

            },
            methods: {},
            watch: {}
        });
        $(function () {
            $(".select2").select2();
        })
    </script>
@stop