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
        .modal-dialog {
            width: 762px;
        }

        .modal-footer a:first-child {
            float: left;
            margin-right: 10px;
            margin-bottom: 2px;
        }

        .modal-footer a:last-child {
            float: left;
        }

        @media screen and (max-width: 768px) {
            .modal-dialog {
                width: auto;
            }

            .modal-footer a:first-child {
                float: none;
                margin-right: 0;
                margin-bottom: 0;
            }
            .modal-footer a:first-child img {
                margin-bottom: 5px;
            }

            .modal-footer a:last-child {
                float: none;
            }

        }

    </style>
@stop
@section('main-news-block')
    <div class="main-news-blks">
        <div class="hm-slider-cont">
            @include('blog/inc/hm-news-slider')
        </div>
        @include('blog/_components/_right_ads')
    </div>
@stop
@section('content')
    @include('blog/inc/section1')
    @include('blog/inc/top-news')

    <div class="modal fade" id="myPopupAds" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="time-closed-modal">
                        &times;
                    </button>
                    <h4 class="modal-title" id="mySmallModalLabel">Advertisement</h4>
                </div>
                <div class="modal-body">
                    @if($popup_720x300->count())
                        @foreach($popup_720x300 as $ads)
                            <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                <img alt="{!! $ads->provider_name !!}" class="img-responsive center-block"
                                     src="{!! asset($ads->banner()->media_url) !!}"/>
                            </a>
                        @endforeach
                    @else
                        <a href="{!! url('contact') !!}" title="Contact us now">
                            <img src="{!! asset('images/Banner-Advertising-720x300.png') !!}"
                                 alt="Place your ads here!" class="img-responsive center-block">
                        </a>
                    @endif
                </div>
                <div class="modal-footer">

                    @if($popup_468x60->count())
                        @foreach($popup_468x60 as $ads)
                            <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                <img alt="{!! $ads->provider_name !!}" src="{!! asset($ads->banner()->media_url) !!}"
                                     class="img-responsive"/>
                            </a>
                        @endforeach
                    @else
                        <a href="{!! url('contact') !!}" title="Contact us now">
                            <img src="{!! asset('images/468x60-banner.png') !!}" alt="Place your ads here!"
                                 class="img-responsive center-block">
                        </a>
                    @endif

                    @if($popup_234x60->count())
                        @foreach($popup_234x60 as $ads)
                            <a href="{!! $ads->url !!}" target="_blank" rel="nofollow">
                                <img alt="{!! $ads->provider_name !!}" src="{!! asset($ads->banner()->media_url) !!}"
                                     class="img-responsive"/>
                            </a>
                        @endforeach
                    @else
                        <a href="{!! url('contact') !!}" title="Contact us now">
                            <img src="{!! asset('images/234x60-banner.png') !!}" alt="Place your ads here!"
                                 class="img-responsive center-block">
                        </a>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            var cookie = getCookie('hidden');
            if (!cookie) {
                setTimeout(function () {
                    $('#myPopupAds').modal();
                }, 500);
            }

            $("#time-closed-modal").click(function () {
                setCookie("hidden", "myPopupAds", 5)
            });
        });
    </script>
@stop