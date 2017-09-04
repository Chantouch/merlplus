@extends('layouts.master')
@section('bootstrap')
    <link rel="stylesheet" href="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.css') !!}">
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Roles</h3>
            <p class="text-muted m-b-30">Easy to managing your role</p>
            @include('manage.permissions.table')
        </div>
    </div>
@stop
@section('plugins')
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.ints.js') !!}"></script>
@stop