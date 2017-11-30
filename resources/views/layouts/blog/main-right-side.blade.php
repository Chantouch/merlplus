<div class="sm-sldr-box float-width">
    @yield('main_right_ads_bar')
    @yield('new_article_single_article')
</div>

@if(isset($main_right_ads))
    @if($main_right_ads->count())
        @foreach($main_right_ads->random() as $index => $ads)
            @if($index > 1)
                <div class="ad-rt">
                    <a href="{!! $ads->url !!}" target="_blank">
                        <img src="{!! asset('images/loading-preloader.gif') !!}" alt="{!! $ads->provider_name !!}"
                             data-src="{!! asset($ads->banner()->media_url) !!}"
                             class="lazyload img-responsive center-block"/>
                    </a>
                </div>
            @endif
        @endforeach
    @else
        @for($x=1;$x<=3;$x++)
            <div class="ad-rt">
                <img src="{!! asset('images/right-bar-ads-'.$x.'.jpg') !!}"
                     class="lazyload img-responsive center-block"/>
            </div>
        @endfor
    @endif
@endif