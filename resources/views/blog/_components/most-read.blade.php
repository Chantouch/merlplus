<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/8/2017
 * Time: 7:05 AM
 */
?>
<div class="panel-heading">
    {!! __('posts.most_read') !!}
</div>
<div class="panel-body">
    @foreach($most_read as $article)
        <div class="media">
            <div class="media-left media-top">
                @if($article->hasThumbnail())
                    <div class="zoom-img">
                        <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                           title="{!! $article->title !!}">
                            <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                 src="{!! asset('blog/img/blur.jpg') !!}"
                                 class="media-object lazyload"
                                 width="80" alt="{!! $article->title !!}">
                        </a>
                    </div>
                @else
                    <div class="zoom-img">
                        <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                           title="{!! $article->title !!}">
                            <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                 src="{!! asset('blog/img/blur.jpg') !!}"
                                 class="media-object lazyload"
                                 width="80" alt="{!! $article->title !!}">
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
    @endforeach
</div>
