<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/14/2017
 * Time: 11:25 PM
 */
?>
@section('css')
    <style type="text/css">
        .ajax-load {
            background: #e1e1e1;
            padding: 10px 0;
            width: 100%;
        }
    </style>
@stop
@if(count($posts))
    @foreach($posts as $index => $post)
        <div class="sec-1-big float-width">
            @if($post->hasThumbnail())
                <div class="zoom-img">
                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                        <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="blocky lazyload" src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"
                             data-src="{!! asset('/media/news/'.$post->id.'/small_'.$post->thumbnail()->filename) !!}"/>
                    </a>
                </div>
            @else
                <div class="zoom-img">
                    <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="blocky lazyload" src="{!! asset('blog/img/blur.jpg') !!}"
                         data-src="{!! asset('blog/img/samples/z'.$index.'.jpg') !!}"/>
                </div>
            @endif
            <div class="sec-1-big-text lefty">
                <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}"
                   title="{!! $post->title !!}">
                    <h3>{!! $post->excerptTitle(40) !!}</h3>
                </a>
                <h6>
                    <span>
                        <i class="fa fa-user"></i>{!! $post->checkAuthor()? $post-> author->name : 'Admin' !!}</span><span>
                        <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('M d,Y') !!}</span>
                    <span>
                        <i class="fa fa-comment-o"></i>{!! $post->comments->count() !!} comments
                    </span>
                </h6>
                <p>{!! $post->excerpt(900) !!}</p>
            </div>
        </div>
    @endforeach
@endif

@section('scripts')
    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                page++;
                loadMoreData(page);
            }
        });

        function loadMoreData(page) {
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function () {
                        $('.ajax-load').show();
                    }
                })
                .done(function (data) {
                    if (data.html === "") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#post-data").append(data.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('server not responding...');
                });
        }
    </script>
@stop