<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/21/2017
 * Time: 10:23 PM
 */
?>
@extends('layouts.blog.app')
@section('main-news-block')
    <div class="main-news-blks">
        <div class="hm-slider-cont">
            @include('blog/inc/hm-news-slider')
        </div>
        @include('blog/_components/_right_ads')
    </div>
@stop
@section('content')
    @include('blog/inc/section1')
    @include('blog/inc/top-news')
@stop