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
        @if(config('settings.app_logo'))
            <a class="ftr-logo" href="{!! route('blog.index') !!}">
                <img alt="{!! config('settings.app_name') !!}" src="{!! asset(config('settings.app_logo')) !!}"
                     data-src="{!! asset(config('settings.app_logo')) !!}" width="250" class="lazyload"/>
            </a>
        @endif
        <p>
            ​© រក្សា​សិទ្ធិ​គ្រប់​យ៉ាង​ដោយ​ {!! config('settings.app_name') !!} ឆ្នាំ​២០១៦ <br>
            អាសយដ្ឋាន៖ {!! config('settings.company_address') !!}
        </p>
    </div>
    <div class="post-ftr lefty">
        <h3>{!! __('app.about_us') !!}</h3>
        <hr class="small">
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
            <div class="row">
                @if(config('settings.social_activated'))
                    <div class="col-md-12 m-b-15">
                        <h3>ជួបគ្នានៅបណ្តាញសង្គម</h3>
                        <hr class="small">
                        <ul>
                            @if(count($socials))
                                @foreach($socials as $social)
                                    <li>
                                        <a href="{!! config('settings.'.$social->key) !!}" data-toggle="tooltip"
                                           data-placement="bottom" title="{!! $social->name !!}"
                                           class="trans1 fb-ftr"></a>
                                    </li>
                                @endforeach()
                            @endif
                        </ul>
                    </div>
                @endif
                @if(config('settings.app_phone_number'))
                    <div class="col-md-12 contact">
                        <h3>{!! __('app.contact') !!}</h3>
                        <hr class="small">
                        <p>
                            {{ Html::mailto(config('settings.app_email')) }}
                        </p>
                        <p>{!! config('settings.app_phone_number') !!}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
