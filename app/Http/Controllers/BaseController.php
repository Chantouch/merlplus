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
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Torann\LaravelMetaTags\Facades\MetaTag;

class BaseController extends Controller
{

    /**
     * BaseController constructor.
     */
    public function __construct()

    {
        $top_ads = Cache::remember('top_ads', 10, function () {
            return Advertise::with('ads_type')
                ->where('active', 1)
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 1)->get();
        });
        if ($top_ads->count() > 0) {
            $top_ads = $top_ads->random(1);
        }
        $top_right_ads = Cache::remember('top_right_ads', 10, function () {
            return Advertise::with('ads_type')
                ->where('active', 1)
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 3)->get();
        });
        if ($top_right_ads->count() > 1) {
            $top_right_ads = $top_right_ads->random(2);
        }
        $home_top_news_slider = Cache::remember('home_top_news_slider', 10, function () {
            return Advertise::with('ads_type')
                ->where('active', 1)
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 10)->get();
        });
        $main_right_ads = Cache::remember('main_right_ads', 10, function () {
            return Advertise::with('ads_type')
                ->where('active', 1)
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 11)->get();
        });
        $menus = Cache::remember('menus', 24 * 60, function () {
            return Category::with('images')
                ->where('status', 1)
                ->where('parent_id', null)->take(5)
                ->orderBy('position_order', 'ASC')->get();
        });
        $tag_menu = Cache::remember('tag_menu', 10, function () {
            return Tag::with('posts')
                ->where('status', 1)
                ->where('is_menu', 1)->get();
        });
        $pages = Cache::remember('pages', 60, function () {
            return Page::where('status', 1)->orderBy('order', 'ASC')->get();
        });
        if (config('settings.social_activated')) {
            $socials = Cache::remember('socials', 24*60, function () {
                return Setting::with('child')
                    ->where('key', 'social_activated')
                    ->firstOrFail()->child()
                    ->where('value', '!=', '')->get();
            });
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