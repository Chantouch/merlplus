<div class="sec-1-big float-width">
    @if($post->hasThumbnail())
        <div class="zoom-img">
            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                <img alt="{!! $post->removeSpecialChar($post->title) !!}"
                     class="blocky lazyload"
                     src="{!! asset('/media/news/'.$post->id.'/medium_'.$post->thumbnail()->filename) !!}"/>
            </a>
        </div>
    @endif
    <div class="sec-1-big-text lefty">
        <h3>
            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                @if($agent->isDesktop())
                    {!! $post->excerptTitle(50,80) !!}
                @else
                    {!! $post->excerptTitle() !!}
                @endif
            </a>
        </h3>
        <p>
            @if($agent->isDesktop())
                {!! $post->excerpt(2500) !!}
            @else
                {!! $post->excerpt() !!}
            @endif
        </p>
    </div>
</div>