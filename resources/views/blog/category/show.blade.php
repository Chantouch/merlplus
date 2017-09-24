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
    <div class="panel panel-info">
        <div class="panel-heading">
            {!! __('posts.new_posts') !!}
        </div>
        <div class="panel-body">
            @if($latest_posts->count())
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
            @endif
        </div>
    </div>
@stop
@section('content')
    <div class="main-left-side">
        <div class="top-news float-width">
            <div class="float-width sec-cont">
                <h3 class="sec-title">{!! $category->name !!} - Top news</h3>
                <div class="top-big-two">
                    @if(count($category->articles))
                        @foreach($category->articles->take(2) as $index => $post)
                            <div class="big-two-2 blocky boxgrid3 caption">
                                @if($post->hasThumbnail())
                                    <img alt="{!! $post->excerptTitle(60) !!}"
                                         src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                                @else
                                    <img alt="{!! $post->excerptTitle(60) !!}"
                                         src="{!! asset('blog/img/samples/z1'.$index.'.jpg') !!}"/>
                                @endif
                                <div class="cover boxcaption3">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            {!! $post->excerptTitle(35) !!}
                                        </a>
                                    </h3>
                                    <p class="artcl-time-1">
                                        <span><i class="fa fa-clock-o"></i>{!! $post->posted_at->format('M d,Y') !!}</span>
                                        <span><i class="fa fa-comment-o"></i>{!! $post->comments->count() !!}
                                            comments</span>
                                    </p>
                                    <p>
                                        {!! $post->excerpt(1200) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            @if(count($posts))
                <div class="row">
                    @foreach($posts as $index => $post)
                        <div class="col-md-6 col-sm-6 col-xs-6 tn-small-1 blocky">
                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                @if($post->hasThumbnail())
                                    <img alt="{!! $post->excerptTitle(60) !!}" class="lefty" width="107" height="85"
                                         src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                                @else
                                    <img class="lefty" alt="{!! $post->excerptTitle(60) !!}"
                                         src="{!! asset('blog/img/samples/e1.jpg') !!}"/>
                                @endif
                            </a>

                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                <h4 class="lefty">{!! $post->excerptTitle(40) !!}</h4>
                            </a>

                            @if(count($post->categories))
                                <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                                   class="lefty cat-a cat-label{!! $index+1 !!} font-uppercase">{!! $post->categories->first()->name !!}</a>
                            @endif
                            <p class="righty">
                            <span>
                                <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('M d,Y') !!}
                            </span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="news-sec-1 float-width">
            <div class="float-width sec-cont2">
                <h3 class="sec-title">{!! $category->name !!}</h3>
                <div id="post-data">
                    @include('blog.category.data')
                </div>
            </div>
            <hr>
            <div class="ajax-load text-center" style="display:none">
                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
            </div>
        </div>
    </div>
    <div class="main-right-side">
        @include('layouts.blog.main-right-side')
    </div>
@stop
