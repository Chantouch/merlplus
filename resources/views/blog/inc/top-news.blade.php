<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:50 PM
 */
?>
@if(isset($tag))
    @if($tag->count())
        @if($tag->posts->count())
            <div class="news-sec-1 float-width">
                <div class="float-width sec-cont2 label7">
                    <h3 class="sec-title label-title label7">
                        <a href="{!! route('blog.tag.show',[$tag->getRouteKey()]) !!}">
                            {!! $tag->name !!}
                        </a>
                    </h3>
                    @foreach($tag->posts->take(7) as $index => $post)
                        @if($index === 0)
                            <div class="sec-1-big float-width">
                                @if($post->hasThumbnail())
                                    <div class="zoom-img">
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            <img alt="{!! $post->removeSpecialChar($post->title) !!}"
                                                 class="blocky lazyload"
                                                 src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                        </a>
                                    </div>
                                @endif
                                <div class="sec-1-big-text lefty">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            @if($agent->isDesktop())
                                                {!! $post->excerptTitle(50,80) !!}
                                            @else
                                                {!! $post->excerptTitle() !!}
                                            @endif
                                        </a>
                                    </h3>
                                    <p>
                                        @if($agent->isDesktop())
                                            {!! $post->excerpt(2500) !!}
                                        @else
                                            {!! $post->excerpt() !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if($agent->isDesktop())
                            @if($index > 0)
                                @include('blog.inc.web')
                            @endif
                        @endif
                    @endforeach
                    @if($agent->isMobile())
                        <div class="row mobile">
                            <div class="col-md-12 sec-1-sm sub-cat-top">
                                <div class="owl-carousel owl-theme">
                                    @foreach($tag->posts->take(11) as $index => $post)
                                        @if($index > 0)
                                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="blocky lazyload"
                                                     src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                                                <h5 class="mobile-title">{!! $post->title !!}</h5>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endif
@endif
