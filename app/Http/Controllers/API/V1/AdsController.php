<?php

namespace App\Http\Controllers\API\V1;

use App\Transformers\AdsTransformer;
use Illuminate\Http\Request;
use App\Model\Post;

class AdsController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->transformer = new AdsTransformer();
        $this->resourceKey = 'ads';
    }

    /**
    * Return the posts.
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $posts = Post::withCount('comments')->latest()->paginate($request->input('limit', 20));

        return $this->paginatedCollection($posts);
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

        if (! $post) {
            return $this->respondNotFound();
        }

        return $this->item($post);
    }
}
