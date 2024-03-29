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
                @if(isset($menus))
                    @if(count($menus))
                        @foreach($menus as $index => $menu)
                            <li class="{!! isset($post) ? $post->category()->getRouteKey() == $menu->getRouteKey() ? 'active' : '' : Request::segment(2) == $menu->getRouteKey() ? 'active': '' !!}">
                                <a href="{!! route('blog.topics.show',[$menu->getRouteKey()]) !!}">
                                    {!! $menu->name !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endif
                @if(isset($tag_menu))
                    @if(count($tag_menu))
                        @foreach($tag_menu as $index => $menu)
                            <li class="">
                                <a href="{!! route('blog.tag.show',[$menu->getRouteKey()]) !!}">
                                    @if($menu->hasMenuThumbnail())
                                        <img src="{!! asset('storage/uploads/tag/'.$menu->menuThumbnail()->filename) !!}"
                                             data-src="{!! asset('storage/uploads/tag/'.$menu->menuThumbnail()->filename) !!}"
                                             alt="{!! $menu->name !!}" class="lazyload img-responsive">
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
        <div class="col-lg-4 main-search-bar">
            <!-- Top Search bar -->
            {!! Form::open(array('route' => 'blog.search', 'role'=>'search', 'method' => 'GET', 'class'=>'navbar-form float-width')) !!}
            <div class="form-group float-width">
                <label for="name" class="search-label"></label>
                {!! Form::text('q', null, ['class' => 'form-control float-width', 'placeholder' => __('app.search'), 'id' => 'name']) !!}
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
    <a class="fxd-mnu-x trans1" title="Close" id="show_menu">
        <span class="fa-stack fa-lg">
            <i class="fa fa-times fa-stack-1x fa-plus"></i>
        </span>
    </a>
</div>
