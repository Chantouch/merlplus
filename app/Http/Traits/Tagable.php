<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/2/2017
 * Time: 4:58 PM
 */

namespace App\Http\Traits;

use App\Model\Taggable;

trait Tagable {

    /**
     * Check if the resource has a meta
     *
     * @param integer $tag_id
     * @return boolean
     */
    public function hasTag($tag_id): bool
    {
        return $this->tag()->where('id', $tag_id)->exists();
    }

    /**
     * Get all of the resource's meta.
     */
    public function tag()
    {
        return $this->morphMany(Taggable::class, 'taggable');
    }

}