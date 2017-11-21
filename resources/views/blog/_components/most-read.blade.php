<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/8/2017
 * Time: 7:05 AM
 */
?>
<div class="panel-heading">
    <h4>{!! __('posts.most_read') !!}</h4>
</div>
<div class="panel-body" v-if="most_read_posts.length > 0">
    <div class="media" v-if="options.isLoading">
        <div class="media-body">
            <h4>Please wait.......</h4>
        </div>
    </div>
    <div class="media" v-for="post in most_read_posts">
        <div class="media-left media-top">
            <div class="zoom-img" v-if="post.has_thumbnail">
                <a :href="post.url" :title="post.title">
                    <img :src="post.thumbnail_url" class="media-object lazyload" width="80" :alt="post.title">
                </a>
            </div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a :href="post.url" :title="post.title">@{{ post.title }}</a>
            </h4>
        </div>
    </div>
</div>