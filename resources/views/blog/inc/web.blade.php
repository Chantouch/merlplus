<div class="web">
    <div class="sec-1-sm sub-cat-top">
        @if($post->hasThumbnail())
            <div class="zoom-img">
                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                    <img alt="{!! $post->removeSpecialChar($post->title) !!}"
                         class="blocky lazyload" height="90"
                         src="{!! asset('blog/img/blur.png') !!}"
                         data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                </a>
            </div>
        @endif
        <div class="sec-1-sm-text blocky">
            <h3>
                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                    {!! $post->excerptTitle() !!}
                </a>
            </h3>
            <h6>
                <span>
                    <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('d M Y') !!}
                </span>
                <span>
                    <i class="fa fa-comment-o"></i>{!! $post->comments->count() !!}
                    {!! __('app.comment') !!}
                </span>
            </h6>
            <p>{!! $post->excerpt(200) !!}</p>
        </div>
    </div>
</div>