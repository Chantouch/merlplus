<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

	/**
	 * Determine whether the user is admin for all authorization.
	 * @param User $user
	 * @return bool
	 */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Comment  $comment
     * @return boolean
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->author_id;
    }
}
