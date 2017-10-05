<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/4/2017
 * Time: 11:00 PM
 */
?>
<div class="row mobile">
    <div class="col-md-12 sec-1-sm sub-cat-top">
        <div class="owl-carousel owl-theme">
            @foreach($category->articles->take(11) as $index => $post)
                @if($index > 0)
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        <img alt="{!! $post->title !!}" class="blocky lazyload"
                             src="{!! asset('blog/img/blur.jpg') !!}"
                             data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"
                             data-src-retina="{!! asset('/media/news/'.$post->id.'/large_'.$post->thumbnail()->filename) !!}"/>
                        <h5 class="mobile-title">{!! $post->title !!}</h5>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
