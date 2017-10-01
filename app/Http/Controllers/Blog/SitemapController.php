<?php

namespace App\Http\Controllers\Blog;

use App\Model\Category;
use App\Model\Post;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        $post = Post::with('categories')
            ->where('active', 1)
            ->orderBy('updated_at', 'desc')->first();
        return response()->view('sitemap.index', [
            'post' => $post,
        ])->header('Content-Type', 'text/xml');
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
