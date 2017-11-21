<div class="rt-bk-cont">
    @if(count($top_right_ads))
        @foreach($top_right_ads as $index => $ads)
            @if($ads->hasBanner())
                <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                    <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                        <img alt="{!! $ads->provider_name !!}" class="img"
                             src="{!! asset($ads->banner()->media_url) !!}"/>
                    </a>
                    <h2 class="cat-label cat-label4">
                        <a href="{!! $ads->url !!}">{!! $ads->provider_name !!}</a>
                    </h2>
                </div>
            @endif
            @if($index < 2)
                <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                    <a href="{!! route('blog.contact.index') !!}">
                        <img alt="Place your ads here" class="img"
                             src="{!! asset('images/ads-300x250.png') !!}"/>
                    </a>
                    <h2 class="cat-label cat-label4">
                        <a href="{!! route('blog.contact.index') !!}">Contact Us</a>
                    </h2>
                </div>
            @endif
        @endforeach
    @else
        @for($x = 0; $x <= 1; $x++)
            <div class="rt-block mid-block-1 col-sm-6 boxgrid2 caption">
                <a href="{!! route('blog.contact.index') !!}">
                    <img alt="Place your ads here" class="img" src="{!! asset('images/ads-300x250.png') !!}"/>
                </a>
                <h2 class="cat-label cat-label4">
                    <a href="{!! route('blog.contact.index') !!}">Contact Us</a>
                </h2>
            </div>
        @endfor
    @endif
</div>