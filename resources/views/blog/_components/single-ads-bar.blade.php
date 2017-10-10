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
        @if(count($main_right_ads))
            <div class="ads_items text-center">
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
            </div>
        @endif
    @endif
@endif
