<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Category extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'name', 'slug', 'description', 'status', 'parent_id', 'color_id', 'position_order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->whereNotNull('parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     * Get all of the tags for the post.
     */

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //===============Validation===============//
    public static function rules($id = null)
    {
        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|unique:categories|max:255',
                    'file' => 'max:10240'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255|unique:categories,name,' . $id . ',id',
                    'file' => 'mimes:jpg,png|max:10240'
                ];
            }
            default:
                break;
        }
        return self::rules($id);
    }

    public static function messages()
    {
        return [

        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function images()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Post::class, 'post_categories', 'category_id', 'post_id')->withPivot('category_id', 'post_id')->latest()->withTimestamps();
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKey(): string
    {
        if (!empty($this->slug)) {
            return $this->slug;
        }
        return $this->id;
    }
}
