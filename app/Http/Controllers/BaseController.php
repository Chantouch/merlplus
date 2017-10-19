<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 12:34 PM
 */

namespace App\Http\Controllers;


use App\Model\Advertise;
use App\Model\Category;
use App\Model\Page;
use App\Model\Post;
use App\Model\Setting;
use App\Model\Tag;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Torann\LaravelMetaTags\Facades\MetaTag;

class BaseController extends Controller
{

    /**
     * BaseController constructor.
     */
    public function __construct()

    {
        $top_ads = Advertise::with('ads_type')
            ->where('end_date', '>=', Carbon::now())
            ->where('advertise_type_id', 1)->get();
        if ($top_ads->count() > 0) {
            $top_ads = $top_ads->random(1);
        }
        $top_right_ads = Advertise::with('ads_type')
            ->where('end_date', '>=', Carbon::now())
            ->where('advertise_type_id', 3)->get();
        if ($top_right_ads->count() > 1) {
            $top_right_ads = $top_right_ads->random(2);
        }
        $home_top_news_slider = Advertise::with('ads_type')
            ->where('end_date', '>=', Carbon::now())
            ->where('advertise_type_id', 10)->get();
        $main_right_ads = Advertise::with('ads_type')
            ->where('end_date', '>=', Carbon::now())
            ->where('advertise_type_id', 11)->get();
        $menus = Category::with('images')
            ->where('parent_id', null)->take(5)
            ->orderBy('position_order', 'ASC')->get();
        $tag_menu = Tag::with('posts')->where('is_menu', 1)->get();
        $pages = Page::where('status', 1)->orderBy('order', 'ASC')->get();
        $socials = '';
        if (config('settings.social_activated')) {
            $socials = Setting::with('child')
                ->where('key', 'social_activated')
                ->firstOrFail()->child()
                ->where('value', '!=', '')->get();
        }
        MetaTag::set('title', 'Merlplus News');
        MetaTag::set('keywords', 'Merlplus News - ' . config('settings.app_name') . ', breaking news, cambodian news, local news, breaking news in cambodia, health, cooking, breaking news, entertainment, technology, life, sport');
        MetaTag::set('description', config('settings.app_slogan'));
        MetaTag::set('robots', 'index,follow');

        // DNS Prefetch meta tags /============================================================
        $dnsPrefetch = [
            '//fonts.googleapis.com',
            '//graph.facebook.com',
            '//google.com',
            '//apis.google.com',
            '//ajax.googleapis.com',
            '//www.google-analytics.com',
            '//pagead2.googlesyndication.com',
            '//gstatic.com',
            '//cdn.api.twitter.com',
            '//oss.maxcdn.com',
        ];
        $agent = new Agent();
        view()->share([
            'top_ads' => $top_ads,
            'top_right_ads' => $top_right_ads,
            'home_top_news_slider' => $home_top_news_slider,
            'main_right_ads' => $main_right_ads,
            'menus' => $menus,
            'tag_menu' => $tag_menu,
            'pages' => $pages,
            'socials' => $socials,
            'dnsPrefetch' => $dnsPrefetch,
            'agent' => $agent
        ]);
    }

}