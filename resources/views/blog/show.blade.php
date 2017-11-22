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
    <style>
        .ads_side_single {
            width: 300px;
            height: 250px;
            background-image: url({!! asset('blog/img/logo.png') !!});
            background-color: transparent;
            background-position: center center;
            background-size: auto 30%;
            background-repeat: no-repeat;
            margin: 0 0 15px auto;
            display: block;
        }

        @media screen and (min-width: 768px) {
            .ads_side_single {
                display: none;
            }
        }

    </style>
@stop
@section('post-background')
    <div class="fix-bg">
        @if($post->hasThumbnail())
            <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="img"
                 src="{!! asset(route('media.posts.path',[$post->id,'large_'.$post->thumbnail()->filename])) !!}"/>
        @else
            <img alt="{!! $post->removeSpecialChar($post->title) !!}" class="img"
                 src="{!! asset('blog/img/samples/sample.jpg') !!}"/>
        @endif
        <div class="inside"></div>
    </div>
@stop
@section('main_right_ads_bar')
    @if(isset($main_right_ads))
        <div class="ads_items text-center pos-relative">
            @if($main_right_ads->count())
                @if(count($main_right_ads) > 1)
                    @foreach($main_right_ads->random(2) as $index => $ads)
                        @if($index < 2)
                            <div class="ad-rt">
                                <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                    <img alt="{!! $ads->provider_name !!}" class="lazyload img-responsive center-block"
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
                                <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                    <img alt="{!! $ads->provider_name !!}" class="lazyload img-responsive center-block"
                                         src="{!! asset('blog/img/blur.jpg') !!}"
                                         data-src="{!! asset($ads->banner()->media_url) !!}"/>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @else
                @for($x=1;$x<=2;$x++)
                    <div class="ad-rt">
                        <img src="{!! asset('images/loading-preloader.gif') !!}" alt="Place your ads here!"
                             data-src="{!! asset('images/right-bar-ads-'.$x.'.jpg') !!}"
                             class="lazyload img-responsive center-block"/>
                    </div>
                @endfor
            @endif
        </div>
    @endif
@stop
@section('new_article_single_article')
    <div class="panel panel-info pos-relative">
        @include('blog._components.latest-post')
    </div>

    <div class="panel panel-info pos-relative">
        @include('blog._components.most-read')
    </div>

@stop
@section('content')
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
                                         class="lazyload img-responsive center-block"
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
                        <a href="{!! route('blog.article.show', $previousPost->getRouteKey()) !!}">
                            <i class="fa fa-angle-left"></i> {!! $previousPost->excerptTitle(50) !!}
                        </a>
                    @endif
                </div>
                <div class="artcl-nxt w50 blocky text-right">
                    @if(count($nextPost))
                        <a href="{!! route('blog.article.show', $nextPost->getRouteKey()) !!}">
                            {!! $nextPost->excerptTitle(50) !!} <i class="fa fa-angle-right"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!--Ads on single post top-->
            <div class="artcl-body float-width ads_side_single">
                <ins class="text-center">
                    @if($top_single_ads->count())
                        @foreach($top_single_ads as $ad)
                            <a href="{!! $ad->url !!}" target="_blank">
                                @if($ad->hasBanner())
                                    <img src="{!! asset($ad->banner()->media_url) !!}" width="728"
                                         height="90" class="lazyload img-responsive center-block"
                                         alt="{!! $ad->provider_name !!}">
                                @endif
                            </a>
                        @endforeach
                    @else
                        <a href="{!! url('contact') !!}" target="_blank">
                            <img src="{!! asset('images/right-bar-ads-2.jpg') !!}"
                                 width="300" height="250" alt="" class="img-responsive center-block">
                        </a>
                    @endif
                </ins>
            </div>

            <div class="artcl-body float-width">
                <h2>{!! $post->title !!}</h2>
                <!-- The Article Social Media Share -->
                <div class="lefty artcl-tags">
                    <h5>
                        <span><i class="fa fa-user"></i>{!! $post->checkAuthor() !!}</span>
                        <span><i class="fa fa-clock-o"></i>{!! $post->posted_at !!}</span>
                        <span><i class="fa fa-comment-o"></i>{!! count($post->comments) !!} {!! __('app.comment') !!}</span>
                    </h5>
                </div>
                @include('layouts.inc.social.horizontal')
                <article class="float-width articl-data">
                    <div class="content">
                        {!! $post->description !!}
                    </div>
                </article>
                <!-- The Article Social Media Share -->
                <div class="artcl-scl float-width">
                    <div class="lefty artcl-tags tag-info col-md-12">
                        @if(!empty($post->origin_source) && !empty($post->source_title))
                            <p>{!! __('app.article.source') !!}
                                <a href="{!! $post->origin_source !!}" title="{!! $post->source_title !!}"
                                   target="_blank">
                                    {!! $post->source_title !!}
                                </a>
                            </p>
                            <p>{!! __('app.article.translator') !!} {!! $post->contributor ? $post->contributor : 'Admin' !!} </p>
                        @else
                            <p>{!! __('posts.show.article') !!} {!! $post->checkAuthor()? $post-> author->name : 'Admin' !!} </p>
                        @endif
                    </div>
                    <div class="lefty artcl-tags tag-info">
                        <h3>{!! __('app.tag') !!} : </h3>
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
            </div>
        </div>
        <!-- Ads button of single article -->
        @if(isset($single_article_ads))
            <div class="ads_items text-center">
                @if($single_article_ads->count())
                    @foreach($single_article_ads as $index => $article_ad)
                        @if($article_ad->hasBanner())
                            <img data-src="{!! asset($article_ad->banner()->media_url) !!}" width="728" height="90"
                                 src="{!! asset('blog/img/blur.jpg') !!}"
                                 class="lazyload img-responsive center-block" alt="{!! $article_ad->provider_name !!}">
                        @endif
                    @endforeach
                @else
                    <a href="{!! route('blog.contact.index') !!}" target="_blank">
                        <img alt="Image blog default page" src="{!! asset('images/ads-728x90.png') !!}" height="90"
                             class="img-responsive center-block"/>
                    </a>
                @endif
            </div>
        @endif
        <div class="clearfix"></div>
        <div class="jumbotron color5bc0de">
            <div class="title">ភ្ជាប់ទំនាក់ទំនងជាមួយ <span> MerlPlus</span></div>
            <div class="fb-like" data-href="https://www.facebook.com/pg/merlplusOfficial"
                 data-layout="button_count" data-action="like" data-size="large" data-show-faces="false"
                 data-share="true"></div>
        </div>
        <div class="clearfix"></div>
        @include('blog/_components/related')
        @include('layouts/inc/tools/facebook-comments')
    </div>

    <div class="main-right-side">
        @include('layouts/blog/main-right-side')
    </div>
@stop
@section('scripts')
    <script rel="preload" src="{!! asset('plugins/SocialShare/SocialShare.min.js') !!}" type="text/javascript"></script>
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
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                latest_posts: [],
                most_read_posts: [],
                options: {
                    isLoading: false,
                    imgUrl: ''
                },
                endpoint: '/api/v2/'
            },
            created: function () {
                this.getLatestPost();
                this.getMostReadPost();
            },
            methods: {
                getLatestPost() {
                    let vm = this;
                    this.options.isLoading = true;
                    vm.$http.get(this.endpoint + 'latest').then(response => {
                        this.options.isLoading = false;
                        vm.latest_posts = response.data.data
                    })
                },
                getMostReadPost() {
                    let vm = this;
                    this.options.isLoading = true;
                    vm.$http.get(this.endpoint + 'most-read').then(response => {
                        this.options.isLoading = false;
                        vm.most_read_posts = response.data.data
                    })
                }
            }
        });
        $(document).ready(function () {
            $('.content p').each(function () {
                if ($(this).find('img').length) {
                    $(this).find("img").unwrap();
                }
            });

            /* Social Share */
            $('.share').ShareLink({
                title: '{{ addslashes(MetaTag::get('title')) }}',
                text: '{!! addslashes(MetaTag::get('title')) !!}',
                url: '{!! Request::url() !!}',
                width: 640,
                height: 480
            });
        });
    </script>
@stop
