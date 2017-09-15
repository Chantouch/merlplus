<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:28 AM
 */
?>
<header class="header">
    <a href="#" class="header__icon" id="header__icon"></a>
    <a href="#" class="header__logo">
        <img alt="Image blog default page" src="{!! asset('blog/img/logo.png') !!}" width="270"/>
    </a>
    <nav class="menu">
        <a href="/">ទំព័រដើម</a>
        @if(isset($menus))
            @if(count($menus))
                @foreach($menus as $index => $menu)
                    <a href="{!! route('blog.topics.show',[$menu->getRouteKey()]) !!}">
                        {!! $menu->name !!}
                    </a>
                @endforeach
            @endif
        @endif
    </nav>
</header>
<div class="site-cache" id="site-cache"></div>
