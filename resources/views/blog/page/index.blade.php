<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/2/2017
 * Time: 11:13 PM
 */
?>
@extends('layouts.blog.app')
@section('content')
    <div class="row">
        <h1 class="text-center page-title">{!! $page->name !!}</h1>
        <hr class="center-block small text-hr">
        <div class="col-md-12 page-content">
            <div class="inner-box pos-relative jumbotron">
                {!! $page->description !!}
            </div>
        </div>
        <div style="margin: 25px 0; text-align: center;">
            <button class="btn btn-fb share s_facebook">
                <i class="fa fa-facebook"></i>
            </button>&nbsp;
            <button class="btn btn-tw share s_twitter">
                <i class="fa fa-twitter"></i>
            </button>&nbsp;
            <button class="btn btn-danger share s_plus">
                <i class="fa fa-google-plus"></i>
            </button>&nbsp;
            <button class="btn btn-fb share s_linkedin">
                <i class="fa fa-linkedin"></i>
            </button>
        </div>
    </div>
@stop

@section('scripts')
    <script rel="preload" src="{!! asset('plugins/SocialShare/SocialShare.min.js') !!}" type="text/javascript"></script>
    <script>
        /* Social Share */
        $('.share').ShareLink({
            title: '{{ addslashes(MetaTag::get('title')) }}',
            text: '{!! addslashes(MetaTag::get('title')) !!}',
            url: '{!! Request::url() !!}',
            width: 640,
            height: 480
        });
    </script>

@endsection