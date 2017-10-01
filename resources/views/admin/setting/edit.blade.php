@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Advertise</h3>
            <p class="text-muted m-b-30">Easy to managing your advertise</p>
            {!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'method' => 'patch', 'files'=> true]) !!}
            @include('admin.setting.fields')
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
            data: {},
            created: function () {

            },
            methods: {},
            watch: {}
        });
    </script>
@stop