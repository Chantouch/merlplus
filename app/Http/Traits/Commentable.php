<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 2:29 PM
 */

namespace App\Http\Traits;


use App\Model\Comment;

trait Commentable
{
    /**
     * Check if the resource has a media
     *
     * @param integer $comment_id
     * @return boolean
     */
    public function hasComment($comment_id): bool
    {
        return $this->comments()->where('id', $comment_id)->exists();
    }

    /**
     * Get all of the resource's media.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}