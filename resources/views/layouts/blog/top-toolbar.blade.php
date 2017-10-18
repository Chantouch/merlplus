<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:28 AM
 */
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Toolbar get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-navbar-collapse" id="btn-navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" id="home-nav">
                <img data-src="{!! asset('blog/img/logo.png') !!}" src="{!! asset('blog/img/logo.png') !!}"
                     alt="Merlplus.com" class="lazyload">
            </a>
            <!-- add search form -->
            <div class="search-box">
                <div id="sb-search" class="sb-search">
                    {!! Form::open(array('route' => 'blog.search', 'role'=>'search', 'method' => 'GET')) !!}
                    <label for="search"></label>
                    {!! Form::text('q', null, ['class' => 'sb-search-input', 'placeholder' => __('app.search'), 'id' => 'search']) !!}
                    <input class="sb-search-submit" type="submit" value="">
                    <span class="sb-icon-search"></span>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{!! Request::is('/') ? ' active': '' !!} home">
                    <a href="/"><i class="fa fa-home"></i></a>
                </li>
                @if(isset($menus))
                    @if(count($menus))
                        @foreach($menus as $index => $menu)
                            <li class="{!! isset($post) ? $post->category()->getRouteKey() == $menu->getRouteKey() ? 'active' : '' : Request::segment(2) == $menu->getRouteKey() ? 'active': '' !!}" id="{!! $menu->slug !!}">
                                <a href="{!! route('blog.topics.show',[$menu->getRouteKey()]) !!}">
                                    {!! $menu->name !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>