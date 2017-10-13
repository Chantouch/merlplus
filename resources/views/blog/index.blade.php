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
        <div class="rt-bk-cont">
            @if(count($top_right_ads))
                @foreach($top_right_ads as $ads)
                    @if($ads->hasBanner())
                        <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                            <a href="{!! $ads->url !!}" target="_blank">
                                <img alt="{!! $ads->provider_name !!}" class="img lazyload"
                                     data-src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                            <h2 class="cat-label cat-label4">
                                <a href="{!! $ads->url !!}">{!! $ads->provider_name !!}</a>
                            </h2>
                        </div>
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
                            <img alt="{!! $ads->banner()->original_filename !!}" class="lazyload"
                                 data-src="{!! asset($ads->banner()->media_url) !!}"/>
                        </li>
                    @endforeach
                @else
                    <li>
                        <img alt="No image" class="lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                             data-src="{!! asset('blog/img/samples/z2.jpg') !!}"/>
                    </li>
                @endif
            @endif
        </ul>
    </div>
@stop
@section('content')
    @include('blog.inc.section1')
    @include('blog.inc.top-news')
@stop