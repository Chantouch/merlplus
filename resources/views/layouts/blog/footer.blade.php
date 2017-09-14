<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 7:08 AM
 */
?>
<!-- Category footer -->
<div class="cat-ftr-cont float-width">
    @if(isset($menus))
        @if(count($menus))
            @foreach($menus as $index => $menu)
                <div class="cat-ftr-cont-sngl lefty cat-brd-{!! $index+1 !!}">
                    <h3>{!! $menu->name !!}</h3>
                    @if(count($menu->children))
                        <ul>
                            @foreach($menu->childre as $menu)
                                <li><a href="#">{!! $menu->name !!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        @endif
    @endif
</div>
<!-- Info footer -->
<div class="info-ftr float-width">
    <div class="mag-info lefty">
        <a class="ftr-logo" href="#">
            <img alt="Image blog default page" src="{!! asset('blog/img/logo.png') !!}" width="250"/>
        </a>
        <p>
            ​© រក្សា​សិទ្ធិ​គ្រប់​យ៉ាង​ដោយ​ Merlplus ឆ្នាំ​២០១៦ <br>
            អាសយដ្ឋាន
            អគារ​លេខ ៣០៨ មហាវិថីព្រះមុន្នីវង្ស
            សង្កាត់បឹងរាំង ខណ្ឌដូនពេញ
            <a href="#">READ ABOUT US</a>
        </p>
        <div class="scl-ftr float-width">
            <h3>STAY IN TOUCH!</h3>
            <ul>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"
                       class="trans1 fb-ftr"></a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"
                       class="trans1 tw-ftr"></a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"
                       class="trans1 pin-ftr"></a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="YouTube"
                       class="trans1 yt-ftr"></a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"
                       class="trans1 ins-ftr"></a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Vimeo"
                       class="trans1 vm-ftr"></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="post-ftr lefty">
        <h3>About us</h3>
        <p>
            Merlplus ជា​ក្រុមហ៊ុន​ព័ត៌មាន​ឌីជីថល និង​កម្សាន្ត​ឈាន​មុខ​គេ​នៅ​កម្ពុជា។ ព័ត៌មាន​បន្ថែម
        </p>
        <p>
            ផលិត​ផល​ និង​ សេវាកម្ម របស់ Merlplus
        </p>
    </div>
    <div class="twts-ftr lefty">
        <h3>LATEST POSTS</h3>
        @if(isset($latest_posts))
            @if(count($latest_posts))
                @foreach($latest_posts as $latest_post)
                    <div class="pst-ftr-sngl float-width">
                        <a href="#" class="lefty pst-ftr-img">
                            <img alt="{!! $latest_post->title !!}" width="70" height="70"
                                 src="{!! asset(route('media.posts.path',[$latest_post->id,'small_'.$latest_post->thumbnail()->filename])) !!}"/></a>
                        <h5>{!! $latest_post->excerptTitle(25) !!}</h5>
                        <h6 class="lefty">
                            <span>
                                <i class="fa fa-clock-o"></i>{!! $latest_post->posted_at->format('M d,Y') !!}</span>
                            <span>
                                <i class="fa fa-comment-o"></i>{!! $latest_post->comments->count() !!} Comments</span>
                        </h6>
                        <a href="#" class="lefty stars">
                            <img alt="Image blog default page" src="{!! asset('blog/img/4-stars.png') !!}">
                        </a>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>
