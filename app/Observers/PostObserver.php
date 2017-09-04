<?php

namespace App\Observers;

use App\Model\Post;
use Carbon\Carbon;

class PostObserver
{
    /**
     * Listen to the Post creating event.
     *
     * @param  Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->posted_at = Carbon::now();
        $storage_path = storage_path("app/public/uploads/media/library/");
        if (!file_exists($storage_path)) {
            mkdir($storage_path, 0777, true);
        }
    }

    /**
     * Listen to the Post saving event.
     *
     * @param  Post $post
     * @return void
     */
    public function saving(Post $post)
    {
        $post->slug = $post->slug_utf8($post->title);
    }
}
