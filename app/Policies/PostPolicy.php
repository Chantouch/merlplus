<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
     * Determine whether the user can update the post.
     *
     * @param  User $user
     * @param  Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
