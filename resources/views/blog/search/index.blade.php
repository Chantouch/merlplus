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
    <!-- Single Category News Blocks -->
    <div class="news-sec-1 float-width">
        <div class="float-width sec-cont2">
            <h3 class="sec-title">We found {!! $posts_count !!} article related to your search</h3>
            @if(count($posts))
                @foreach($posts as $index => $post)
                    <div class="sec-1-big float-width">
                        @if($post->hasThumbnail())
                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                <img alt="{!! $post->excerptTitle(60) !!}" class="lefty img-responsive" width="271"
                                     src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                            </a>
                        @else
                            <img class="lefty" alt="{!! $post->excerptTitle(60) !!}"
                                 src="{!! asset('blog/img/samples/z'.$index.'.jpg') !!}"/>
                        @endif
                        <div class="sec-1-big-text lefty">
                            <h3>
                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}"
                                   title="{!! $post->excerptTitle(30) !!}">
                                    {!! $post->excerptTitle(30) !!}
                                </a>
                            </h3>
                            <h6>
                    <span>
                        <i class="fa fa-user"></i>{!! $post->checkAuthor()? $post-> author->name : 'Admin' !!}</span><span>
                        <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('M d,Y') !!}</span>
                                <span>
                        <i class="fa fa-comment-o"></i>{!! $post->comments->count() !!} comments
                    </span>
                            </h6>
                            <p>{!! $post->excerpt(800) !!}</p>
                        </div>
                    </div>
                @endforeach
            @endif
            {!! $posts->render() !!}
        </div>
        <hr>
        <div class="ajax-load text-center" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>
    </div>
@stop
