<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;

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
     * @param  int $idOrSlug
     * @return \Illuminate\Http\Response
     */
    public function show($idOrSlug)
    {
        if (ctype_digit($idOrSlug)) {
            $category = Category::with(['parent', 'articles'])
                ->where('id', $idOrSlug)->firstOrFail();
        } else {
            $category = Category::with(['parent', 'articles'])
                ->where('slug', $idOrSlug)->firstOrFail();
        }
        $posts = Post::with('categories')->get()->random(4);
        return view($this->view . 'show', compact('category', 'posts'));
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
