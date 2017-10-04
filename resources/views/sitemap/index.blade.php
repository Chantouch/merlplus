<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/2/2017
 * Time: 11:13 PM
 */
?>
@extends('layouts.blog.app')
@section('css')
    <link rel="stylesheet" href="{!! asset('blog/css/styles.css') !!}">
@stop
@section('content')
    <div class="row">
        <h1 class="text-center page-title">Sitemap</h1>
        <hr class="center-block small text-hr">
        <div class="col-md-12 page-content">
            <div class="inner-box pos-relative">
                <h2 class="title-2">List of Categories and Sub-categories</h2>
                <div class="row">
                    @if($categories->count())
                        @foreach($categories as $category)
                            <div class="col-md-6">
                                <h3 class="cat-title">
                                    <a href="{!! route('blog.topics.show', [$category->getRouteKey()]) !!}">
                                        <i class="fa fa-check m-r-10"></i>{!! $category->name !!}
                                        <span class="count">{!! $category->articles->count() !!}</span>
                                    </a>
                                </h3>
                                <div class="list-group">
                                    @if($category->articles->count())
                                        @foreach($category->articles->take(6) as $index => $article)
                                            <div class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}">
                                                            <img class="media-object lazyload"
                                                                 data-src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                                                 src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEzLjQ2MDkzNzUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg=="
                                                                 alt="{!! $article->title !!}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="{!! route('blog.article.show', [$article->getRouteKey()]) !!}">
                                                                {!! $article->excerptTitle(50) !!}
                                                            </a>
                                                        </h4>
                                                        <p>{!! $article->excerpt(800) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($category->articles->count() > 6)
                                            <a href="{!! route('blog.topics.show', [$category->getRouteKey()]) !!}"
                                               class="list-group-item">
                                                View More ({!! $category->articles->count() !!} )
                                            </a>
                                        @else
                                            <a href="{!! route('blog.topics.show', [$category->getRouteKey()]) !!}"
                                               class="list-group-item">View All</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
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