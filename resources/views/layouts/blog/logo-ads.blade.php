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
                         width="270" class="img-responsive logo-top"/>
                </a>
            @endif
        </div>
        @include('blog.shared._top_banner')
    </div>
</div>
