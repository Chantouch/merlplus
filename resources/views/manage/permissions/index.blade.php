@extends('layouts.master')
@section('bootstrap')
    <link rel="stylesheet" href="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.css') !!}">
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.permission') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_permission') !!}</p>
            @include('manage.permissions.table')
        </div>
    </div>
@stop
@section('plugins')
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.ints.js') !!}"></script>
@stop