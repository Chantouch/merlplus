<?php

namespace App\Transformers;

use App\Model\MediaLibrary;
use League\Fractal\TransformerAbstract;

class MediaLibraryTransformer extends TransformerAbstract
{
    /**
     * Transform a post.
     *
     * @param MediaLibrary $mediaLibrary
     * @return array
     */
    public function transform(MediaLibrary $mediaLibrary): array
    {
        return [
            'id' => $mediaLibrary->id,
            'title' => $mediaLibrary->title,
            'alt_text' => $mediaLibrary->alt_text,
            'description' => $mediaLibrary->description,
            'created_at' => $mediaLibrary->created_at->toIso8601String(),
            'filename' => $mediaLibrary->filename,
            'original_filename' => $mediaLibrary->original_filename,
            'mime_type' => $mediaLibrary->mime_type,
            'url' => $mediaLibrary->url,
            'caption' => $mediaLibrary->caption,
        ];
    }
}
