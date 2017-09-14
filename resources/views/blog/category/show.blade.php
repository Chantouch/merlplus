<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 5:01 PM
 */
?>
@extends('layouts.blog.app')

@section('content')
    <!-- Single Category - Top News -->
    <div class="top-news float-width">
        <div class="float-width sec-cont">
            <h3 class="sec-title">{!! $category->name !!} - Top news</h3>
            <div class="top-big-two">
                @if(count($category->articles))
                    @foreach($category->articles->take(2) as $index => $post)
                        <div class="big-two-{!! $index+1 !!} blocky boxgrid3 caption">
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
            @foreach($posts as $index => $post)
                <div class="tn-small-1 blocky">
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        @if($post->hasThumbnail())
                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                <img alt="{!! $post->excerptTitle(60) !!}" class="lefty" width="107" height="85"
                                     src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                            </a>
                        @else
                            <img class="lefty" alt="{!! $post->excerptTitle(60) !!}"
                                 src="{!! asset('blog/img/samples/e1.jpg') !!}"/>
                        @endif
                    </a>
                    <h4 class="lefty">
                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                            {!! $post->excerptTitle(40) !!}
                        </a>
                    </h4>
                    @if(count($post->categories))
                        <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                           class="lefty cat-a cat-label{!! $index+1 !!} font-uppercase">{!! $post->categories->first()->name !!}</a>
                    @endif
                    <p class="righty"><span>
                            <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('M d,Y') !!}</span>
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Single Category News Blocks -->
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
@stop
