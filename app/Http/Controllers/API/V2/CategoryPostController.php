<?php

namespace App\Http\Controllers\API\V2;

use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(
            Category::with('articles')->orderBy('position_order')->take(5)->get()
        );
    }
}
