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
                <div class="float-width sec-cont2">
                    <h3 class="sec-title">
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
                                            <img alt="{!! $post->title !!}" class="blocky lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
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
                                <div class="sec-1-sm">
                                    @if($post->hasThumbnail())
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            <img alt="Image blog default page" class="blocky lazyload" height="90" src="{!! asset('blog/img/blur.jpg') !!}"
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
                    @endif
                </div>
            </div>
        @endforeach
        <div class="flex-container">
            <div class="flexslider hm-slider">
                <ul class="slides">
                    <li>
                        <img alt="Image blog default page" src="img/samples/sample.jpg"/>
                        <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                        <div class="hm-sldr-caption">
                            <h3><a href="#">Rugby Players are shocked about new rules in game<span
                                            class="topic-icn">17</span></a></h3>
                            <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper,
                                fringilla ligula nec, pellentesque nisl. Sed dolor justo, dapibus quis tellus et,
                                rhoncus rhoncus purus...
                            </p>
                        </div>
                    </li>
                    <li>
                        <img alt="Image blog default page" src="img/samples/sample6.jpg"/>
                        <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                        <div class="hm-sldr-caption">
                            <h3><a href="#">Abu Trika Strikes a new Goal!<span class="topic-icn">17</span></a></h3>
                            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                in their infancy. Various versions have evolved over...
                            </p>
                        </div>
                    </li>
                    <li>
                        <img alt="Image blog default page" src="img/samples/sample7.jpg"/>
                        <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                        <div class="hm-sldr-caption">
                            <h3><a href="#">Kawerki is the new future in Tennis<span class="topic-icn">17</span></a>
                            </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which
                                don't look even slightly believable...
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endif
