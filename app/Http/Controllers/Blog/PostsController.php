<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Model\Advertise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Model\Post;
use Torann\LaravelMetaTags\Facades\MetaTag;

class PostsController extends BaseController
{
    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $view = 'blog.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with([
            'posts' => Post::with('author')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the rss feed of posts.
     *
     * @return Response
     */
    public function feed()
    {
        $posts = Cache::remember('feed-posts', 60, function () {
            return Post::latest()->limit(20)->get();
        });

        return response()->view('posts.feed', [
            'posts' => $posts
        ], 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Display the specified resource.
     * @param $idOrSlug
     * @return $this
     */
    public function show($idOrSlug)
    {
        $post = Post::with(['comments', 'categories.articles', 'tags'])
            ->where('slug', $idOrSlug)->firstOrFail();
        $post->increment('most_read');
        $comments = $post->comments()->with('author')->latest()->paginate(50);
        $previousPost = Post::with('comments')
            ->where('id', '<', $post->id)
            ->select('slug', 'title', 'id')
            ->orderby('slug', 'desc')->first();
        $nextPost = Post::with('comments')
            ->where('id', '>', $post->id)
            ->select('slug', 'title', 'id')
            ->orderby('slug', 'desc')->first();
        //---------Set meta tag to header----------//
        MetaTag::set('title', $post->title);
        MetaTag::set('description', strip_tags($post->description));
        MetaTag::set('image', asset($post->hasThumbnail() ? route('media.posts.path', [$post->id, 'feature_' . $post->thumbnail()->filename]) : ''));
        $single_article_ads = Cache::remember('single_article_ads', 2, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 9)->get();
        });
        $button_single_ads = Cache::remember('button_single_ads', 2, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 5)->get();
        });
        $top_single_ads = Cache::remember('top_single_ads', 2, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 12)->get();
        });
        if ($single_article_ads->count() > 1) {
            $single_article_ads = $single_article_ads->random(1);
        }
        if ($button_single_ads->count() > 1) {
            $button_single_ads = $button_single_ads->random(1);
        }
        if ($top_single_ads->count() > 1) {
            $top_single_ads = $top_single_ads->random(1);
        }
        return view($this->view . 'show', compact(
            'post', 'comments', 'previousPost', 'nextPost', 'single_article_ads',
            'button_single_ads', 'top_single_ads'
        ));
    }
}
