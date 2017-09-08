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
                    @foreach($category->articles->random(2) as $index => $post)
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
                                    <span><i class="fa fa-clock-o"></i>{!! $post->posted_at !!}</span>
                                    <span><i class="fa fa-comment-o"></i>21 comments</span>
                                </p>
                                <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula
                                    nec,
                                    pellentesque nisl. Sed dol...</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if(count($posts))
            @foreach($posts as $index => $post)
                <div class="tn-small-1 blocky">
                    <a href="#">
                        @if($post->hasThumbnail())
                            <img alt="{!! $post->excerptTitle(60) !!}" class="lefty img-responsive" width="107"
                                 src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                        @else
                            <img class="lefty" alt="{!! $post->excerptTitle(60) !!}"
                                 src="{!! asset('blog/img/samples/e1.jpg') !!}"/>
                        @endif
                    </a>
                    <h4 class="lefty">{!! $post->excerptTitle(40) !!}</h4>
                    @if(count($post->categories))
                        <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                           class="lefty cat-a cat-label{!! $index+1 !!} font-uppercase">{!! $post->categories->first()->name !!}</a>
                    @endif
                    <p class="righty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span></p>
                </div>
            @endforeach
        @endif
    </div>
    <!-- Single Category News Blocks -->
    <div class="news-sec-1 float-width">
        <div class="float-width sec-cont2">
            <h3 class="sec-title">{!! $category->name !!}</h3>
            @if(count($category->articles))
                @foreach($category->articles as $index => $post)
                    <div class="sec-1-big float-width">
                        @if($post->hasThumbnail())
                            <img alt="{!! $post->excerptTitle(60) !!}" class="lefty img-responsive" width="271"
                                 src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                        @else
                            <img class="lefty" alt="{!! $post->excerptTitle(60) !!}"
                                 src="{!! asset('blog/img/samples/z'.$index.'.jpg') !!}"/>
                        @endif
                        <div class="sec-1-big-text lefty">
                            <h3>{!! $post->excerptTitle(30) !!}</h3>
                            <h6>
                            <span>
                            <i class="fa fa-user"></i>John Doe</span><span>
                            <i class="fa fa-clock-o"></i>{!! $post->posted_at !!}</span>
                                <span>
                                <i class="fa fa-comment-o"></i>21 comments
                            </span>
                            </h6>
                            <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit amet,
                                lobortis
                                hendrerit nunc. Curabitur pharetra in velit at ornare. Pellentesque vitae nibh volutpat
                                velit
                                feugiat euismod ut a elit. Donec in felis rutrum risus bibendum cursus. Aliquam interdum
                                aliquam
                                elementum ...</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="cat-pagintn float-width">
            <ul>
                <li><a class="crnt-pg">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">22</a></li>
            </ul>
        </div>
    </div>
@stop
