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
    <div class="top-news float-width">
        @include('blog.inc.top-news')
    </div>

    <!-- Section 1 -->
    @include('blog.inc.section1')
    <!--End Section 1--->

    <!-- News slider -->
    <div class="qk-slider float-width">
        <h3 class="sldr-title">slider</h3>
        <div class="flexslider news-sldr">
            @include('blog.inc.news-slider')
        </div>
    </div>
    <!-- POLLS AND REVIEWS -->
    <div class="news-sec-2 float-width">
        <div class="float-width sec-cont3">
            @include('blog.inc.poll-review')
        </div>
    </div>
    <!-- Images news with slider -->
    <div class="sm-gal-cont float-width">
        @include('blog.inc.image-news-slider')
    </div>
    <!-- Videos Section -->
    <div class="vid-gal float-width">
        @include('blog.inc.video-section')
    </div>
@stop
