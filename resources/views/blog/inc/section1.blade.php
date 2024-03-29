@if(isset($categories))
    @if($categories->count())
        @foreach($categories as $category)
            @if($category->articles->count())
                <div class="news-sec-1 float-width">
                    <div class="float-width sec-cont2 label{!! $category->color_id !!}">
                        <h3 class="sec-title label-title label{!! $category->color_id !!}">
                            <a href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">
                                {!! $category->name !!}
                            </a>
                        </h3>
                        @foreach($category->articles->take(7) as $index => $post)
                            @if($index === 0)
                                <div class="sec-1-big float-width">
                                    @if($post->hasThumbnail())
                                        <div class="zoom-img">
                                            <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                                <img alt="{!! $post->removeSpecialChar($post->title) !!}"
                                                     class="blocky lazyload" src="{!! asset('images/loading-preloader.gif') !!}"
                                                     data-src="{!! asset('/media/news/'.$post->id.'/medium_'.$post->thumbnail()->filename) !!}"/>
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
                            @endif
                            @if($agent->isDesktop())
                                @if($index > 0)
                                    @include('blog/inc/web')
                                @endif
                            @endif
                        @endforeach
                        @if($agent->isMobile())
                            @include('blog/inc/mobile')
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endif