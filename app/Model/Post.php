<?php

namespace App\Model;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use App\Http\Traits\Commentable;
use App\Http\Traits\Mediable;
use App\Http\Traits\Metable;
use App\Scopes\PostedScope;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Post extends Model
{
    use Mediable;
    use Commentable;
    use SlugUtf8;
    use Metable;
    use Sluggable;
    protected $guarded = [];
    protected $dates = ['posted_at'];
    protected $fillable = [
        'title', 'description', 'slug', 'user_id', 'active', 'path', 'source_title',
        'thumbnail_id', 'posted_at', 'meta_id', 'most_read', 'contributor', 'origin_source'
    ];

    //-----------Relationship--------------//

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id')->withPivot('post_id', 'category_id')->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function images()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    /**
     * Check if the post has a valid meta
     *
     * @return boolean
     */
    public function hasMetaTag(): bool
    {
        return $this->hasMeta($this->meta_id);
    }

    /**
     * Retrieve the post's meta
     *
     * @return mixed
     */
    public function metaTag()
    {
        return $this->meta()->where('id', $this->meta_id)->first();
    }


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PostedScope);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        if (request()->expectsJson()) {
            return 'id';
        }
        return 'slug';
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyValue(): string
    {
        if (!empty($this->slug)) {
            return 'slug';
        }
        return 'id';
    }

    /**
     * @param $post
     * @return mixed
     */
    public function getRouteExist($post)
    {
        if (empty($post->slug)) {
            return $post->id;
        } else {
            return $post->slug;
        }
    }

    /**
     * Scope a query to order posts by latest posted
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('posted_at', 'desc');
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
        return $query->whereBetween('posted_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->latest()
            ->limit($limit);
    }

    /**
     * Scope a query to only include posts posted last week.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastWeek($query)
    {
        return $query->whereBetween('posted_at', [Carbon::now()->subWeek(), Carbon::now()])
            ->latest();
    }

    /**
     * Scope a query to only include posts posted count all.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return int
     */
    public function scopeTotalActive($query)
    {
        return $query->where('active', 1)->count();
    }

    /**
     * Scope a query to only include posts posted yearly.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|int
     */
    public function scopeYearlyPost($query)
    {
        return $query->selectRaw('year(created_at)')->groupBy('year(created_at)')->orderByDesc('year(created_at)');
    }

    /**
     * Scope a query to only include posts posted a month daily.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|int
     */
    public function scopeMonthDailyPost($query)
    {
        return $query->selectRaw('DATE(created_at) AS date')
            ->selectRaw('COUNT(id) AS count')
            ->selectRaw('Count(CASE WHEN active = 1 THEN id END) AS CountActive')
            ->selectRaw('Count(CASE WHEN active = 2 THEN id END) AS CountInActive')
            ->selectRaw('Count(CASE WHEN active = 3 THEN id END) AS CountDraft')
            //->where('active', 1)
            //->whereBetween('created_at', [Carbon::now()->subDays(7)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
            ->where(DB::raw('DATE(created_at)'), '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->where(DB::raw('DATE(created_at)'), '<=', Carbon::now()->format('Y-m-d'))
            ->groupBy('date')
            ->orderBy('date', 'ASC');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|int
     * @param $searchTerm
     * @return mixed
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query
            ->where('title', 'like', "%" . $searchTerm . "%")
            ->orWhere('description', 'like', "%" . $searchTerm . "%")
            ->orWhere('slug', 'like', "%" . $searchTerm . "%");
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
        return $this->media->where('id', $this->thumbnail_id)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thumb()
    {
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }

    /**
     * Store and set the post's thumbnail
     *
     * @param UploadedFile $thumbnail
     * @param Post $post
     * @return UploadedFile
     */
    public function storeAndSetThumbnail(UploadedFile $thumbnail, Post $post)
    {
        //$thumbnail_name = $thumbnail->store('uploads/posts');
        $image_large = Image::make($thumbnail)->fit(1200, 700);
        $image_medium = Image::make($thumbnail)->fit(435, 250);
        $image_small = Image::make($thumbnail)->fit(140, 90);
        $ext = $thumbnail->getClientOriginalExtension();
        $path = storage_path('app/public/uploads/posts/' . $post->id . '/');
        $file_name = str_random(50) . '.' . $ext;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if (!$this->hasThumbnail()) {
            $media = $this->media()->create([
                'filename' => $file_name,
                'original_filename' => $thumbnail->getClientOriginalName(),
                'mime_type' => $thumbnail->getMimeType()
            ]);
            $image_large->save($path . 'large_' . $file_name, 100);
            $image_medium->save($path . 'medium_' . $file_name, 70);
            $image_small->save($path . 'small_' . $file_name, 70);
            $this->update(['thumbnail_id' => $media->id]);
        } else {
            $name = $this->media->first()->filename;
            $old_path = [
                'public/uploads/posts/' . $post->id . '/' . 'large_' . $name,
                'public/uploads/posts/' . $post->id . '/' . 'medium_' . $name,
                'public/uploads/posts/' . $post->id . '/' . 'small_' . $name
            ];
            if (File::exists(storage_path('app/public/uploads/posts'))) {
                Storage::delete($old_path);
            }
            $this->media->first()->update([
                'filename' => $file_name,
                'original_filename' => $thumbnail->getClientOriginalName(),
                'mime_type' => $thumbnail->getMimeType()
            ]);
            $image_large->save($path . 'large_' . $file_name, 100);
            $image_medium->save($path . 'medium_' . $file_name, 70);
            $image_small->save($path . 'small_' . $file_name, 70);
        }
        return $thumbnail;
    }


    public function storeAndSetAuthor()
    {
        if (empty($this->user_id)) {
            $this->user_id = auth()->id();
        }
    }

    /**
     * Return the post's author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the post's author
     */
    public function checkAuthor()
    {
        if ($this->author()) {
            return $this->author->name;
        }
        return 'N/A';
    }

    /**
     * Return the post's comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany

    public function comments()
     * {
     * return $this->morphMany(Comment::class, 'commentable');
     * }
     * */


    /**
     * Retrieve the post's comments
     *
     * @return mixed
     */
    public function comment()
    {
        return $this->comments()->whereIn('commentable_id', $this->id)->first();
    }

    /**
     * return the excerpt of the post content
     *
     * @param int $length
     * @return string
     */
    public function excerpt($length = 600): string
    {
        return str_limit(strip_tags($this->description), $length);
    }


    /**
     * return the excerpt of the post content
     *
     * @param int $length
     * @param int $length_unicode
     * @return string
     */
    public function excerptTitle($length = 30, $length_unicode = 50): string
    {
        if (strlen($this->title) != strlen(utf8_decode($this->title))) {
            return str_limit(strip_tags($this->title), $length_unicode);
        }
        return str_limit(strip_tags($this->title), $length);
    }

    /**
     * @param $meta_title
     * @param $meta_keywords
     * @param $meta_description
     */
    public function setAndStoreMetaTag($meta_title, $meta_keywords, $meta_description)
    {
        if (!empty($meta_title)) {
            $meta = $this->meta()->create([
                'meta_title' => $this->substrwords(strip_tags($meta_title), 70),
                'meta_keywords' => $this->substrwords(strip_tags($meta_keywords), 150),
                'meta_description' => $this->substrwords(strip_tags($meta_description), 200)
            ]);
            $this->update(['meta_id' => $meta->id]);
        }
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
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSeoUrl1Attribute()
    {
        return uniqid();
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->categories()->first();
    }

    /**
     * @param $char
     * @return mixed
     */
    public function removeSpecialChar($char)
    {
        $string = str_replace(array("'", "\"", "&quot;", "(", ")"), "", htmlspecialchars($char));
        return $string;
    }
}
