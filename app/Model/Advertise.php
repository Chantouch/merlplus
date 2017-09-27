<?php

namespace App\Model;

use App\Http\Traits\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Advertise extends Model
{
    use Mediable;
    use Sluggable;

    protected $fillable = [
        'slug', 'advertise_type_id', 'provider_name', 'tracking_code_large',
        'tracking_code_tablet', 'tracking_code_mobile', 'active', 'url',
        'start_date', 'end_date', 'media_id', 'is_video','price'
    ];

    //-------Validation-------//

    public static function rule()
    {
        return [
            'advertise_type_id' => 'required',
            'provider_name' => 'required|max:255',
	        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
        ];
    }

    public static function message()
    {
        return [
            'advertise_type_id.required' => 'The advertise type field is required'
        ];
    }

    //-------Relationship--------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ads_type()
    {
        return $this->belongsTo(AdvertiseType::class, 'advertise_type_id');
    }


    /**
     * Check if the post has a valid thumbnail
     *
     * @return boolean
     */
    public function hasBanner(): bool
    {
        return $this->hasMedia($this->media_id);
    }

    /**
     * Retrieve the post's thumbnail
     *
     * @return mixed
     */
    public function banner()
    {
        return $this->media()->where('id', $this->media_id)->first();
    }


    /**
     * Store and set the post's thumbnail
     *
     * @param UploadedFile $media
     * @return UploadedFile
     */
    public function mediaUpload(UploadedFile $media)
    {
        $path = storage_path('app/public/uploads/media/advertises');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($this->hasBanner()) {
            $banner_name = $this->banner()->filename;
            $media_name = $media->store('public/uploads/media/advertises');
            $old_path = [
                'public/uploads/media/advertises/' . $banner_name
            ];
            if (File::exists($path)) {
                Storage::delete($old_path);
            }
            $this->banner()->update([
                'filename' => str_replace('public/uploads/media/advertises/', '', $media_name),
                'original_filename' => $media->getClientOriginalName(),
                'mime_type' => $media->getMimeType()
            ]);
        } else {
            $media_name = $media->store('public/uploads/media/advertises');
            $media = $this->media()->create([
                'filename' => str_replace('public/uploads/media/advertises/', '', $media_name),
                'original_filename' => $media->getClientOriginalName(),
                'mime_type' => $media->getMimeType()
            ]);
            $this->update(['media_id' => $media->id]);
        }
        return $media;
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
                'source' => 'seo_url'
            ]
        ];
    }

    //-------GetAttributes--------//

    /**
     * @return string
     */
    public function getSeoUrlAttribute()
    {
        return $this->provider_name;
    }
}
