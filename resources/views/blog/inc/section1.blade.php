<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:53 PM
 */
?>
@if(isset($categories))
    @if($categories->count())
        @foreach($categories->take(5) as $category)
            @if($category->articles->count())
                <div class="news-sec-1 float-width">
                    <div class="float-width sec-cont2 label{!! $category->color_id !!}">
                        <h3 class="sec-title label-title label{!! $category->color_id !!}">
                            <a href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">
                                {!! $category->name !!}
                            </a>
                        </h3>
                        @foreach($category->articles->take(7) as $index => $post)
                            @if($index === 0)
                                <div class="sec-1-big float-width">
                                    @if($post->hasThumbnail())
                                        <div class="zoom-img">
                                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                <img alt="{!! $post->title !!}" class="blocky lazyload"
                                                     src="{!! asset('blog/img/blur.jpg') !!}"
                                                     data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="sec-1-big-text lefty">
                                        <h3>
                                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                {!! $post->excerptTitle() !!}
                                            </a>
                                        </h3>
                                        <p>
                                            {!! $post->excerpt() !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if($index > 0)
                                <div class="web">
                                    <div class="sec-1-sm sub-cat-top">
                                        @if($post->hasThumbnail())
                                            <div class="zoom-img">
                                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                    <img alt="merlplus, merlplus.com {!! $post->title !!}"
                                                         class="blocky lazyload" height="90"
                                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                                         data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="sec-1-sm-text blocky">
                                            <h3>
                                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                    {!! $post->excerptTitle() !!}
                                                </a>
                                            </h3>
                                            <h6>
                                                <span>
                                                    <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('d M Y') !!}
                                                </span>
                                                <span>
                                                    <i class="fa fa-comment-o"></i>{!! $post->comments->count() !!} comments
                                                </span>
                                            </h6>
                                            <p>{!! $post->excerpt(450) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @include('blog.inc.mobile')
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endif