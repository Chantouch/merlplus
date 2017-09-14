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
                <li class="active"><a href="/">ទំព័រដើម</a></li>
                @if(isset($menus))
                    @if(count($menus))
                        @foreach($menus as $index => $menu)
                            <li>
                                <a href="{!! route('blog.topics.show',[$menu->getRouteKey()]) !!}">
                                    {!! $menu->name !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
        <div class="col-lg-4 main-search-bar">
            <!-- Top Search bar -->
            <form class="navbar-form float-width" role="search">
                <div class="form-group float-width">
                    <input type="text" class="form-control float-width"
                           placeholder="Search for games, music, movies">
                </div>
                <a href="#" type="submit"><i class="fa fa-search"></i></a>
            </form>
        </div>
    </div>
    <!-- Close the Fixed Menu button -->
    <a class="fxd-mnu-x trans1" title="Close" id="hidemenu">
        <span class="fa-stack fa-lg">
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
        </span>
    </a>
</div>
