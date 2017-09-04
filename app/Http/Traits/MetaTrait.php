<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/20/2017
 * Time: 5:31 PM
 */

namespace App\Http\Traits;


use App\Model\Meta;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait MetaTrait
{
    /**
     * @param $model
     * @param $meta_title
     * @param $meta_keywords
     * @param $meta_description
     */
    public function createMeta($model, $meta_title, $meta_keywords, $meta_description)
    {
        if (!empty($meta_title)) {
            $meta = new Meta();
            $meta->meta_title = $meta_title;
            $meta->meta_keywords = $meta_keywords;
            $meta->meta_description = $meta_description;
            $save = $model->meta()->save($meta);
            if (!$save) {
                throw new ModelNotFoundException();
            }
        }
    }


}