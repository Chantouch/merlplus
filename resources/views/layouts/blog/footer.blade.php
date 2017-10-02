<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/22/2017
 * Time: 7:08 AM
 */
?>
<!-- Info footer -->
<div class="info-ftr float-width">
    <div class="mag-info lefty">
        <a class="ftr-logo" href="#">
            <img alt="Image blog default page" data-src="{!! asset('blog/img/logo.png') !!}" width="250"
                 class="lazyload"/>
        </a>
        <p>
            ​© រក្សា​សិទ្ធិ​គ្រប់​យ៉ាង​ដោយ​ {!! config('settings.app_name') !!} ឆ្នាំ​២០១៦ <br>
            អាសយដ្ឋាន៖ {!! config('settings.company_address') !!}
        </p>
    </div>
    <div class="post-ftr lefty">
        <h3>{!! __('app.about_us') !!}</h3>
        @if(config('settings.about_company'))
            <p>
                {!! config('settings.about_company') !!}
            </p>
        @endif
        <p>
            ផលិត​ផល​ និង​ សេវាកម្ម របស់ {!! config('settings.app_name') !!}
        </p>
    </div>
    <div class="twts-ftr lefty">
        <div class="scl-ftr float-width">
            @if(config('settings.social_activated'))
                <div class="row">
                    <div class="col-md-12 m-b-15">
                        <h3>ជួបគ្នានៅបណ្តាញសង្គម</h3>
                        <ul>
                            @if(config('settings.facebook_page_url'))
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"
                                       class="trans1 fb-ftr"></a>
                                </li>
                            @endif
                            @if(config('settings.twitter_url'))
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"
                                       class="trans1 tw-ftr"></a>
                                </li>
                            @endif
                            @if(config('settings.pinterest_url'))
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"
                                       class="trans1 pin-ftr"></a>
                                </li>
                            @endif
                        </ul>
                        @endif
                    </div>
                    <div class="col-md-12 contact">
                        @if(config('settings.app_phone_number'))
                            <h3>{!! __('app.contact') !!}</h3>
                            <p>
                                {{ Html::obfuscate(config('settings.app_email')) }}
                            </p>
                            <p>{!! config('settings.app_phone_number') !!}</p>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>
