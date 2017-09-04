<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/19/2017
 * Time: 12:24 PM
 */

namespace App\Http\Traits;


use App\Model\Taggable;

trait TagTrait
{

	/**
	 * @param $model
	 * @param $namespace
	 * @param $attribute
	 */
	public function attachTag($model, $namespace, $attribute)
	{
		$tags = explode(',', $attribute);
		foreach ($tags as $taging) {
			Taggable::with('taggable')
				->insert([
					'tag_id'        => $taging,
					'taggable_id'   => $model->id,
					'taggable_type' => $namespace,
				]);
		}
	}

	/**
	 * @param $model
	 * @param $namespace
	 * @param $attribute
	 */
	public function syncTag($model, $namespace, $attribute)
	{
		if (!empty($attribute)) {
			Taggable::where('taggable_id', $model->id)
				->where('taggable_type', $namespace)
				->delete();
			$this->attachTag($model, $namespace, $attribute);
		}
	}

}