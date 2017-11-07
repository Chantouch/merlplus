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
        <div class="logo col-lg-4 col-md-4 col-sm-4">
            @if(config('settings.app_logo'))
                <a href="{!! route('blog.index') !!}">
                    <img alt="{!! config('settings.app_name') !!}" src="{!! asset(config('settings.app_logo')) !!}"
                         width="270"
                         class="lazyload img-responsive logo-top"/>
                </a>
            @endif
        </div>
        <div class="top-banner col-lg-8 col-md-8 col-sm-8">
            <!-- Top ad banner -->
            @if(count($top_ads))
                @foreach($top_ads as $ads)
                    @if($ads->hasBanner())
                        <a href="{!! $ads->url !!}" target="_blank">
                            <img alt="{!! $ads->banner()->original_filename !!}"
                                 src="{!! asset('blog/img/blur-ads.jpg') !!}"
                                 data-src="{!! asset($ads->banner()->media_url) !!}"
                                 height="90" class="lazyload img-responsive"/>
                        </a>
                    @endif
                @endforeach
            @else
                <a href="{!! route('blog.contact.index') !!}" target="_blank">
                    <img alt="Image blog default page" data-src="{!! asset('images/ads-728x90.png') !!}"
                         src="{!! asset('blog/img/blur-ads.jpg') !!}" height="90"
                         class="lazyload img-responsive"/>
                </a>
            @endif
        </div>
    </div>
</div>
