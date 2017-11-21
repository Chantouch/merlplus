<?php
/**
 * Created by IntelliJ IDEA.
 * User: ChantouchSek
 * Date: 11/21/2017
 * Time: 12:36 PM
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'posted_at' => $this->posted_at->toIso8601String(),
            'author_id' => $this->user_id,
            'has_thumbnail' => $this->hasThumbnail(),
            'thumbnail_url' => optional($this->thumbnail())->url,
            'url' => route('blog.article.show', [$this->slug])
        ];
    }
}