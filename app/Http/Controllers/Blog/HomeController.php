<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Advertise;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $view = 'blog.';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Cache::remember('news_sliders', 2, function () {
            return Post::with(['categories', 'comments'])
                ->latest()->take(4)->where('active', 1)->get();
        });
        $categories = Cache::remember('categories', 2, function () {
            return Category::with('articles')
                ->orderBy('position_order')
                ->paginate(5);
        });
        $tag = Cache::remember('tag', 2, function () {
            return Tag::with('posts')
                ->where('name', 'វីដេអូឃ្លីប')
                ->orWhere('name', 'វីដេអូ')
                ->orWhere('name', 'Video')
                ->orWhere('name', 'Videos')
                ->first();
        });
        $popup_720x300 = Cache::remember('popup_720x300', 60, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 12)->get();
        });
        $popup_468x60 = Cache::remember('popup_468x60', 60, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 13)->get();
        });
        $popup_234x60 = Cache::remember('popup_234x60', 60, function () {
            return Advertise::with('ads_type')
                ->where('end_date', '>=', Carbon::now())
                ->where('advertise_type_id', 14)->get();
        });
        if ($popup_720x300->count() > 1) {
            $popup_720x300 = $popup_720x300->random(1);
        }
        if ($popup_468x60->count() > 1) {
            $popup_468x60 = $popup_468x60->random(1);
        }
        if ($popup_234x60->count() > 1) {
            $popup_234x60 = $popup_234x60->random(1);
        }
        return view($this->view . 'index', [
            'posts' => $posts,
            'categories' => $categories,
            'tag' => $tag,
            'popup_720x300' => $popup_720x300,
            'popup_468x60' => $popup_468x60,
            'popup_234x60' => $popup_234x60,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function searchArticle(Request $request)
    {
        $searchTerm = $request->get('q');
        $posts = Post::with('categories')->search($searchTerm)->latest()->paginate(10);
        $posts_count = Post::search($searchTerm)->with('categories')->latest()->count();
        $posts->appends(['q' => $searchTerm]);
        Session::flash('_old_input', $request->all());
        if ($request->ajax()) {
            $posts->appends(['q' => $searchTerm]);
            $view = view($this->view . 'category.data', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }
        return view($this->view . 'search.index', compact('posts', 'posts_count'));
    }
}
