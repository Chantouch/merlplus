<?php

namespace App\Model;

use App\Http\Traits\Metable;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

	use Metable;

	protected $fillable = [
		'meta_title',
		'meta_keywords',
		'meta_description',
		'metable_id',
		'metable_type'
	];
}
