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
	    MetaTag::set('title', 'You are at home');
	    MetaTag::set('description', 'Blog Wes Anderson bicycle rights, occupy Shoreditch gentrify keffiyeh.');
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