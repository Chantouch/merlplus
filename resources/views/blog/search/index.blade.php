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
        <div class="float-width sec-cont2 label6">
            <h3 class="sec-title label-title label6">
                <a href="javascript:void (0)">
                    យើងបានរកឃើញ {!! $posts_count !!} អត្តបទ
                </a>
            </h3>
            @if(count($posts))
                @foreach($posts as $index => $post)
                    <div class="sec-1-big float-width">
                        @if($post->hasThumbnail())
                            <div class="zoom-img">
                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                    <img alt="merlplus, merlplus.com {!! $post->removeSpecialChar($post->title) !!}"
                                         class="lefty img-responsive lazyload" height="90"
                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                         data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                </a>
                            </div>
                        @else
                            <div class="zoom-img">
                                <img class="lefty" alt="{!! $post->removeSpecialChar($post->title) !!}"
                                     src="{!! asset('blog/img/samples/z'.$index.'.jpg') !!}"/>
                            </div>
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
            <p><img src="{!! asset('images/ajax.gif') !!}">Loading More post</p>
        </div>
    </div>
@stop
