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
    @if(isset($single_article_ads))
        <div class="ads_items text-center">
            @if(isset($main_right_ads))
                @if(count($main_right_ads))
                    @foreach($main_right_ads->take(2) as $index => $ads)
                        @if($index < 2)
                            <div class="ad-rt">
                                <a href="{!! $ads->url !!}" target="_blank">
                                    <img alt="{!! $ads->provider_name !!}"
                                         src="{!! asset($ads->banner()->media_url) !!}"/>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    @endif
@stop
@section('new_article_single_article')
    @if($latest_posts->count())
        <div class="panel panel-info">
            <div class="panel-heading">
                {!! __('posts.new_posts') !!}
            </div>
            <div class="panel-body">
                @foreach($latest_posts as $article)
                    <div class="media">
                        <div class="media-left media-top">
                            @if($article->hasThumbnail())
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                         class="media-object" width="80" alt="{!! $article->title !!}">
                                </a>
                            @else
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                         class="media-object" width="80" alt="{!! $article->title !!}">
                                </a>
                            @endif
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    {!! $article->excerptTitle(80) !!}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
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
