@extends('layouts.master')
@section('style')
    <style>
        .img-thumbnail{
            background-color: #0b97c4;
        }
    </style>
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.tags') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_tag') !!}</p>
            @include('ref.tag.table')
        </div>
    </div>
@stop