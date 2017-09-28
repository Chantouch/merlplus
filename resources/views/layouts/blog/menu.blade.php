<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:30 AM
 */
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Main Menu -->
            <ul id="main-menu-items" class="sm sm-menu menu-efct">
                <li class="{!! Request::is('/') ? ' active': '' !!}">
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class=""><a href="/topics/sport">{!! __('menu.sport') !!}</a></li>
                <li><a href="/topics/health">{!! __('menu.health') !!}</a></li>
                <li><a href="/topics/entertainment">{!! __('menu.entertainment') !!}</a></li>
                <li><a href="/topics/cook-recipes">{!! __('menu.cook-recipes') !!}</a></li>
                <li class="">
                    <a href="http://127.0.0.1:8000/topics/life">
                        <img src="{!! asset('blog/img/microButton_97x72px.png') !!}"
                             data-src="{!! asset('blog/img/microButton_97x72px.png') !!}"
                             alt="button ads" class="lazyload">
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 main-search-bar">
            <!-- Top Search bar -->
            {!! Form::open(array('route' => 'blog.search', 'role'=>'search', 'method' => 'GET', 'class'=>'navbar-form float-width')) !!}
            <div class="form-group float-width">
                {!! Form::text('q', null, ['class' => 'form-control float-width', 'placeholder' => 'Search for games, music, movies', 'id' => 'name']) !!}
            </div>
            <button><i class="fa fa-search"></i></button>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- Close the Fixed Menu button -->
    <a class="fxd-mnu-x trans1" title="Close" id="hidemenu">
        <span class="fa-stack fa-lg">
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
        </span>
    </a>
</div>
