<?php

namespace App\Http\Controllers\API\V1;

use App\Model\Comment;
use App\Transformers\CommentTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CommentsRequest;
use App\Model\Post;

class PostCommentsController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->transformer = new CommentTransformer;
        $this->resourceKey = 'comments';
    }

    /**
     * Return the post's comments.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $post = Post::with('comments')->find($id);
        if (!$post) {
            return $this->respondNotFound();
        }

        $comments = $post->comments()->latest()->paginate($request->input('limit', 20));

        return $this->paginatedCollection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(CommentsRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->respondNotFound();
        }
        $comment = Comment::create([
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Model\Post',
            'body' => $request->input('body')
        ]);
        return $this->setStatusCode(201)->item($comment);
    }
}
