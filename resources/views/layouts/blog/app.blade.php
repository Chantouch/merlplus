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
    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('storage/default/ico/apple-icon-57x57.png') !!}">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('storage/default/ico/apple-icon-60x60.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('storage/default/ico/apple-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('storage/default/ico/apple-icon-76x76.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('storage/default/ico/apple-icon-114x114.png') !!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('storage/default/ico/apple-icon-120x120.png') !!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('storage/default/ico/apple-icon-144x144.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('storage/default/ico/apple-icon-152x152.png') !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('storage/default/ico/apple-icon-180x180.png') !!}">
    <link rel="icon" type="image/png" sizes="192x192"
          href="{!! asset('storage/default/ico/android-icon-192x192.png') !!}">
    <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('storage/default/ico/favicon-32x32.png') !!}">
    <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('storage/default/ico/favicon-96x96.png') !!}">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('storage/default/ico/favicon-16x16.png') !!}">
    <link rel="manifest" href="{!! asset('storage/default/ico/manifest.json') !!}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{!! asset('storage/default/ico/ms-icon-144x144.png') !!}">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{ asset(config('settings.app_favicon')) }}">
    <title>{{ MetaTag::get('title') }}</title>
    {!! MetaTag::tag('description') !!}{!! MetaTag::tag('keywords') !!}
    <link rel="canonical" href="{{ $fullUrl }}"/>
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
    <link href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{!! asset('blog/css/bootstrap.min.css') !!}" rel="preload" media="all">
    <link href="{!! asset('blog/css/main.css') !!}" rel="preload" media="all">
    <link href="{!! asset('blog/css/styles.css') !!}" rel="preload" media="all">
    <link href="{!! asset('blog/css/responsive.css') !!}" rel="preload" media="all">
    <link href="{!! asset('plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.min.css') !!}" rel="preload">
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
                        <a href="https://www.facebook.com/chantouch.sek" target="_blank" title="Chantouch Sek">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/DevidCs83" target="_blank" title="Chantouch Sek">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.bookingkh.com">Powered by BookingKh</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Main Home Layout Ends -->
    <a href="#" class="scrollToTop">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>


<!-- Scripts -->
<script src="{{ asset('blog/js/app.min.js') }}" type="text/javascript"></script>
<script async src="{{ asset('blog/js/main.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{!! asset('blog/js/vue.js') !!}"></script>
<script src="{!! asset('plugins/SocialShare/SocialShare.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('plugins/OwlCarousel2-2.2.1/dist/owl.carousel.min.js') !!}" type="text/javascript"></script>
<script async src="{!! asset('blog/js/loadCSS.js') !!}" type="text/javascript"></script>

@yield('plugins')
@yield('scripts')
<script type="text/javascript">
    @if($agent->isMobile() || $agent->isTablet())
    new UISearch(document.getElementById('sb-search'));
    new Vue({
        el: '#app',
        data: {
            categories: [],
        },
        created: function () {
            //this.categoryList();
        },
        methods: {
            categoryList: function () {
                let vm = this;
                vm.$http.get('/api/v1/category').then((response) => {
                    this.categories = response.data;
                })
            }
        }
    });
    @endif

    /* Social Share */
    $('.share').ShareLink({
        title: '{{ addslashes(MetaTag::get('title')) }}',
        text: '{!! addslashes(MetaTag::get('title')) !!}',
        url: '{!! $fullUrl !!}',
        width: 640,
        height: 480
    });

    (function () {
        if (typeof window.CustomEvent === "function") {
            return false;
        }

        function CustomEvent(event, params) {
            params = params || {bubbles: false, cancelable: false, detail: undefined};
            var evt = document.createEvent("CustomEvent");
            evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
            return evt;
        }

        CustomEvent.prototype = window.Event.prototype;
        window.CustomEvent = CustomEvent;
    })();

</script>
</body>
</html>