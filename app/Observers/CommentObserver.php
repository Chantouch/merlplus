<?php

namespace App\Observers;

use App\Model\Comment;
use Carbon\Carbon;

class CommentObserver
{
    /**
     * Listen to the Comment creating event.
     *
     * @param  Comment $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->posted_at = Carbon::now();
    }
}
