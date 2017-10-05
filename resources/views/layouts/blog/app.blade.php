<?php
$fullUrl = Request::url();
?>
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ MetaTag::get('title') }} | {{ config('settings.app_name', 'Merlplus') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-title" content="{{ config('settings.app_name') }}">
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('keywords') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::tag('robots') !!}
    {!! MetaTag::tag('site_name', config('settings.app_name', 'Merlplus')) !!}
    {!! MetaTag::tag('url', $fullUrl); !!}
    {!! MetaTag::tag('locale', 'en_EN') !!}
    <link rel="canonical" href="{!! $fullUrl !!}"/>
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
    <link rel="stylesheet" href="{!! asset('blog/css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/main.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/responsive.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/OwlCarousel2-2.2.1/dist/assets/owl.theme.default.min.css') !!}">
    <style>
        .hm-slider .slides {
            background-image: url({!! asset('images/loading.gif') !!});
        }
    </style>
    <script>
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
    <!-- Main Home Layout start -->
    <!-- Top toolbar -->
    <div class="top-toolbar">
        @include('layouts.blog.top-toolbar')
    </div>
    <!-- Logo and Ad banner -->
    <div class="logo-top-ad">
        @include('layouts.blog.logo-ads')
    </div>
    <!-- Main Menu -->
    <div class="main-menu">
        @include('layouts.blog.menu')
    </div>
    <!-- Home Slider and Big news blocks -->
    <div class="container">
        @yield('main-news-block')
    </div>

    <div class="container-position">
        @yield('post-background')
        @yield('contact-map')
        <div class="container">
            @yield('content')
        </div>
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
                @endif
                <li>
                    <a href="https://www.bookingkh.com">Powered by BookingKh</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Main Home Layout Ends -->
    <a href="javascript:void (0)" class="scrollToTop">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Scripts -->
<script src="{{ asset('blog/js/app-383kldle83903.min.js') }}"></script>
<script src="{{ asset('blog/js/main.min.js') }}"></script>
<script type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
<script src="{!! asset('js/vue/vue-resource.min.js') !!}"></script>
{{--<script src="{!! asset('js/vue/vue-axios.min.js') !!}"></script>--}}
<script src="{!! asset('plugins/SocialShare/SocialShare.min.js') !!}"></script>
<script src="{!! asset('plugins/OwlCarousel2-2.2.1/dist/owl.carousel.min.js') !!}"></script>
@yield('plugins')

@yield('scripts')
<script>
    new UISearch(document.getElementById('sb-search'));
    window.addEventListener("load", function (event) {
        var timeout = setTimeout(function () {
            lazyload();
        }, 50);
    });

    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            lazyLoad: true,
            lazyContent: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false,
                    dots: true,
                    loop: true,
                    autoplay: true
                },
                600: {
                    items: 3,
                    nav: false,
                    dots: true,
                    loop: true
                },
                1000: {
                    items: 5,
                    nav: false,
                    dots: true,
                    loop: false
                }
            }
        })
    });

    var $ = jQuery.noConflict();
    jQuery(document).ready(function ($) {
        scrollToTop.init();
    });

    var scrollToTop =
        {
            /**
             * When the user has scrolled more than 100 pixels then we display the scroll to top button using the fadeIn function
             * If the scroll position is less than 100 then hide the scroll up button
             *
             * On the click event of the scroll to top button scroll the window to the top
             */
            init: function () {
                //Check to see if the window is top if not then display button
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.scrollToTop').fadeIn();
                    } else {
                        $('.scrollToTop').fadeOut();
                    }
                });
                // Click event to scroll to top
                $('.scrollToTop').click(function () {
                    $('html, body').animate({scrollTop: 0}, 800);
                    return false;
                });
            }
        };

    /* Social Share */
    $('.share').ShareLink({
        title: '{{ addslashes(MetaTag::get('title')) }}',
        text: '{!! addslashes(MetaTag::get('title')) !!}',
        url: '{!! $fullUrl !!}',
        width: 640,
        height: 480
    });

</script>
</body>
</html>