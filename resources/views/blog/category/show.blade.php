<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 5:01 PM
 */
?>
@extends('layouts.blog.app')

@section('main_right_ads_bar')
    @include('blog._components.single-ads-bar')
@stop
@section('new_article_single_article')
    @if($new_posts->count())
        <div class="panel panel-info pos-relative">
            @include('blog._components.latest-post')
        </div>
    @endif
    @if($most_read->count())
        <div class="panel panel-info pos-relative">
            @include('blog._components.most-read')
        </div>
    @endif
@stop
@section('content')
    <div class="main-left-side">
        @if(count($category->articles))
            <div class="news-sec-1 float-width">
                <div class="float-width sec-cont2 label{!! $category->color_id !!}">
                    <h3 class="sec-title label-title label{!! $category->color_id !!}">
                        <a href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">
                            {!! $category->name !!}
                        </a>
                    </h3>
                    <div id="post-data">
                        @include('blog.category.data')
                    </div>
                </div>
                <hr>
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="{!! asset('images/ajax.gif') !!}">Loading More post</p>
                </div>
            </div>
        @endif
    </div>
    <div class="main-right-side">
        @include('layouts.blog.main-right-side')
    </div>
@stop
