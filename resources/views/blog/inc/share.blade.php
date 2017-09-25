<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/25/2017
 * Time: 1:02 PM
 */
?>
<div class="righty artcl-shr">
    <ul>
        <li>
            <div class="fb-share-button"
                 data-href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}"
                 data-width="100" data-type="button">
            </div>
        </li>
        <li>
            <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
        </li>
        <li>
            <a href="http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&amp;media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&amp;description=Next%20stop%3A%20Pinterest"
               data-pin-do="buttonPin" data-pin-config="none">
                <img alt="Pin share"
                     src="https://assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/>
            </a>
        </li>
    </ul>
</div>
