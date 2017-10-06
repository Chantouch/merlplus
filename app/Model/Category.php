<?php

namespace App\Model;

use App\Http\Traits\Mediable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{

	use Mediable;
    protected $guarded = [];
    protected $fillable = [
        'name', 'slug', 'description', 'status', 'parent_id', 'color_id', 'position_order', 'thumbnail_id'
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


	/**
	 * Check if the post has a valid thumbnail
	 *
	 * @return boolean
	 */
	public function hasThumbnail(): bool
	{
		return $this->hasMedia($this->thumbnail_id);
	}

	/**
	 * Retrieve the post's thumbnail
	 *
	 * @return mixed
	 */
	public function thumbnail()
	{
		return $this->media()->where('id', $this->thumbnail_id)->first();
	}


	/**
	 * Store and set the post's thumbnail
	 *
	 * @param UploadedFile $media
	 * @return UploadedFile
	 */
	public function storeAndSetThumbnail(UploadedFile $media)
	{
		$path = storage_path('app/public/uploads/category');
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		if ($this->hasThumbnail()) {
			$banner_name = $this->thumbnail()->filename;
			$media_name = $media->store('public/uploads/category');
			$old_path = [
				'public/uploads/category/' . $banner_name
			];
			if (File::exists($path)) {
				Storage::delete($old_path);
			}
			$this->thumbnail()->update([
				'filename' => str_replace('public/uploads/category/', '', $media_name),
				'original_filename' => $media->getClientOriginalName(),
				'mime_type' => $media->getMimeType()
			]);
		} else {
			$media_name = $media->store('public/uploads/category');
			$media = $this->media()->create([
				'filename' => str_replace('public/uploads/category/', '', $media_name),
				'original_filename' => $media->getClientOriginalName(),
				'mime_type' => $media->getMimeType()
			]);
			$this->update(['thumbnail_id' => $media->id]);
		}
		return $media;
	}

}
