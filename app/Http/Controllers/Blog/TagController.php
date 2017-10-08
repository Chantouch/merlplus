<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Advertise;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public $view = 'blog.tag.';

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
     * @param  int $idOrSlug
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($idOrSlug, Request $request)
    {

        if (ctype_digit($idOrSlug)) {
            $category = Tag::with('posts')
                ->where('id', $idOrSlug)->firstOrFail();
            $posts = $category->posts()->paginate(config('settings.posts_per_page', '12'));
            if ($request->ajax()) {
                $view = view($this->view . 'data', compact('posts'))->render();
                return response()->json(['html' => $view]);
            }
        } else {
            $category = Tag::with('posts')
                ->where('slug', $idOrSlug)->firstOrFail();
            $posts = $category->posts()->paginate(config('settings.posts_per_page', '12'));
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
            ->where('advertise_type_id', 9)->get();
        return view($this->view . 'show', compact('category', 'posts', 'most_read', 'new_posts', 'single_article_ads'));
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
