<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'roles'
    ];

    /**
     * Transform an user.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'posted_at' => $user->posted_at->toIso8601String(),
            'comments_count' => $user->comments_count ?? $user->comments()->count(),
            'posts_count' => $user->posts_count ?? $user->posts()->count()
        ];
    }

    /**
     * Include Roles
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRoles(User $user)
    {
        $roles = $user->roles;

        return $this->collection($roles, new RoleTransformer, 'roles');
    }
}
