<?php

namespace App\Http\Controllers\API\V1;

use App\Model\MediaLibrary;
use App\Transformers\MediaLibraryTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaLibraryController extends ApiController
{
    /**
     * MediaLibraryController constructor.
     */
    public function __construct()
    {
        $this->transformer = new MediaLibraryTransformer();
        $this->resourceKey = 'media-library';
    }

    /**
     * Return the media library.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $media_library = MediaLibrary::latest()->paginate($request->input('limit', 20));
        return $this->paginatedCollection($media_library);
    }

    /**
     * Return the media library.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media_library = MediaLibrary::find($id);
        return response($media_library, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $media_library = MediaLibrary::find($id);
        $media_library->update($data);
        return response()->json(['data' => 'Media library detail updated!']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $media_library = MediaLibrary::find($id);
        if (empty($media_library->first())) {
            return response()->json(['warning' => 'There is no that file in server.']);
        }
        $old_path = [
            'public/uploads/media/library/' . $media_library->filename,
        ];
        if (File::exists(storage_path('app/public/uploads/posts'))) {
            Storage::delete($old_path);
        }
        $media_library->delete();
        return response()->json(['data' => 'Media library deleted!']);
    }

    /**
     * @param $filename
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyDropZoneUpload($filename)
    {
        try {
            $media_library = MediaLibrary::whereOriginalFilename($filename);
            if (empty($media_library->first())) {
                return response()->json(['warning' => 'There is no that file in server.']);
            }
            $old_path = [
                'public/uploads/media/library/' . $media_library->first()->filename
            ];
            if (File::exists(storage_path('app/public/uploads/posts'))) {
                Storage::delete($old_path);
            }
            $media_library->delete();
            return response()->json(['success' => 'Media library deleted from your storage!']);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

}
