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
    <title>{{ MetaTag::get('title') }} | {{ config('app.name', 'Laravel') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('keywords') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}
    {!! MetaTag::tag('image', asset('images/default-logo.png')) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('blog/css/app.css') }}" rel="stylesheet">
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
</div>

<!-- Scripts -->
<script src="{{ asset('blog/js/app.js') }}"></script>

{{--<script src="{!! asset('blog/js/slick.min.js') !!}"></script>--}}
{{--<script src="{!! asset('blog/js/jquery.lazyload.min.js') !!}"></script>--}}
{{--<script src="{!! asset('blog/js/echo.min.js') !!}"></script>--}}

@yield('plugins')

@yield('scripts')
{{--<script !src="">--}}
    {{--$(function () {--}}
        {{--$("img").lazyload({--}}
            {{--effect: "fadeIn"--}}
        {{--});--}}
        {{--echo.init({--}}
            {{--offset: 100,--}}
            {{--throttle: 250,--}}
            {{--unload: false,--}}
            {{--callback: function (element, op) {--}}
                {{--if (op === 'load') {--}}
                    {{--element.classList.add('loaded');--}}
                {{--} else {--}}
                    {{--element.classList.remove('loaded');--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--})--}}

{{--</script>--}}
</body>
</html>