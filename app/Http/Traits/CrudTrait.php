<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/19/2017
 * Time: 5:05 PM
 */

namespace App\Http\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait CrudTrait
{
    /**
     * @param Request $request
     * @param Model $model
     */
    public function storeModel(Request $request, Model $model)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $model_created = $model->create($data);
            if (!$model_created) {
                DB::rollBack();
            }
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param Request $request
     * @param Model $model
     */
    public function updateModel(Request $request, Model $model)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $model_updated = $model->update($data);
            if (!$model_updated) {
                DB::rollBack();
            }
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param Model $model
     */
    public function deleteModel(Model $model)
    {
        try {
            $model->delete();
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }
}