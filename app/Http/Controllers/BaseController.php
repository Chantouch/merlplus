<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 12:34 PM
 */

namespace App\Http\Controllers;


use App\Model\Advertise;
use Torann\LaravelMetaTags\Facades\MetaTag;

class BaseController extends Controller
{

    /**
     * BaseController constructor.
     */
    public function __construct()

    {
        MetaTag::set('title', 'Hot news, Local News, Fastest News, Reliable News, Valuables News, Health, Sport, Technology, in Cambodia : Merlplus.com');
        MetaTag::set('keywords', 'health, cooking, breaking news, entertainment, technology, life, sport, in local area of Cambodia');
        MetaTag::set('description', 'Merlplus, searchable fastest news, up-to-date in a minute news, breaking news, feature and audio stories. Merlplus provides the trusted local Cambodia news, also the world wide news, to all original area, and regional perspective. Entertainments, technologies, cook recipes, science, business news....');
        MetaTag::set('image', asset('images/default-share-image.png'));
        $top_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 1)->get();
        if (!$top_ads->isEmpty()) {
            $top_ads = $top_ads->random(1);
        }
        $top_right_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 3)->get();
        if (!$top_right_ads->isEmpty()) {
            $top_right_ads = $top_right_ads->random(2);
        }
        $home_top_news_slider = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 10)->get();
        $main_right_ads = Advertise::with(['ads_type'])
            ->where('advertise_type_id', 11)->get();
        view()->share([
            'top_ads' => $top_ads,
            'top_right_ads' => $top_right_ads,
            'home_top_news_slider' => $home_top_news_slider,
            'main_right_ads' => $main_right_ads,
        ]);
    }

}