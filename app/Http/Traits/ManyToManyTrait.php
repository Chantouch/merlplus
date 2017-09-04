<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/20/2017
 * Time: 2:43 PM
 */

namespace App\Http\Traits;

trait ManyToManyTrait
{
    /**
     * @param $related
     * @param $attribute
     */
    public function attachRelation($related, $attribute)
    {
        if (!empty($attribute)) {
            $related->attach($attribute);
        }
    }

    /**
     * @param $related
     * @param $attribute
     */
    public function syncRelation($related, $attribute)
    {
        if (!empty($attribute)) {
            $related->sync($attribute);
        } else {
            $related->sync(array());
        }
    }
}