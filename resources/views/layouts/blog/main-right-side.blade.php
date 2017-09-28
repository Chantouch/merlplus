<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:37 AM
 */
?>
<!-- One image slider -->
<div class="sm-sldr-box float-width">
    @yield('main_right_ads_bar')
    @yield('new_article_single_article')
</div>

<!-- Featured Video -->
{{--<div class="ftrd-vd float-width">--}}
{{--<h3 class="sec-title">FEATURED VIDEO</h3>--}}
{{--<iframe src="https://player.vimeo.com/video/8170203?color=b3a07d" width="100%" height="300"--}}
{{--frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>--}}
{{--</div>--}}

<!-- Ad banner right -->
@if(isset($main_right_ads))
    @if(count($main_right_ads))
        @foreach($main_right_ads->random() as $index => $ads)
            @if($index > 1)
                <div class="lefty ad-rt">
                    <a href="{!! $ads->url !!}" target="_blank">
                        <img alt="{!! $ads->provider_name !!}" data-src="{!! asset($ads->banner()->media_url) !!}"
                             class="lazyload img-responsive"/>
                    </a>
                </div>
            @endif
        @endforeach
    @endif
@endif