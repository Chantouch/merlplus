<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Media;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    /**
     * @param  String $filename
     * @return Response
     */
    public function getFile(String $filename)
    {
        $media = Media::where('filename', '=', $filename)->first();
        $headers = [
            'Content-Type' => $media->mime_type,
            'Content-Disposition' => "filename='{$media->original_filename}'"
        ];

        return response()->file($media->getPath(), $headers);
    }

    /**
     * @param  String $filename
     * @return \Illuminate\Http\Response
     */
    public function getFiles(String $filename)
    {
        $path = storage_path('app/public/uploads/media/advertises/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
