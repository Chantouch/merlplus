<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/10/2017
 * Time: 1:10 PM
 */
?>
@if(isset($single_article_ads))
    @if(isset($main_right_ads))
        <div class="ads_items text-center">
            @if(count($main_right_ads))
                @foreach($main_right_ads->take(2) as $index => $ads)
                    @if($index < 2)
                        <div class="ad-rt">
                            <a href="{!! $ads->url !!}" target="_blank">
                                <img alt="{!! $ads->provider_name !!}"
                                     src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                @for($x=1;$x<=2;$x++)
                    <div class="ad-rt">
                        <img src="{!! asset('images/loading-preloader.gif') !!}" alt="Place your ads here!"
                             data-src="{!! asset('images/right-bar-ads-'.$x.'.jpg') !!}"
                             class="lazyload img-responsive center-block"/>
                    </div>
                @endfor
            @endif
        </div>
    @endif
@endif
