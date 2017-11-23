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
            position: absolute;
            top: 50% !important;
            transform: translate(0, -50%) !important;
            -ms-transform: translate(0, -50%) !important;
            -webkit-transform: translate(0, -50%) !important;
            margin: auto 30%;
            width: 762px;
            height: 480px;
        }

        .modal-content {
            min-height: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .modal-body {
            position: absolute;
            top: 45px;
            left: 0;
            right: 0;
            overflow-y: auto;
        }

        .modal-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #e5e5e5;
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

    <div class="modal fade" id="mySmallModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="time-closed-modal">&times;</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Advertisement</h4>
                </div>
                <div class="modal-body">
                    <img src="{!! asset('images/Banner-Advertising-720x300.png') !!}" alt="Place your ads here!" class="img-responsive center-block">
                </div>
                <div class="modal-footer">
                    <img src="{!! asset('images/468x60-banner.png') !!}" alt="Place your ads here!">
                    <img src="{!! asset('images/234x60-banner.png') !!}" alt="Place your ads here!">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            var cookie = getCookie('hidden');
            console.log(cookie);
            if(!cookie){
                setTimeout(function() {
                    $('#mySmallModal').modal();
                }, 5000);
            }

            $("#time-closed-modal").click(function () {
                setCookie("hidden", "mySmallModal", 10)
            });
        });
    </script>
@stop