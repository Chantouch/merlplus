<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:31 AM
 */
?>
@if(isset($posts['breaking_news']))
    <div class="float-width ticker">
        <h3 class="cat-label1">BREAKING NEWS</h3>
        <ul class="newsticker">
            @foreach($posts['breaking_news'] as $index => $breaking_new)
                <li>
                    <h4>
                        <a href="{!! route('blog.article.show', [$breaking_new->getRouteKey()]) !!}"
                           title="{!! $breaking_new->title !!}">{!! $breaking_new->title !!}</a>
                    </h4>
                </li>
            @endforeach
        </ul>
        <div class="ticker-ctrls">
            <a id="tkr-prev">&#59237;</a>
            <a id="tkr-nxt">&#59238;</a>
        </div>
    </div>
@endif
