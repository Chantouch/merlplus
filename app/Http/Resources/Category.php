<?php
/**
 * Created by IntelliJ IDEA.
 * User: ChantouchSek
 * Date: 11/21/2017
 * Time: 12:36 PM
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class Category extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent' => $this->parent_id,
            'color' => $this->color_id,
            'sort_by' => $this->position_order,
            'has_thumbnail' => $this->hasThumbnail(),
            'thumbnail_url' => asset('storage/uploads/category/' . $this->thumbnail()->filename),
            'url' => route('blog.topics.show', [$this->slug]),
            'posts' => $this->articles()->get()
        ];
    }
}