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
        <div class="mid-block-1 boxgrid caption item">
            @if($post->hasThumbnail())
                <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                     data-src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
            @else
                <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                     data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
            @endif
            <h4 class="cat-label cat-label2">
                @if(count($post->categories))
                    <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                       class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                @endif
            </h4>
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

<div class="flex-container">
    <div class="flexslider hm-slider">
        <ul class="slides">
            @if(count($posts))
                @foreach($posts['news_sliders'] as $index => $post)
                    <li>
                        @if($post->hasThumbnail())
                            <img alt="{!! $post->title !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                                 data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                        @else
                            <img alt="{!! $post->title !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                                 data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
                        @endif
                        <h3 class="cat-label cat-label1">
                            @if(count($post->categories))
                                <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                                   class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                            @endif
                        </h3>
                        <div class="hm-sldr-caption">
                            <h3>
                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                    {!! $post->excerptTitle(30) !!}
                                </a>
                                <span class="topic-icn">{!! $post->posted_at->diffForHumans() !!}</span>
                            </h3>
                            <p>
                                {!! $post->excerpt(900) !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>