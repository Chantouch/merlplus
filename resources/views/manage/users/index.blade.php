<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/16/2017
 * Time: 10:12 PM
 */
?>
@extends('layouts.master')
@section('bootstrap')
    <link rel="stylesheet" href="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.css') !!}">
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Users</h3>
            <p class="text-muted m-b-30">Easy to managing your users</p>
            @include('manage.users.table')
        </div>
    </div>
@stop
@section('plugins')
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.ints.js') !!}"></script>
@stop