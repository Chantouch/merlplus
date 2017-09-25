<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:29 AM
 */
?>
<div class="container">
    <div class="row">
        <!-- Website Logo -->
        <div class="logo col-lg-4">
            <a href="/">
                <img alt="Merlplus.com" src="{!! asset('blog/img/logo.png') !!}" width="270"
                     class="lazyload"/>
            </a>
        </div>
        <div class="top-banner col-lg-8">
            <!-- Top ad banner -->
            @if(count($top_ads))
                @foreach($top_ads as $ads)
                    @if($ads->hasBanner())
                        <a href="{!! $ads->url !!}" target="_blank">
                            <img alt="{!! $ads->banner()->original_filename !!}"
                                 src="{!! asset('blog/img/blur-ads.jpg') !!}"
                                 data-src="{!! asset($ads->banner()->media_url) !!}"
                                 height="90" class="lazyload"/>
                        </a>
                    @else
                        <a href="#">
                            <img alt="Image blog default page" data-src="{!! asset('blog/img/top-banner.jpg') !!}"
                                 src="{!! asset('blog/img/blur-ads.jpg') !!}" height="90" class="lazyload"/>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
