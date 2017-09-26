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
use App\Model\Post;
use Torann\LaravelMetaTags\Facades\MetaTag;

class BaseController extends Controller
{

	/**
	 * BaseController constructor.
	 */
	public function __construct()

	{
		MetaTag::set('title', 'Merlplus - Local news in Cambodia');
		MetaTag::set('keywords', 'breaking news, cambodia news, local news, breaking news in cambodia, health, cooking, breaking news, entertainment, technology, life, sport, local news in Cambodia');
		MetaTag::set('description', 'Merlplus - Local news in Cambodia, up-to-date in a minute news, breaking news, feature and audio stories. Merlplus provides the trusted local Cambodia news, also the world wide news, to all original area, and regional perspective ,local news in Cambodia. Entertainments, technologies, cook recipes, science, business news....');
		MetaTag::set('image', asset('images/logo.png'));
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
		$menus = Category::with('images')
			->where('parent_id', null)
			->latest()->take(5)->get();
		view()->share([
			'top_ads'              => $top_ads,
			'top_right_ads'        => $top_right_ads,
			'home_top_news_slider' => $home_top_news_slider,
			'main_right_ads'       => $main_right_ads,
			'menus'                => $menus,
		]);
	}

}