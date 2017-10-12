<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:43 PM
 */
?>

@if(count($posts))
    @foreach($posts['news_sliders'] as $index => $post)
        <div class="mid-block-1 boxgrid caption item col-sm-6">
            @if($post->hasThumbnail())
                <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload"
                     src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"
                     data-src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
            @else
                <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                     data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
            @endif
            @if(count($post->categories))
                <h4 class="cat-label cat-label{!! $post->categories->first()->color_id !!}">
                    <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                       class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                </h4>
            @endif
            <div class="cover boxcaption">
                <h1>
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        {!! $post->excerptTitle(90) !!}
                    </a>
                    <span class="topic-icn">{!! $post->posted_at->diffForHumans() !!}</span>
                </h1>
                <p>
                    {!! $post->excerpt(1400) !!}
                </p>
                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">MORE
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    @endforeach
@endif