<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaLibrary extends Model
{
	protected $appends = ['limit_name', 'uploaded_at'];
	protected $fillable = [
		'filename',
		'original_filename',
		'mime_type',
		'url',
		'title',
		'caption',
		'alt_text',
		'description',
		'size',
		'width',
		'height'
	];

	/**
	 * Store and set the post's thumbnail
	 *
	 * @param UploadedFile $uploadedFile
	 *
	 * @return UploadedFile
	 */
	public function storeMediaLibrary(UploadedFile $uploadedFile)
	{
		$media_base_name = $uploadedFile->store('public/uploads/media/library');
		$media_library_name = str_replace('public/uploads/media/library/', '', $media_base_name);
		$this->create([
			'filename'          => $media_library_name,
			'original_filename' => $uploadedFile->getClientOriginalName(),
			'mime_type'         => $uploadedFile->getMimeType(),
			'title'             => $uploadedFile->getClientOriginalName(),
			'alt_text'          => $media_library_name,
			'url'               => "/admin/media-library/$media_library_name"
		]);
		return $uploadedFile;
	}

	/**
	 * Store and set the media library
	 *
	 * @param $filename
	 * @param $mimetype
	 * @param $originalname
	 * @param $clientname
	 * @return $this
	 */
	public function storeMediaLibraryByPost($filename, $mimetype, $originalname = null, $clientname = null)
	{
		$this->create([
			'filename'          => $filename,
			'original_filename' => $originalname,
			'mime_type'         => $mimetype,
			'title'             => $clientname,
			'alt_text'          => $filename,
			'url'               => "/admin/media-library/$filename"
		]);
		return $this;
	}

	/**
	 * Get the media's url.
	 *
	 * @return string
	 */
	public function getMediaUrlAttribute(): string
	{
		return route('blog.media', ['filename' => $this->filename]);
	}

	/**
	 * Get the media's storage path.
	 *
	 * @return string
	 */
	public function getPath(): string
	{
		return storage_path('app/') . $this->filename;
	}


	/**
	 * Scope a query to order posts by latest posted
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLatest($query)
	{
		return $query->orderBy('created_at', 'desc');
	}

	/**
	 * Scope a query to only include posts posted last month.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param int $limit
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLastMonth($query, $limit = 5)
	{
		return $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->latest()->limit($limit);
	}

	/**
	 * Scope a query to only include posts posted last week.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLastWeek($query)
	{
		return $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->latest();
	}

	/**
	 * @return string
	 */
	public function getLimitNameAttribute()
	{
		return $this->attributes['filename'] = str_limit($this->attributes['filename'], 20);
	}

	/**
	 * @return string
	 */
	public function getUploadedAtAttribute()
	{
		return $this->attributes['created_at'] = Carbon::parse($this->attributes['created_at'])->format('M, d, Y H:s:i');
	}
}
