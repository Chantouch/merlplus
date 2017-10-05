<?php

namespace App\Model;

use App\Http\Traits\Mediable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Intervention\Image\ImageManagerStatic as Image;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LaratrustUserTrait, SoftDeletes, Mediable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'thumbnail_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return a unique personnal access token.
     *
     * @var String
     * @return string
     */
    public static function generateApiToken(): string
    {
        do {
            $api_token = str_random(60);
        } while (self::where('api_token', $api_token)->exists());

        return $api_token;
    }

    /**
     * Scope a query to only include users registered last week.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastWeek($query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])
            ->latest();
    }

    /**
     * Scope a query to order users by latest registered.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to filter available author users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthors($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('roles.name', Role::ROLE_SUPER_ADMIN)
                ->orWhere('roles.name', Role::ROLE_EDITOR);
        });
    }

    /**
     * Check if the user can be an author
     *
     * @return boolean
     */
    public function canBeAuthor(): bool
    {
        return $this->isAdmin() || $this->isEditor();
    }

    /**
     * Check if the user has a role
     *
     * @return boolean
     */
    public function checkHasRole(): bool
    {
        return $this->roles->isNotEmpty();
    }

//    /**
//     * Check if the user has a role
//     *
//     * @param string $role
//     * @return boolean
//     */
//    public function hasRole($role): bool
//    {
//        return $this->roles->where('name', $role)->isNotEmpty();
//    }

    /**
     * Check if the user has role admin
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ROLE_SUPER_ADMIN);
    }

	/**
	 * @return bool
	 */
	public function getIsAdminAttribute()
	{
		return true;
	}

    /**
     * Check if the user has role editor
     *
     * @return boolean
     */
    public function isEditor(): bool
    {
        return $this->hasRole(Role::ROLE_EDITOR);
    }


    /**
     * Return the user's comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Return the user's posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function mediasLibrary()
	{
		return $this->hasMany(MediaLibrary::class);
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function thumb()
	{
		return $this->belongsTo(Media::class, 'thumbnail_id');
	}

	/**
	 * Store and set the user's thumbnail
	 *
	 * @param UploadedFile $thumbnail
	 * @return UploadedFile
	 */
	public function storeAndSetThumbnail(UploadedFile $thumbnail)
	{
		//$thumbnail_name = $thumbnail->store('uploads/posts');
		$avatar = Image::make($thumbnail)->resize(128, 128);
		$ext = $thumbnail->getClientOriginalExtension();
		$path = storage_path('app/public/uploads/user/');
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
				'public/uploads/user/' . $name,
			];
			if (File::exists(storage_path('app/public/uploads/user'))) {
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

}
