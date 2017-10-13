<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Advertise;
use App\Model\Category;
use App\Model\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Torann\LaravelMetaTags\Facades\MetaTag;

class CategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public $view = 'blog.category.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $idOrSlug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idOrSlug)
    {
        if (ctype_digit($idOrSlug)) {
            $category = Category::with(['parent', 'articles'])
                ->where('id', $idOrSlug)->firstOrFail();
            $posts = $category->articles()->paginate(config('settings.posts_per_page', '10'));
            if ($request->ajax()) {
                $view = view($this->view . 'data', compact('posts'))->render();
                return response()->json(['html' => $view]);
            }
        } else {
            $category = Category::with(['parent', 'articles'])
                ->where('slug', $idOrSlug)->firstOrFail();
            $posts = $category->articles()->paginate(config('settings.posts_per_page', '10'));
            if ($request->ajax()) {
                $view = view($this->view . 'data', compact('posts'))->render();
                return response()->json(['html' => $view]);
            }
        }
	    $most_read = Post::with('media')
		    ->where('active', 1)
		    ->where('most_read', '>=', config('settings.most_read', 50))
		    ->take(config('settings.most_read_posts_number', '6'))->get();
	    $new_posts = Post::with('media')
		    ->where('active', 1)
		    ->latest()->take(config('settings.new_posts_number', '6'))->get();
        $single_article_ads = Advertise::with('ads_type')
            ->where('advertise_type_id', 9)
            ->where('end_date', '>=', Carbon::now())
            ->get();
	    MetaTag::set('title', $category->name . ' - Merlplus.com');
	    MetaTag::set('keywords', 'merl, plus, merlplus, breaking news, cambodian news, local news, breaking news in cambodia, health, cooking, breaking news, entertainment, technology, life, sport');
	    MetaTag::set('description', !empty($category->description) ? $category->description : config('settings.app_slogan'));
	    MetaTag::set('image', asset($category->hasThumbnail() ? asset('storage/uploads/category/' . $category->thumbnail()->filename) : asset('storage/default/ico/android-icon-192x192.png')));
        return view($this->view . 'show', compact('category', 'posts', 'new_posts', 'most_read', 'single_article_ads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
