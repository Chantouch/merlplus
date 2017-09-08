<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:44 PM
 */
?>
<!-- Fixed Blocks -->
<div class="mid-blks-cont">
    @if(count($posts))
        @foreach($posts->random(2) as $index => $post)
            <div class="mid-block-1 boxgrid caption item">
                @if($post->hasThumbnail())
                    <img alt="{!! $post->excerptTitle(60) !!}" class="img"
                         src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                @else
                    <img alt="{!! $post->excerptTitle(60) !!}"
                         src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
                @endif
                <h2 class="cat-label cat-label2">
                    @if(count($post->categories))
                        <a href="#" class="font-uppercase">{!! $post->categories->first()->name !!}</a>
                    @endif
                </h2>
                <div class="cover boxcaption">
                    <h1>
                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                            {!! $post->excerptTitle(45) !!}
                        </a>
                        <span class="topic-icn">81</span>
                    </h1>
                    <p>
                        {!! $post->excerpt(1000) !!}
                    </p>
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">MORE
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    @endif

</div>
<!-- Block3 -->
<div class="rt-bk-cont">
    @if(count($top_right_ads))
        @foreach($top_right_ads as $ads)
            @if($ads->hasBanner())
                <a href="{!! $ads->url !!}" target="_blank">
                    <div class="rt-block mid-block-1 boxgrid2 caption item">
                        <img alt="{!! $ads->provider_name !!}" class="img"
                             src="{!! asset($ads->banner()->media_url) !!}"/>
                        <h4 class="cat-label cat-label4">
                            <a href="#">{!! $ads->provider_name !!}</a>
                        </h4>
                    </div>
                </a>
            @else
                <div class="rt-block mid-block-1 boxgrid2 caption item">
                    {!! $ads->url !!}
                    <h4 class="cat-label cat-label4">
                        <a href="#">{!! $ads->provider_name !!}</a>
                    </h4>
                </div>
            @endif
        @endforeach
    @endif
</div>