<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:53 PM
 */
?>
@if(isset($categories))
    @if(count($categories))
        @foreach($categories->take(4) as $category)
            <div class="news-sec-1 float-width">
                <div class="float-width sec-cont2 label{!! $category->color_id !!}">
                    <h3 class="sec-title label-title label{!! $category->color_id !!}">
                        <a href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">
                            {!! $category->name !!}
                        </a>
                    </h3>
                    @if(count($category->articles))
                        @foreach($category->articles->take(7) as $index => $post)
                            @if($index === 0)
                                <div class="sec-1-big float-width">
                                    @if($post->hasThumbnail())
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            <img alt="{!! $post->title !!}" class="blocky lazyload"
                                                 src="{!! asset('blog/img/blur.jpg') !!}"
                                                 data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                        </a>
                                    @endif
                                    <div class="sec-1-big-text lefty">
                                        <h3>
                                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                {!! str_limit( $post->title, 45) !!}
                                            </a>
                                        </h3>
                                        <h6>
                                        <span>
                                            <i class="fa fa-user"></i>{!! $post->author->name !!}
                                        </span>
                                            <span>
                                            <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('d M Y') !!}
                                        </span>
                                            <span>
                                            <i class="fa fa-comment-o"></i>{!! $post->comments->count() !!} comments
                                        </span>
                                        </h6>
                                        <p>
                                            {!! $post->excerpt(2000) !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if($index > 0)
                                <div class="sec-1-sm sub-cat-top">
                                    @if($post->hasThumbnail())
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            <img alt="merlplus, merlplus.com {!! $post->title !!}"
                                                 class="blocky lazyload" height="90"
                                                 src="{!! asset('blog/img/blur.jpg') !!}"
                                                 data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                        </a>
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
                                        <p>{!! $post->excerpt(300) !!}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12 col-xs-12">--}}
                                {{--<div class="flexslider hm-slider sub-item-cat">--}}
                                    {{--<ul class="slides">--}}
                                        {{--@foreach($category->articles->take(7) as $index => $post)--}}
                                            {{--@if($index > 0)--}}
                                                {{--<li>--}}
                                                    {{--@if($post->hasThumbnail())--}}
                                                        {{--<img alt="merlplus, merlplus.com {!! $post->title !!}"--}}
                                                             {{--class="lazyload"--}}
                                                             {{--src="{!! asset('blog/img/blur.jpg') !!}"--}}
                                                             {{--data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>--}}
                                                    {{--@endif--}}
                                                    {{--<div class="hm-sldr-caption">--}}
                                                        {{--<h4>--}}
                                                            {{--<a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">--}}
                                                                {{--{!! $post->title !!}--}}
                                                            {{--</a>--}}
                                                        {{--</h4>--}}
                                                    {{--</div>--}}
                                                {{--</li>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endif