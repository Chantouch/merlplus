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
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title m-b-0">{!! __('admin.user') !!}</h3>
                    <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_users') !!}</p>
                </div>
                <div class="col-md-4">
                    <a href="{!! url('admin/manage/user/create') !!}" class="btn btn-outline btn-primary pull-right">@lang('users.new_users')</a>
                </div>
            </div>
            @include('manage.users.table')
        </div>
    </div>
@stop
@section('plugins')
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-table/dist/bootstrap-table.ints.js') !!}"></script>
@stop