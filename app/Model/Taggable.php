<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['tag_id', 'taggable_id', 'taggable_type'];
}
