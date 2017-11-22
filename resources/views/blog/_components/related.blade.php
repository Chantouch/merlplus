<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/6/2017
 * Time: 12:14 PM
 */
?>
<!-- related Articles  -->
<div class="col-md-12">
<div class="artcl-reltd float-width">
    @if($post->tags->count())
        <h3 class="sec-title">{!! __('app.related_posts') !!}</h3>
        @foreach($post->tags->first()->posts->take(4) as $article)
            @if($article->getRouteKey() != $post->getRouteKey())
                <div class="reltd-sngl">
                    @if($article->hasThumbnail())
                        <div class="zoom-img">
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                     src="{!! asset('images/loading-preloader.gif') !!}"
                                     class="img-responsive lazyload"
                                     alt="{!! $article->removeSpecialChar($article->title) !!}">
                            </a>
                        </div>
                    @else
                        <div class="zoom-img">
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                <img alt="{!! $article->removeSpecialChar($article->title) !!}"
                                     class="img-responsive lazyload"
                                     src="{!! asset('images/loading-preloader.gif') !!}"
                                     data-src="{!! asset('blog/img/samples/e1.jpg') !!}"/>
                            </a>
                        </div>
                    @endif
                    <div class="reltd-sngl-txt">
                        <h3>
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">{!! $article->excerptTitle(80) !!}</a>
                        </h3>
                        <p><i class="fa fa-clock-o"></i>{!! $article->posted_at->format('M d,Y') !!}</p>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
</div>