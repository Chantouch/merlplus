<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:43 PM
 */
?>
<!-- News slider -->
<div class="flex-container">
    <div class="flexslider hm-slider">
        <ul class="slides">
            @if(count($posts))
                @foreach($posts->take(5) as $post)
                    <li>
                        @if($post->hasThumbnail())
                            <img alt="{!! $post->excerptTitle(60) !!}"
                                 src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                        @else
                            <img alt="{!! $post->excerptTitle(60) !!}" src="blog/img/samples/sample.jpg"/>
                        @endif
                        <h3 class="cat-label cat-label1">
                            @if(count($post->categories))
                                <a href="{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}"
                                   class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                            @endif
                        </h3>
                        <div class="hm-sldr-caption">
                            <h3>
                                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                    {!! $post->excerptTitle(60) !!}<span class="topic-icn">17</span>
                                </a>
                            </h3>
                            <p>
                                {!! $post->excerpt(250) !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>

<div class="mid-block-ads-468x60 boxgrid caption">
    <img alt="Dolorem temporibus omnis voluptas repudiandae ipsa..." src="blog/img/ads-468x60.png">
    <h4 class="cat-label cat-label2">
        <a href="#" class="font-uppercase">Sport</a>
    </h4>
</div>

<div class="mid-block-ads-468x60 boxgrid caption">
    <img alt="Dolorem temporibus omnis voluptas repudiandae ipsa..." src="blog/img/ads-468x60-1.png">
    <h4 class="cat-label cat-label2">
        <a href="#" class="font-uppercase">Sport</a>
    </h4>
</div>
