<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Support\Facades\Cache;

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
        $news_sliders = Post::with(['categories', 'comments'])
            ->latest()->take(4)->get();
        $categories = Category::with('articles')->get();
        $posts = [
            'news_sliders' => $news_sliders,
        ];
        return view($this->view . 'index', compact('posts', 'categories'));
    }
}
