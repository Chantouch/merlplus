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
	protected $client;

	/**
	 * BaseController constructor.
	 */
	public function __construct()

	{
		$client = new \Google_Client();
		$guzzleClient = new \GuzzleHttp\Client(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);
		$client->setHttpClient($guzzleClient);
		$this->client = $client;
	}

}