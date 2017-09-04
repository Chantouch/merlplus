<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/29/2017
 * Time: 10:06 PM
 */

namespace App\Http\Traits;

use App\Model\MediaLibrary;
use DOMDocument;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageBase64Upload
{
    /**
     * @param Request $request
     * @param $storage_path
     */
    public function saveImageBase64(Request $request, $storage_path)
    {
        $data = $request->all();
        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($data['description'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        // foreach <img> in the submitted message
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            // if the img source is 'data-url'
            if (preg_match('/data:image/', $src)) {
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid() . str_random(60);
                $filename_mime = $filename . '.' . $mimetype;
                $filepath = "/admin/media-library/$filename_mime";
                // @see http://image.intervention.io/api/
                $image = Image::make($src)// resize if required	/* ->resize(300, 200) */
                ->encode($mimetype, 100)// encode file to the specified mimetype
                ->save($storage_path . $filename_mime);
                $medialibrary = new MediaLibrary();
                $medialibrary->storeMediaLibraryByPost($filename_mime, $mimetype, $filename_mime, $filename_mime);
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif -->
        } // <!--Check-->
        //<!--Save the description content to db-->
        $data['description'] = $dom->saveHTML();
    }
}