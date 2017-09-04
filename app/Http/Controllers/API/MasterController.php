<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Tag;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{

    public function categories()
    {
        $categories = Category::all();
        return response($categories, 200);
    }

    public function catMostUsed()
    {
        $most = Category::with('articles')->get()->toArray();
        return response($most, 200);
    }
}
