<?php

namespace App\Http\Controllers\API\V1;

use App\Model\Tag;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\User;

class ArticlesController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->transformer = new PostTransformer;
        $this->resourceKey = 'posts';
    }

    /**
     * Return the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::withCount('comments')->latest()->get();
        $posts = Tag::with('posts')
            ->where('name', 'វីដេអូឃ្លីប')
            ->orWhere('name', 'វីដេអូ')
            ->orWhere('name', 'Video')
            ->orWhere('name', 'Videos')
            ->first()->posts()->with('media', 'thumb','tags')->latest()
            ->take(9)->get();
        return response()->json([
            'posts' => $posts
        ]);
    }

    /**
     * Return the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::withCount('comments')->find($id);

        if (!$post) {
            return $this->respondNotFound();
        }

        return $this->item($post);
    }
}
