<?php
$fullUrl = Request::url();
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{--<script async src="https://cdn.ampproject.org/v0.js"></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="{{ config('settings.app_name') }}">
    <link rel="shortcut icon" href="{{ asset(config('settings.app_favicon')) }}">
    <title>{{ MetaTag::get('title') }} - {!! config('settings.app_name') !!}</title>
    {!! MetaTag::tag('description') !!}{!! MetaTag::tag('keywords') !!}
    {!! MetaTag::tag('canonical', $fullUrl) !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::tag('robots') !!}
    {!! MetaTag::tag('site_name', config('settings.app_name', 'Merlplus')) !!}
    {!! MetaTag::tag('url', $fullUrl); !!}
    {!! MetaTag::tag('locale', 'en_EN') !!}
    @if(isset($dnsPrefetch))
        @if (count($dnsPrefetch) > 0)
            @foreach($dnsPrefetch as $dns)
                <link rel="dns-prefetch" href="{{ $dns }}">
            @endforeach
        @endif
    @endif
    @if (config('services.facebook.client_id'))
        <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}"/>
        {!! MetaTag::twitterCard() !!}
    @endif
    @if (config('settings.google_site_verification'))
        <meta name="google-site-verification" content="{{ config('settings.google_site_verification') }}"/>
    @endif
    @if (config('settings.msvalidate'))
        <meta name="msvalidate.01" content="{{ config('settings.msvalidate') }}"/>
    @endif
    @if (config('settings.alexa_verify_id'))
        <meta name="alexaVerifyID" content="{{ config('settings.alexa_verify_id') }}"/>
    @endif
    <link href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" media="all">
    <link href="{!! asset('blog/css/bootstrap.min.css') !!}" rel="stylesheet" media="all">
    <link href="{!! asset('blog/css/main.css') !!}" rel="stylesheet" media="all">
    <link href="{!! asset('plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.min.css') !!}" rel="stylesheet"
          media="all">
    <script type="text/javascript">
        (function (b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function () {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = '//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-51288724-1');
        ga('send', 'pageview');
    </script>
    <style>
        .search-label {
            display: block;
            margin-bottom: 0;
        }

        @media (max-width: 767px) {
            #ads-close {
                margin: 0 auto;
                padding: 5px;
                width: 20px;
                background: #710101;
                color: #FFF;
                height: 20px;
                top: 0;
            }
        }

        @media (max-width: 767px) {
            #ads-close, .app .sponsor {
                position: absolute;
                right: 0;
            }
        }
    </style>
    @yield('css')
</head>
<body>
<div id="app">
    @if($agent->isMobile() || $agent->isTablet())
        <div class="top-toolbar">
            @include('layouts.blog.top-toolbar')
        </div>
    @endif
    @if($agent->isDesktop())
        <div class="logo-top-ad">
            @include('layouts.blog.logo-ads')
        </div>
    @endif

    <div class="main-menu">
        @include('layouts.blog.menu')
    </div>
    @if($agent->isDesktop())
        <div class="container">
            @yield('main-news-block')
        </div>
    @endif
    <div class="container-position">
        @yield('post-background')
        @yield('contact-map')
    </div>
    <div class="container">
        @yield('content')
    </div>
    <!-- Footer -->
    <div class="main-footers">
        <div class="container">
            @include('layouts.blog.footer')
        </div>
    </div>
    <!-- Copy right footer -->
    <div class="copy-rt-ftr">
        <div class="container">
            <ul class="pull-left navbar-link footer-nav list-inline left">
                <li>
                    @if(count($pages))
                        @foreach($pages as $page)
                            <a href="{!! route('blog.page.show',[$page->getRouteKey()]) !!}">
                                {!! $page->name !!}
                            </a>
                        @endforeach
                    @endif
                    <a href="{!! route('blog.contact.index') !!}"> {!! __('app.contact') !!} </a>
                    <a href="{!! route('blog.sitemap.html') !!}"> Sitemap </a>
                </li>
                <li></li>
            </ul>
            <ul class="pull-right navbar-link footer-nav list-inline right">
                <li> © 2017 <a href="{!! config('app.url') !!}">
                        {!! config('settings.app_name') !!}
                    </a>
                </li>
                @if(config('settings.social_activated'))
                    <li>
                        <a href="https://www.facebook.com/chantouch.sek" target="_blank" title="Chantouch Sek"
                           rel="noreferrer">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/DevidCs83" target="_blank" title="Chantouch Sek" rel="noreferrer">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.bookingkh.com" target="_blank" rel="noreferrer">Powered by BookingKh</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <a href="#" class="scrollToTop">
        <i class="fa fa-chevron-up"></i>
    </a>
    <div class="navbar navbar-default navbar-fixed-bottom hidden-lg hidden-md visible-xs" id="banner-top-hide">
        <div class="container">
            @include('blog.shared._top_banner')
        </div>
        <a href="javascript:void (0);" title="Close" id="ads-close">
            <span style="display:none;">បិទ &nbsp;</span>
            <span><img class="img-responsive center-block" src="{!! asset('images/dialog-close.png') !!}"></span>
        </a>
    </div>
</div>
<!-- Scripts -->
<script rel="preload" src="{{ asset('blog/js/app.min.js') }}" type="text/javascript"></script>
<script rel="preload" async src="{{ asset('blog/js/main.min.js') }}" type="text/javascript"></script>
<script rel="preload" type="text/javascript" src="{!! asset('blog/js/vue.js') !!}"></script>
<script rel="preload" src="{!! asset('plugins/OwlCarousel2-2.2.1/dist/owl.carousel.min.js') !!}"
        type="text/javascript"></script>
@yield('plugins')
@yield('scripts')
<script type="text/javascript">
    @if($agent->isMobile() || $agent->isTablet())
    new UISearch(document.getElementById('sb-search'));
    @endif

    $(function () {
        $("#ads-close").click(function () {
            $('#banner-top-hide').slideToggle().toggleClass().hide("slow");
        });
    })
</script>
<noscript>Your browser does not support JavaScript!</noscript>
</body>
</html>