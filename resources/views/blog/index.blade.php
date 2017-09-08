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
            @include('blog.inc.hm-news-slider')
        </div>
        @include('blog.inc.fix-block')
    </div>
@stop
@section('content')
    <!-- Top News Section -->
    {{--<div class="top-news float-width">--}}
        {{--@include('blog.inc.top-news')--}}
    {{--</div>--}}

    <!-- Section 1 -->
    @include('blog.inc.section1')
    <!--End Section 1--->
@stop
