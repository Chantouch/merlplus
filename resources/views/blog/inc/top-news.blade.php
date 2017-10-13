<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:50 PM
 */
?>
@if(count($tag))
    @if($tag->posts->count())
        <div class="top-news float-width">
            <div class="float-width sec-cont">
                <h3 class="sec-title">{!! __('posts.video') !!}</h3>
                <div class="top-big-two">
                    @foreach($tag->posts->take(3) as $index => $post)
                        @if($index < 3)
                            <div class="big-two-1 blocky boxgrid3 caption">
                                @if($post->hasThumbnail())
                                    <img alt="{!! $post->excerptTitle(100) !!}" class="img lazyload"
                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                         data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                @endif
                                <div class="cover boxcaption3">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$post->slug]) !!}">
                                            {!! str_limit($post->title, 50) !!}
                                        </a>
                                    </h3>
                                    <p class="artcl-time-1">
                                        <span><i class="fa fa-clock-o"></i>{!! $post->posted_at->diffForHumans() !!}</span>
                                        <span><i class="fa fa-comment-o"></i>{!! $post->comments->count() !!}
                                            comments</span>
                                    </p>
                                    <div>
                                        {!! $post->excerpt(820) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($tag->posts->count())
        <div class="row">
            @foreach($tag->posts->take(9) as $index => $post)
                @if($index > 2)
                    <div class="col-md-4 col-sm-6 col-xs-6 tn-small-1 blocky">
                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                            @if($post->hasThumbnail())
                                <img alt="{!! $post->title !!}" class="lefty lazyload img-responsive" height="85"
                                     width="107" src="{!! asset('blog/img/blur.jpg') !!}"
                                     data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                            @endif
                        </a>
                        <h4 class="lefty">
                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                {!!str_limit( $post->title, 50) !!}
                            </a>
                        </h4>
                        <a class="lefty cat-a cat-label{!! $post->categories->first()->color_id !!}"
                           href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}">
                            {!! $post->categories->first()->name !!}</a>
                        <p class="righty">
                            <span>
                                <i class="fa fa-clock-o"></i> {!! $post->created_at->diffForHumans() !!}
                            </span>
                        </p>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endif
