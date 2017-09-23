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
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="{!! asset('blog/img/logo.png') !!}"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active home">
                    <a href="/"><i class="fa fa-home"></i></a>
                </li>
                @if(isset($menus))
                    @if(count($menus))
                        @foreach($menus as $index => $menu)
                            <li class="category" id="{!! $menu->slug !!}">
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