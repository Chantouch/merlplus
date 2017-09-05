<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:50 PM
 */
?>
<div class="float-width sec-cont">
    <h3 class="sec-title">Top news</h3>
    <div class="top-big-two">
        @if(count($posts))
            @foreach($posts->random(2) as $index => $post)
                <div class="big-two-{!! $index + 1 !!} blocky boxgrid3 caption">
                    @if($post->hasThumbnail())
                        <img class="img-responsive" alt="{!! $post->excerptTitle() !!}"
                             data-echo="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                    @endif
                    <div class="cover boxcaption3">
                        <h3>
                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                {!! str_limit($post->title, 35) !!}
                            </a>
                        </h3>
                        <p class="artcl-time-1">
                            <span><i class="fa fa-clock-o"></i>{!! $post->posted_at->diffForHumans() !!}</span>
                            <span><i class="fa fa-comment-o"></i>21 comments</span>
                        </p>
                        <div>
                            {!! $post->excerpt(250) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@if(isset($categories))
    @if(count($categories))
        @foreach($categories as $index => $category)
            @foreach($category->articles->random(1) as $post)
                <div class="tn-small-1 blocky">
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        @if($post->hasThumbnail())
                            <img alt="{!! $post->title !!}" class="lefty img-responsive" width="107"
                                 data-echo="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                        @endif
                    </a>
                    <h4 class="lefty">
                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                            {!!str_limit( $post->title, 50) !!}
                        </a>
                    </h4>
                    <a class="lefty cat-a cat-label{!! $index + 1 !!}" href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">{!! $category->name !!}</a>
                    <p class="righty">
                        <span>
                            <i class="fa fa-clock-o"></i> {!! $post->created_at->diffForHumans() !!}
                        </span>
                    </p>
                </div>
            @endforeach
        @endforeach
    @endif
@endif
