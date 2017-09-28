<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ MetaTag::get('title') }} | {{ config('app.name', 'Merlplus') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('keywords') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}
    <meta property="fb:app_id" content="1906910106248873" />
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="https://www.merlplus.com/" />
    <link rel="stylesheet" href="{!! asset('blog/css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/main.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/responsive.css') !!}">
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
    <!-- News Ticker -->
    {{--@if(!Request::is('article/*'))--}}
    {{--<div class="container">--}}
    {{--@include('layouts.blog.breaking-news')--}}
    {{--</div>--}}
    {{--@endif--}}

    <div class="container-position">
        @yield('post-background')
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
            <a class="lefty">&#169; Copyright 2017, All Rights Reserved</a>
            <a href="#" class="righty">Design and development by: Chantouch SEK</a>
        </div>
    </div>
    <!-- Main Home Layout Ends -->
    <a href="javascript:void (0)" class="scrollToTop">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Scripts -->
<script src="{{ asset('blog/js/app-383kldle83903.min.js') }}"></script>
<script type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
@yield('plugins')

@yield('scripts')
<script !src="">
    new UISearch( document.getElementById( 'sb-search' ) );
    window.addEventListener("load", function (event) {
        var timeout = setTimeout(function () {
            lazyload();
        }, 600);
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

</script>
</body>
</html>