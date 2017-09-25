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
        .my-contrain {
            position: relative;
        }

        .fix-bg {
            position: absolute;
            left: 0;
            top: -20px;
            width: 100%;
            height: 800px;
            overflow: hidden;
        }

        .fix-bg .img {
            position: absolute;
            left: -20px;
            height: 100%;
            top: 0;
            width: calc(100% + 40px);
            background: no-repeat top center;
            background-size: 100% auto;
            -webkit-filter: blur(10px);
            -moz-filter: blur(10px);
            -o-filter: blur(10px);
            -ms-filter: blur(10px);
            filter: blur(10px);
        }

        .fix-bg .inside {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: -webkit-linear-gradient(top, rgba(246, 246, 246, 0) 0, #f2f2f2 100%);
            background: linear-gradient(to bottom, rgba(246, 246, 246, 0) 0, #f2f2f2 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80f6f6f6', endColorstr='#f6f6f6', GradientType=0);
        }

        .container-position, .artcl-main, .smedia {
            position: relative;
        }

        .title {
            font-size: 18px;
            font-weight: 900;
            margin: 0 0 10px;
        }

        .artcl-reltd .reltd-sngl img {
            height: 75px;
        }

        [v-cloak] {
            display: none;
        }

        .ads_items {
            margin-bottom: 15px;
        }
    </style>
@stop
@section('post-backgrounds')
    <div class="fix-bg">
        @if($post->hasThumbnail())
            <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload"
                 data-src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
        @else
            <img alt="{!! $post->excerptTitle(60) !!}" class="img lazyload"
                 data-src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
        @endif
        <div class="inside"></div>
    </div>
@stop
@section('main_right_ads_bar')
    @if(isset($single_article_ads))
        <div class="ads_items text-center">
            @if(isset($main_right_ads))
                @if(count($main_right_ads))
                    @foreach($main_right_ads->take(2) as $index => $ads)
                        @if($index < 2)
                            <div class="ad-rt">
                                <a href="{!! $ads->url !!}" target="_blank">
                                    <img alt="{!! $ads->provider_name !!}" class="lazyload"
                                         data-src="{!! asset($ads->banner()->media_url) !!}"/>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    @endif
@stop
@section('new_article_single_article')
    <div class="panel panel-info">
        <div class="panel-heading">
            New Articles
        </div>
        <div class="panel-body">
            @if($post->categories->count())
                @foreach($post->categories->first()->articles->take(6) as $article)
                    <div class="media">
                        <div class="media-left media-top">
                            @if($article->hasThumbnail())
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                         class="media-object lazyload" width="80" alt="{!! $article->title !!}">
                                </a>
                            @else
                                <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                                   title="{!! $article->title !!}">
                                    <img data-src="{!! asset('blog/img/samples/sample.jpg') !!}"
                                         class="media-object lazyload" width="80" alt="{!! $article->title !!}">
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
    <div class="main-left-side">
        <div class="artcl-main float-width">
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
                @include('blog.inc.share')
                <article class="float-width articl-data">
                    <div class="content">
                        {!! $post->description !!}
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>{!! __('posts.show.article') !!} ៖ {!! $post->checkAuthor()? $post-> author->name : 'Admin' !!} </p>
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
            @include('blog.inc.share')
        </div>
        <!-- Ads button of single article -->
        @if(isset($single_article_ads))
            <div class="ads_items text-center">
                @foreach($single_article_ads->random(1) as $index => $article_ad)
                    @if($article_ad->hasBanner())
                        @if($article_ad->hasBanner())
                            <img data-src="{!! asset($article_ad->banner()->media_url) !!}" width="728" height="90"
                                 class="lazyload" alt="{!! $article_ad->provider_name !!}">
                        @else
                            {!! $article_ad->provider_name !!}
                        @endif
                    @endif
                @endforeach
            </div>
        @endif
        <div class="jumbotron">
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
                                     class="img-responsive lazyload" alt="{!! $article->title !!}">
                            </a>
                        @else
                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}"
                               title="{!! $article->title !!}">
                                <img alt="{!! $article->excerptTitle(60) !!}" class="img-responsive lazyload"
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
        <div class="fb-comments" data-href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}"
             data-width="100%"
             data-numposts="5"></div>
        <!-- Facebook share JS -->
        <div id="fb-root"></div>
    </div>
    <div class="main-right-side">
        @include('layouts.blog.main-right-side')
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

        $(".main-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: false,
            arrows: false,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    </script>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1906910106248873";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Twitter share JS -->
    <script>
        !function (d, s, id) {
            let js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + '://platform.twitter.com/widgets.js';
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, 'script', 'twitter-wjs');
    </script>

    <!-- Pinterest share JS -->
    <script type="text/javascript" async src="https://assets.pinterest.com/js/pinit.js"></script>

@stop
