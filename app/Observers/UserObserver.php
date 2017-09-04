<?php

namespace App\Observers;

use App\Model\User;
use Carbon\Carbon;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->posted_at = Carbon::now();
    }
}
