<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Post;

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
        $posts = Post::with(['categories', 'comments'])->latest()->get();
        $categories = Category::with('articles')->get();
        return view($this->view . 'index', compact('posts', 'categories'));
    }
}
