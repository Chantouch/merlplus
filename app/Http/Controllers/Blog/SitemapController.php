<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Post;

class SitemapController extends BaseController
{
    public function index()
    {
	    $categories = Category::all();
        return response()->view('sitemap.index', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/html');
    }

    public function posts()
    {
        $posts = Post::with('categories')->get();
        return response()->view('sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

}
