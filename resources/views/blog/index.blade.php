<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/21/2017
 * Time: 10:23 PM
 */
?>
@extends('layouts.blog.app')
@section('css')
    <style>
        .top-news .tn-small-1 img {
            height: 85px !important;
        }
    </style>
@stop
@section('main-news-block')
    <div class="main-news-blks">
        <div class="hm-slider-cont">
            @include('blog.inc.hm-news-slider')
        </div>

        <div class="rt-bk-cont">
            @if(count($top_right_ads))
                @foreach($top_right_ads as $ads)
                    @if($ads->hasBanner())
                        <a href="{!! $ads->url !!}" target="_blank">
                            <div class="rt-block mid-block-1 boxgrid2 caption">
                                <img alt="{!! $ads->provider_name !!}" class="img"
                                     src="{!! asset($ads->banner()->media_url) !!}"/>
                                <h2 class="cat-label cat-label4">
                                    <a href="{!! $ads->url !!}">{!! $ads->provider_name !!}</a>
                                </h2>
                            </div>
                        </a>
                    @else
                        <div class="rt-block mid-block-1 boxgrid2 caption item">
                            {!! $ads->url !!}
                            <h2 class="cat-label cat-label4">
                                <a href="{!! $ads->url !!}">{!! $ads->provider_name !!}</a>
                            </h2>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@stop
@section('main_right_ads_bar')
    <div class="flexslider sm-sldr">
        <ul class="slides">
            @if(isset($home_top_news_slider))
                @if(count($home_top_news_slider))
                    @foreach($home_top_news_slider->take(3) as $ads)
                        <li>
                            <img alt="{!! $ads->banner()->original_filename !!}"
                                 src="{!! asset($ads->banner()->media_url) !!}"/>
                        </li>
                    @endforeach
                @else
                    <li>
                        <img alt="No image" src="{!! asset('blog/img/samples/z2.jpg') !!}"/>
                    </li>
                @endif
            @endif
        </ul>
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
@stop
