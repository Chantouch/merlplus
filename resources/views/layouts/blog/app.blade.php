<!DOCTYPE html>
{{--<html lang="{{ app()->getLocale() }}">--}}
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ MetaTag::get('title') }} | {{ config('app.name', 'Merlplus.com') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('keywords') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}
    {!! MetaTag::tag('image', asset('images/default-logo.png')) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('blog/css/css8b0d.css?file=bootstrap.min') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css97f7.css?file=bootstrap-theme') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css4610.css?file=normalize') !!}">
    <link rel="stylesheet" href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/csse1a8.css?file=elements') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/main.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css9a38.css?file=responsive') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/cssf83a.css?file=calendar') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/styles.css') !!}">
    <script src="{!! asset('blog/js/modernizr.min.js') !!}"></script>
    <style>
        .hm-slider .slides {
            background-image: url({!! asset('images/loading.gif') !!});
        }
    </style>
    @yield('css')
</head>
<body>
<div id="app">
    <div class="site-container">
        <div class="site-pusher">
            <!-- Main Home Layout start -->
            <!-- Top toolbar -->
            <div class="top-tool-bar">
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
            @if(!Request::is('article/*'))
                <div class="container">
                    @include('layouts.blog.breaking-news')
                </div>
            @endif

            <div class="container-position">
                @yield('post-background')
                <div class="container">
                    <!-- Main Left side -->
                    <div class="main-left-side">
                        @yield('content')
                    </div>
                    <!-- Main Right side -->
                    <div class="main-right-side">
                        @include('layouts.blog.main-right-side')
                    </div>
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
        </div> <!-- END site-pusher -->
    </div> <!-- END site-container -->
    <a href="javascript:void (0)" class="scrollToTop">Scroll To Top</a>
</div>

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<script src="{!! asset('blog/js/jquery-3.2.1.min.js') !!}"></script>
{{--<script src="{!! asset('blog/js/js5a10.js?file=vendor/jquery-3.2.1.min') !!}"></script>--}}

<script src="{!! asset('bootstrap/dist/js/bootstrap.min.js') !!}"></script>

<script src="{!! asset('blog/js/jsec26.css?file=jquery.smartmenus.min') !!}"></script>

<script src="{!! asset('blog/js/js047d.css?file=jquery.flexslider-min') !!}"></script>

<script src="{!! asset('blog/js/js288f.css?file=newsTicker') !!}"></script>

<script src="{!! asset('blog/js/js6a7f.css?file=jquery.customSelect.min') !!}"></script>

<script src="{!! asset('blog/js/jse3a4.css?file=retina-1.1.0.min') !!}"></script>

<script src="{!! asset('blog/js/jsf0b3.css?file=jflickrfeed.min') !!}"></script>

<script src="{!! asset('blog/js/jsf83a.css?file=calendar') !!}"></script>

<script src="{!! asset('blog/js/main.min.js') !!}"></script>

<script src="{!! asset('blog/js/slick.min.js') !!}"></script>
<script src="{!! asset('blog/js/jquery.lazyload.min.js') !!}"></script>
<script src="{!! asset('blog/js/echo.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
<script src="{!! asset('js/vue/vue-resource.min.js') !!}"></script>
<script src="{!! asset('js/vue/vue-axios.min.js') !!}"></script>
@yield('plugins')

@yield('scripts')
<script !src="">
    $(function () {
        $("img").lazyload({
            effect: "fadeIn"
        });
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false,
            callback: function (element, op) {
                if (op === 'load') {
                    element.classList.add('loaded');
                } else {
                    element.classList.remove('loaded');
                }
            }
        });
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

    $(document).ready(function () {
        (function ($) {
            $('#header__icon').click(function (e) {
                e.preventDefault();
                $('body').toggleClass('with--sidebar');
            });
            $('#site-cache').click(function (e) {
                $('body').removeClass('with--sidebar');
            });
        })(jQuery);
    });

</script>
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
</body>
</html>