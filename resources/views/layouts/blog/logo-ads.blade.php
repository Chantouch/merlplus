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
                <img alt="" src="{!! asset('blog/img/barbri.png') !!}" width="270"/>
            </a>
        </div>
        <div class="top-banner col-lg-8">
            <!-- Top ad banner -->
            @if(count($top_ads))
                @foreach($top_ads as $ads)
                    @if($ads->hasBanner())
                        <a href="{!! $ads->url !!}" target="_blank">
                            {{ Html::image($ads->banner()->media_url, $ads->banner()->original_filename) }}
                        </a>
                    @else
                        <a href="#">
                            <img alt="" src="{!! asset('blog/img/top-banner.jpg') !!}" height="90"/>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
