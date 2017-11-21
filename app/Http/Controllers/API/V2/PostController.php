<?php

namespace App\Http\Controllers\API\V2;

use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{

    /**
     * Return the posts.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function latest()
    {
        return PostResource::collection(
            Post::with('media')
                ->where('active', 1)
                ->latest()->take(config('settings.new_posts_number', '6'))->get()
        );
    }


    /**
     * Return the posts.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function mostRead()
    {
        return PostResource::collection(
            Post::with('media')
                ->where('active', 1)
                ->where('most_read', '>=', config('settings.most_read', 50))
                ->take(config('settings.most_read_posts_number', '6'))->get()
        );
    }

    /**
     * Return the posts.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function related(Request $request)
    {
        return PostResource::collection(
            Post::latest()->paginate($request->input('limit', 6))
        );
    }

}
