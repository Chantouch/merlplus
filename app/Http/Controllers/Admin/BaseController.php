<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 12:34 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Torann\LaravelMetaTags\Facades\MetaTag;

class BaseController extends Controller
{

	/**
	 * BaseController constructor.
	 */
	public function __construct()

	{
		MetaTag::set('title', 'MerlPlus Dashboard | ');
		MetaTag::set('description', 'Blog Wes Anderson bicycle rights, occupy Shoreditch gentrify keffiyeh.');
		MetaTag::set('image', asset('images/default-share-image.png'));
	}

}