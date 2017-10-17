<?php

namespace App\Exceptions;

use App\Model\Advertise;
use App\Model\Category;
use App\Model\Page;
use App\Model\Setting;
use App\Model\Tag;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Torann\LaravelMetaTags\Facades\MetaTag;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		\Illuminate\Auth\AuthenticationException::class,
		\Illuminate\Auth\Access\AuthorizationException::class,
		\Symfony\Component\HttpKernel\Exception\HttpException::class,
		\Illuminate\Database\Eloquent\ModelNotFoundException::class,
		\Illuminate\Session\TokenMismatchException::class,
		\Illuminate\Validation\ValidationException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $exception
	 * @return void
	 */
	public function report(Exception $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $exception
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function render($request, Exception $exception)
	{
        if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Not Found'], 404);
            }
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
            MetaTag::set('keywords', 'merl, plus, merlplus, breaking news, cambodian news, local news, breaking news in cambodia, health, cooking, breaking news, entertainment, technology, life, sport');
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
            return response()->view('errors.index', [], 404);
        }
        return parent::render($request, $exception);
	}

	/**
	 * Convert an authentication exception into an unauthenticated response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Illuminate\Auth\AuthenticationException $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception)
	{
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}

		return redirect()->guest(route('login'));
	}
}
