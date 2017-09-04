<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/19/2017
 * Time: 10:42 AM
 */

namespace App\Http\Traits;


use App\Model\Attachment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait UploadTrait
{
    use Mediable;

    /**
     * @param Request $request
     * @param $destination_path
     * @param $model
     * @param $attribute
     */
    public function uploadImage(Request $request, $destination_path, $model, $attribute)
    {
        if ($request->file($attribute)->isValid()) {
            $extension = $request->file($attribute)->getClientOriginalExtension();
            if (!file_exists($destination_path)) {
                mkdir($destination_path, 0777, true);
            }
            $fileName = uniqid() . '_' . time() . '.' . strtolower($extension);
            $request->file($attribute)->move($destination_path, $fileName);
            if (count($model->images)) {
                $old_file = [$destination_path . $model->images->file];
                if (File::exists($destination_path)) {
                    File::delete($old_file);
                }
                $model->images->update(['file' => $fileName]);
            } else {
                $attachable = new Attachment();
                $attachable->file = $fileName;
                $attachable->is_feature = 1;
                $saved = $model->images()->save($attachable);
                if (!$saved) {
                    throw new ModelNotFoundException();
                }
            }
        }
    }

}