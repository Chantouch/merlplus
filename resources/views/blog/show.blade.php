<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/21/2017
 * Time: 10:23 PM
 */
?>
@extends('layouts.blog.app')
@section('css')
    <link rel="stylesheet" href="{!! asset('plugins/fancybox/dist/jquery.fancybox.css') !!}">
    <style>

        .sponsor_img {
            /*margin-left: -15px;*/
            width: 120px;
            height: 60px;
        }

        .single .sponsor_by {
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
        }

    </style>
@stop
@section('post-background')
    <div class="fix-bg">
        @if($post->hasThumbnail())
            <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload"
                 src="{!! asset('blog/img/blur.jpg') !!}"
                 data-src="{!! asset(route('media.posts.path',[$post->id,'large_'.$post->thumbnail()->filename])) !!}"/>
        @else
            <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload"
                 src="{!! asset('blog/img/blur.jpg') !!}" data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
        @endif
        <div class="inside"></div>
    </div>
@stop
@section('main_right_ads_bar')
    @if(isset($main_right_ads))
        <div class="ads_items text-center pos-relative">
            @if(count($main_right_ads) > 1)
                @foreach($main_right_ads->random(2) as $index => $ads)
                    @if($index < 2)
                        <div class="ad-rt">
                            <a href="{!! $ads->url !!}" target="_blank">
                                <img alt="{!! $ads->provider_name !!}" class="lazyload img-responsive"
                                     src="{!! asset('blog/img/blur.jpg') !!}"
                                     data-src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                @foreach($main_right_ads->take(1) as $index => $ads)
                    @if($index < 2)
                        <div class="ad-rt">
                            <a href="{!! $ads->url !!}" target="_blank">
                                <img alt="{!! $ads->provider_name !!}" class="lazyload img-responsive"
                                     src="{!! asset('blog/img/blur.jpg') !!}"
                                     data-src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    @endif
@stop
@section('new_article_single_article')
    <div class="panel panel-info pos-relative">
        <div class="panel-heading">
            {!! __('posts.new_posts') !!}
        </div>
        <div class="panel-body">
            @if($new_posts->count())
                @foreach($new_posts as $article)
                    <div class="media">
                        <div class="media-left media-top">
                            @if($article->hasThumbnail())
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}" class="media-object lazyload"
                                         width="80" alt="{!! $article->title !!}">
                                </a>
                            @else
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}" class="media-object lazyload"
                                         width="80" alt="{!! $article->title !!}">
                                </a>
                            @endif
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    {!! $article->excerptTitle(80) !!}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="panel panel-info pos-relative">
        <div class="panel-heading">
            {!! __('posts.most_read') !!}
        </div>
        <div class="panel-body">
            @if($most_read->count())
                @foreach($most_read as $article)
                    <div class="media">
                        <div class="media-left media-top">
                            @if($article->hasThumbnail())
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}" class="media-object lazyload"
                                         width="80" alt="{!! $article->title !!}">
                                </a>
                            @else
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                         src="{!! asset('blog/img/blur.jpg') !!}" class="media-object lazyload"
                                         width="80" alt="{!! $article->title !!}">
                                </a>
                            @endif
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    {!! $article->excerptTitle(80) !!}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-left-side pos-relative">
                @if(isset($button_single_ads))
                    @foreach($button_single_ads as $index => $article_ad)
                        <div class="post-top-bar">
                            <a href="{!! $article_ad->url !!}" target="_blank" title="Opens in a new window">
                                <div class="single sponsor">
                                    <div class="sponsor_by">នាំមកជូនដោយ</div>
                                    <div class="sponsor_img">
                                        @if($article_ad->hasBanner())
                                            <img data-src="{!! asset($article_ad->banner()->media_url) !!}" width="728"
                                                 height="90" src="{!! asset('blog/img/blur.jpg') !!}"
                                                 class="lazyload img-responsive"
                                                 alt="{!! $article_ad->provider_name !!}">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                <div class="artcl-main float-width" id="main-single-article">
                    <div class="artcl-prev-nxt float-width">
                        <div class="artcl-prev w50 blocky">
                            @if(count($previousPost))
                                <a href="{!! route('blog.article.show', $previousPost->getRouteExist($previousPost)) !!}">
                                    <i class="fa fa-angle-left"></i> PREV ARTICLE</a>
                                <p>{!! strip_tags(str_limit($previousPost->title,45)) !!}</p>
                            @endif
                        </div>
                        <div class="artcl-nxt w50 blocky text-right">
                            @if(count($nextPost))
                                <a href="{!! route('blog.article.show', $nextPost->getRouteExist($nextPost)) !!}">
                                    NEXT ARTICLE <i class="fa fa-angle-right"></i>
                                </a>
                                <p>{!! strip_tags(str_limit($nextPost->title,45)) !!}</p>
                            @endif
                        </div>
                    </div>
                    <div class="artcl-body float-width">
                        <h2>{!! $post->excerptTitle(300) !!}</h2>
                        <!-- The Article Social Media Share -->
                        <div class="lefty artcl-tags">
                            <h5>
                                <span><i class="fa fa-user"></i>{!! $post->checkAuthor() !!}</span>
                                <span><i class="fa fa-clock-o"></i>{!! $post->posted_at !!}</span>
                                <span><i class="fa fa-comment-o"></i>{!! count($post->comments) !!} comments</span>
                            </h5>
                        </div>
                        @include('layouts.inc.social.horizontal')
                        <article class="float-width articl-data">
                            <div class="content">
                                {!! $post->description !!}
                            </div>
                        </article>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>{!! __('posts.show.article') !!}
                            ៖ {!! $post->checkAuthor()? $post-> author->name : 'Admin' !!} </p>
                    </div>
                </div>
                <!-- The Article Social Media Share -->
                <div class="artcl-scl float-width">
                    <div class="lefty artcl-tags">
                        <h3>TAGS : </h3>
                        <ul>
                            @if(count($post->tags))
                                @foreach($post->tags as $tag)
                                    <li>
                                        <a href="{!! route('blog.tag.show',[$tag->getRouteKey()]) !!}">
                                            <span class="label label-info">{!! $tag->name !!}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    @include('layouts.inc.social.horizontal')
                </div>
                <!-- Ads button of single article -->
                @if(isset($single_article_ads))
                    <div class="ads_items text-center">
                        @foreach($single_article_ads as $index => $article_ad)
                            @if($article_ad->hasBanner())
                                <img data-src="{!! asset($article_ad->banner()->media_url) !!}" width="728" height="90"
                                     src="{!! asset('blog/img/blur.jpg') !!}" class="lazyload img-responsive"
                                     alt="{!! $article_ad->provider_name !!}">
                            @else
                                {!! $article_ad->provider_name !!}
                            @endif
                        @endforeach
                    </div>
                @endif
                <div class="clearfix"></div>
                <div class="jumbotron color5bc0de">
                    <div class="title">ភ្ជាប់ទំនាក់ទំនងជាមួយ <span> MerlPlus</span></div>
                    <div class="fb-like" data-href="https://www.facebook.com/pg/khclassifiedads/" data-layout="standard"
                         data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
                </div>
                <div class="clearfix"></div>
                <!-- related Articles  -->
                <div class="artcl-reltd float-width">
                    <h3 class="sec-title">RELATED POSTS</h3>
                    @if($post->categories->count())
                        @foreach($post->tags->first()->posts->take(4) as $article)
                            <div class="reltd-sngl">
                                @if($article->hasThumbnail())
                                    <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                       title="{!! $article->title !!}">
                                        <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                             src="{!! asset('blog/img/blur.jpg') !!}" class="img-responsive lazyload"
                                             alt="{!! $article->title !!}">
                                    </a>
                                @else
                                    <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                       title="{!! $article->title !!}">
                                        <img alt="{!! $article->excerptTitle(60) !!}" class="img-responsive lazyload"
                                             src="{!! asset('blog/img/blur.jpg') !!}"
                                             data-src="{!! asset('blog/img/samples/e1.jpg') !!}"/>
                                    </a>
                                @endif
                                <div class="reltd-sngl-txt">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                           title="{!! $article->title !!}">{!! $article->excerptTitle(80) !!}</a>
                                    </h3>
                                    <p><i class="fa fa-clock-o"></i>{!! $article->posted_at->format('M d,Y') !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @include('layouts.inc.tools.facebook-comments')
            </div>
            <div class="main-right-side">
                @include('layouts.blog.main-right-side')
            </div>

        </div>
    </div>
@stop

@section('plugins')
    <script src="{!! asset('plugins/fancybox/dist/jquery.fancybox.js') !!}"></script>
@stop
@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                comments: {},
                newComment: {
                    body: '',
                    user_id: '',
                    parent_id: ''
                },
                formErrors: {}
            },
            created: function () {
                this.fetchComments()
            },
            methods: {
                fetchComments() {
                    let vm = this;
                    vm.$http.get('/api/v1/posts/{!! $post->id !!}/comments').then(response => {
                        console.log(response.data);
                        vm.comments = response.data
                    })
                },
                createComment() {
                    let vm = this;
                    let input = this.newComment;
                    vm.$http.post('/api/v1/posts/{!! $post->id !!}/comments', input).then(response => {
                        alert('Comment added');
                    });
                    this.fetchComments();
                }
            }
        });

        $().fancybox({
            selector: '[data-fancybox="images"]',
            thumbs: false,
            hash: false,
        });

    </script>

    <script type="text/javascript">
        // the function we call when we click on each img tag
        function fancyBoxMe(e) {
            var numElemets = $("#main-single-article img").length;
            if ((e + 1) == numElemets) {
                nexT = 0
            } else {
                nexT = e + 1
            }
            if (e == 0) {
                preV = (numElemets - 1)
            } else {
                preV = e - 1
            }
            var tarGet = $('#main-single-article img').eq(e).attr('src');
            $().fancybox({
                href: tarGet,
                helpers: {
                    title: {
                        type: 'inside'
                    }
                },
                afterLoad: function () {
                    this.title = 'Image ' + (e + 1) + ' of ' + numElemets + ' :: <a href="javascript:;" onclick="fancyBoxMe(' + preV + ')">prev</a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="fancyBoxMe(' + nexT + ')">next</a>'
                }
            }); // fancybox
        } // fancyBoxMe

        // bind click to each img tag
        $(document).ready(function () {
            $("#main-single-article img").each(function (i) {
                $(this).bind('click', function () {
                    fancyBoxMe(i);
                }); //bind
            }); //each
        }); // ready
    </script>

    @if (config('services.facebook.client_id'))
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId={{ config('services.facebook.client_id') }}";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    @endif

@stop
