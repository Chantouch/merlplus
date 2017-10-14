<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/8/2017
 * Time: 7:04 AM
 */
?>
<div class="panel-heading">
    <h4>{!! __('posts.new_posts') !!}</h4>
</div>
<div class="panel-body">
    @foreach($new_posts as $article)
        @if(isset($post))
            @if($article->getRouteKey() != $post->getRouteKey())
                <div class="media">
                    <div class="media-left media-top">
                        @if($article->hasThumbnail())
                            <div class="zoom-img">
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                         class="media-object lazyload"
                                         width="80" alt="{!! $article->removeSpecialChar($article->title) !!}">
                                </a>
                            </div>
                        @else
                            <div class="zoom-img">
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                         class="media-object lazyload"
                                         width="80" alt="{!! $article->removeSpecialChar($article->title) !!}">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                {!! $article->excerptTitle(80) !!}
                            </a>
                        </h4>
                    </div>
                </div>
            @endif
        @else
            <div class="media">
                <div class="media-left media-top">
                    @if($article->hasThumbnail())
                        <div class="zoom-img">
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                     src="{!! asset('blog/img/blur.jpg') !!}"
                                     class="media-object lazyload"
                                     width="80" alt="{!! $article->removeSpecialChar($article->title) !!}">
                            </a>
                        </div>
                    @else
                        <div class="zoom-img">
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                     src="{!! asset('blog/img/blur.jpg') !!}"
                                     class="media-object lazyload"
                                     width="80" alt="{!! $article->removeSpecialChar($article->title) !!}">
                            </a>
                        </div>
                    @endif
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                           title="{!! $article->title !!}">
                            {!! $article->excerptTitle(80) !!}
                        </a>
                    </h4>
                </div>
            </div>
        @endif
    @endforeach
</div>
