<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 6:37 AM
 */
?>
<!-- One image slider -->
<div class="sm-sldr-box float-width">
    <div class="flexslider sm-sldr">
        <ul class="slides">
            @if(isset($home_top_news_slider))
                @if(count($home_top_news_slider))
                    @foreach($home_top_news_slider->random(1) as $ads)
                        <li>
                            {{--<img alt="{!! $ads->provider_name !!}" src="{!! asset('blog/img/samples/z2.jpg') !!}"/>--}}
                            {{ Html::image($ads->banner()->media_url, $ads->banner()->original_filename) }}
                        </li>
                    @endforeach
                @else
                    <li>
                        <img alt="" src="{!! asset('blog/img/samples/z2.jpg') !!}"/>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
<!-- Social Media Counter -->
<div class="smedia lefty">
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/fb.png') !!}"/>
            <span>6423</span>
        </a>
    </div>
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/tw.png') !!}"/>
            <span>12344</span>
        </a>
    </div>
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/gplus.png') !!}"/>
            <span>1846</span>
        </a>
    </div>
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/drp.png') !!}"/>
            <span>416</span>
        </a>
    </div>
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/flkr.png') !!}"/>
            <span>91</span>
        </a>
    </div>
    <div class="w50 blocky">
        <a href="#">
            <img alt="" class="lefty" src="{!! asset('blog/img/ig.png') !!}"/>
            <span>3487</span>
        </a>
    </div>
</div>
<!-- Trending news right -->
<div class="trending lefty">
    <h3 class="sec-title">TRENDING</h3>
    <div class="trend-1">
        <a href="#"><img alt="" src="{!! asset('blog/img/samples/z3.jpg') !!}"/></a>
        <a class="lefty cat-a cat-label2" href="#">GAMES</a>
        <div class="trend-2">
            <h3><a href="#">Watch Dogs - First gameplay this year</a></h3>
            <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula nec,
                pellentesque nisl. Sed dolor..</p>
            <p class="artcl-time-1">
                <span><i class="fa fa-clock-o"></i>20 Jan 2014</span>
                <span><i class="fa fa-comment-o"></i>21 comments</span>
            </p>
        </div>
    </div>
    <div class="float-width">
        <div class="trend-sm float-width">
            <a href="#"><img alt="" class="lefty" src="{!! asset('blog/img/samples/e2.jpg') !!}"/></a>
            <h4 class="lefty">USA Games Studio will release sandbox new game</h4>
            <a class="lefty cat-a cat-label2" href="#">GAMES</a>
            <p class="righty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span></p>
        </div>
        <div class="trend-sm float-width">
            <a href="#"><img alt="" class="lefty" src="{!! asset('blog/img/samples/e1.jpg') !!}"/></a>
            <h4 class="lefty">After party of Blondi Concert will begin tomorrow</h4>
            <a class="lefty cat-a cat-label4" href="#">MUSIC</a>
            <p class="righty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span></p>
        </div>
        <div class="trend-sm float-width">
            <a href="#"><img alt="" class="lefty" src="{!! asset('blog/img/samples/e3.jpg') !!}"/></a>
            <h4 class="lefty">The best place to see in Winter season this year</h4>
            <a class="lefty cat-a cat-label3" href="#">TOURISM</a>
            <p class="righty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span></p>
        </div>
    </div>
</div>
<!-- Flicker Widget -->
<div class="flkr-cont lefty">
    <h3 class="sec-title">FLICKR WIDGET</h3>
    <div id="basicuse"></div>
</div>
<!-- News letter subscription -->
<div class="subscribe lefty">
    <h3 class="sec-title">NEWSLETTER</h3>
    <h6>Subscribe to our newsletter and be first to know about new game, music and movie releases.</h6>
    <form role="form">
        <div class="form-group">
            <input type="text" class="lefty" placeholder="Enter your email adress and hit enter">
            <a href="#" class="lefty trans1" type="submit">save</a>
        </div>
    </form>
</div>
<!-- Featured Video -->
<div class="ftrd-vd float-width">
    <h3 class="sec-title">FEATURED VIDEO</h3>
    <iframe src="http://player.vimeo.com/video/8170203?color=b3a07d" width="100%" height="300"
            frameborder="0"
            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<!-- Calender Widget -->
<div class="calendar-cont float-width">
    <div id="cal">
        <div class="header float-width">
            <h2 class="month-year lefty w50" id="label">
                <span id="month"> MAR </span> <span id="year"> 2014 </span>
            </h2>
            <h6 class="float-width">this is today's event details!</h6>
        </div>
        <table id="days">
            <tr>
                <td>sun</td>
                <td>mon</td>
                <td>tue</td>
                <td>wed</td>
                <td>thu</td>
                <td>fri</td>
                <td>sat</td>
            </tr>
        </table>
        <div id="cal-frame">
            <table class="curr">
                <tr>
                    <td class="nil"></td>
                    <td class="nil"></td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td class="today">11</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                    <td>16</td>
                    <td>17</td>
                    <td>18</td>
                    <td>19</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>21</td>
                    <td>22</td>
                    <td>23</td>
                    <td>24</td>
                    <td>25</td>
                    <td>26</td>
                </tr>
                <tr>
                    <td>27</td>
                    <td>28</td>
                    <td>29</td>
                    <td>30</td>
                    <td class="nil"></td>
                    <td class="nil"></td>
                    <td class="nil"></td>
                </tr>
            </table>
            <a class="cal-btm-arw trans1 cal-pre">&#59237;</a>
            <a class="cal-btm-arw trans1 cal-nxt">&#59238;</a>
        </div>
    </div>
</div>
<!-- Ad banner right -->
<div class="lefty ad-rt">
    <a href="#"><img alt="" src="{!! asset('blog/img/samples/u1.jpg') !!}"/></a>
</div>
