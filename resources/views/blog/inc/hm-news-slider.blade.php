<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:43 PM
 */
?>
@if(count($posts))
    @foreach($posts as $index => $post)
        <div class="mid-block-1 boxgrid caption item col-sm-6">
            @if($post->hasThumbnail())
                <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="img lazyload" data-src="{!! asset(route('media.posts.path',[$post->id,'medium_'.$post->thumbnail()->filename])) !!}"/>
            @else
                <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="img lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                     data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
            @endif
            @if(count($post->categories))
                <h1 class="cat-label cat-label{!! $post->categories->first()->color_id !!}">
                    <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                       class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                </h1>
            @endif
            <div class="cover boxcaption">
                <h2>
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        {!! $post->excerptTitle(50,80) !!}
                    </a>
                    <span class="topic-icn">{!! $post->posted_at->diffForHumans() !!}</span>
                </h2>
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