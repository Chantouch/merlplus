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
	    MetaTag::set('title', 'Merlplus is a leading news in Cambodia');
	    MetaTag::set('keywords', 'health, cooking, breaking news, entertainment, technology, life, sport, cambodia');
	    MetaTag::set('description', 'Merlplus proudly is the most visited and popular Khmer website, with more than 20 million page views and almost 2 millions unique visitors per month!');
	    MetaTag::set('image', asset('images/default-share-image.png'));
        $top_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 1)->get();
        if (!$top_ads->isEmpty())
        {
            $top_ads = $top_ads->random(1);
        }
        $top_right_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 3)->get();
        if (!$top_right_ads->isEmpty())
        {
            $top_right_ads = $top_right_ads->random(2);
        }
        $home_top_news_slider = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 10)->get();
        view()->share([
            'top_ads' => $top_ads,
            'top_right_ads' => $top_right_ads,
            'home_top_news_slider' => $home_top_news_slider,
        ]);
    }

}