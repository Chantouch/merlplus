<div class="top-banner col-lg-8 col-md-8 col-sm-8">
    @if(count($top_ads))
        @foreach($top_ads as $ads)
            @if($ads->hasBanner())
                <a href="{!! $ads->url !!}" target="_blank">
                    <img alt="{!! $ads->banner()->original_filename !!}"
                         src="{!! asset($ads->banner()->media_url) !!}"
                         height="90" class="img-responsive"/>
                </a>
            @endif
        @endforeach
    @else
        <a href="{!! route('blog.contact.index') !!}" target="_blank">
            <img alt="Please your ads here" data-src="{!! asset('images/ads-728x90.png') !!}" height="90"
                 class="img-responsive center-block"/>
        </a>
    @endif
</div>