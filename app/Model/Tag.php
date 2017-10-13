<?php

namespace App\Model;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use App\Http\Traits\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as image;

class Tag extends Model
{

	use SlugUtf8;
	use Mediable;
	use Sluggable;
	protected $guarded = [];
	protected $fillable = [
		'name', 'slug', 'status', 'menu_thumbnail_id', 'thumbnail_id', 'is_menu'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
	 */
	public function posts()
	{
		return $this->morphedByMany(Post::class, 'taggable')->latest();
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
					'name' => 'required|unique:tags|max:255',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'name' => 'required|unique:tags,name,' . $id . ',id',
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
	 * Retrieve the menu's thumbnail
	 *
	 * @return mixed
	 */
	public function thumbnail()
	{
		return $this->media()->where('id', $this->thumbnail_id)->first();
	}

	/**
	 * Check if the post has a valid menu thumbnail
	 *
	 * @return boolean
	 */
	public function hasMenuThumbnail(): bool
	{
		return $this->hasMedia($this->menu_thumbnail_id);
	}

	/**
	 * Retrieve the menu's thumbnail
	 *
	 * @return mixed
	 */
	public function menuThumbnail()
	{
		return $this->media()->where('id', $this->menu_thumbnail_id)->first();
	}

	/**
	 * Store and set the tag's thumbnail
	 *
	 * @param UploadedFile $thumbnail
	 * @return UploadedFile
	 */
	public function storeAndSetThumbnail(UploadedFile $thumbnail)
	{
		//$thumbnail_name = $thumbnail->store('uploads/posts');
		$avatar = Image::make($thumbnail)->resize(1920, 760);
		$ext = $thumbnail->getClientOriginalExtension();
		$path = storage_path('app/public/uploads/tag/');
		$file_name = str_random(30) . '.' . $ext;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		if (!$this->hasThumbnail()) {
			$media = $this->media()->create([
				'filename'          => $file_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
			$avatar->save($path . $file_name, 100);
			$this->update(['thumbnail_id' => $media->id]);
		} else {
			$name = $this->media()->first()->filename;
			$old_path = [
				'public/uploads/tag/' . $name,
			];
			if (File::exists(storage_path('app/public/uploads/tag'))) {
				Storage::delete($old_path);
			}
			$this->media()->first()->update([
				'filename'          => $file_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
			$avatar->save($path . $file_name, 100);
		}
		return $thumbnail;
	}

	/**
	 * Store and set the tag's thumbnail
	 *
	 * @param UploadedFile $thumbnail
	 * @return UploadedFile
	 */
	public function storeAndSetMenuThumbnail(UploadedFile $thumbnail)
	{
		//$thumbnail_name = $thumbnail->store('uploads/posts');
		$avatar = Image::make($thumbnail)->resize(112, 72);
		$ext = $thumbnail->getClientOriginalExtension();
		$path = storage_path('app/public/uploads/tag/');
		$file_name = str_random(30) . '.' . $ext;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		if (!$this->hasMenuThumbnail()) {
			$media = $this->media()->create([
				'filename'          => $file_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
			$avatar->save($path . $file_name, 100);
			$this->update(['menu_thumbnail_id' => $media->id]);
		} else {
			$name = $this->media()->first()->filename;
			$old_path = [
				'public/uploads/tag/' . $name,
			];
			if (File::exists(storage_path('app/public/uploads/tag'))) {
				Storage::delete($old_path);
			}
			$this->media()->first()->update([
				'filename'          => $file_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
			$avatar->save($path . $file_name, 100);
		}
		return $thumbnail;
	}


    //----------Sluggable---------//

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['seo_url', 'seo_url1']
            ]
        ];
    }

    //-------GetAttributes--------//

    /**
     * @return string
     */
    public function getSeoUrlAttribute()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSeoUrl1Attribute()
    {
        return uniqid();
    }

}
