<?php

namespace App\Model;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Tag extends Model
{

    use SlugUtf8;
	protected $guarded = [];
	protected $fillable = ['name', 'slug', 'status'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
	 */
	public function posts()
	{
		return $this->morphedByMany(Post::class, 'taggable');
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
}
