<?php

namespace App\Http\Traits;

use App\Model\Media;
use App\Model\Meta;

trait Metable
{

    /**
     * Check if the resource has a meta
     *
     * @param integer $meta_id
     * @return boolean
     */
    public function hasMeta($meta_id): bool
    {
        return $this->meta()->where('id', $meta_id)->exists();
    }

    /**
     * Get all of the resource's meta.
     */
    public function meta()
    {
        return $this->morphMany(Meta::class, 'metable');
    }
}
