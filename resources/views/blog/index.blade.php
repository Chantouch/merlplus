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
                @foreach($top_right_ads as $index => $ads)
                    @if($ads->hasBanner())
                        <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                            <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                <img alt="{!! $ads->provider_name !!}" class="img lazyload"
                                     src="{!! asset('blog/img/blur.png') !!}"
                                     data-src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                            <h2 class="cat-label cat-label4">
                                <a href="{!! $ads->url !!}">{!! $ads->provider_name !!}</a>
                            </h2>
                        </div>
                    @endif
                    @if($index < 2)
                        <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                            <a href="{!! route('blog.contact.index') !!}">
                                <img alt="Place your ads here" class="img lazyload"
                                     src="{!! asset('blog/img/blur.png') !!}"
                                     data-src="{!! asset('images/ads-300x250.png') !!}"/>
                            </a>
                            <h2 class="cat-label cat-label4">
                                <a href="{!! route('blog.contact.index') !!}">Contact Us</a>
                            </h2>
                        </div>
                    @endif
                @endforeach
            @else
                @for($x = 0; $x <= 1; $x++)
                    <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                        <a href="{!! route('blog.contact.index') !!}">
                            <img alt="Place your ads here" class="img lazyload"
                                 src="{!! asset('blog/img/blur.png') !!}"
                                 data-src="{!! asset('images/ads-300x250.png') !!}"/>
                        </a>
                        <h2 class="cat-label cat-label4">
                            <a href="{!! route('blog.contact.index') !!}">Contact Us</a>
                        </h2>
                    </div>
                @endfor
            @endif
        </div>
    </div>
@stop
@section('content')
    @include('blog.inc.section1')
    @include('blog.inc.top-news')
@stop