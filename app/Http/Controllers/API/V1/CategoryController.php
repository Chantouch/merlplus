<?php

namespace App\Http\Controllers\API\V1;

use App\Model\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $most_used_cat = DB::table("post_categories")
            ->join("categories", "categories.id", "=", "post_categories.category_id")
            ->select(DB::raw("count(post_id) as NumberPost"), "categories.name", "categories.id")
            ->groupBy("post_categories.category_id")
            ->having("NumberPost", ">", 18)
            ->orderBy(DB::raw("count(post_id)"), "DESC")
            ->get();
        return response()->json([
            'categories' => $categories,
            'most_used_cat' => $most_used_cat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, ['newcategory' => 'required']);
            if ($validator->fails()) {
                return [
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                ];
            }
            if ($request->has('parent_cat')) {
                $data['parent_id'] = $request->parent_cat;
                $data['name'] = $request->newcategory;
                $data['description'] = $request->newcategory;
                $data['status'] = 1;
                $data['slug'] = str_slug($request->newcategory, '-');
                $category = Category::with('parent')->create($data);
            } else {
                $data['parent_id'] = null;
                $data['name'] = $request->newcategory;
                $data['description'] = $request->newcategory;
                $data['slug'] = str_slug($request->newcategory, '-');
                $data['status'] = 1;
                $category = Category::with('children')->create($data);
            }
            DB::commit();
            return response($category, 200);
        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            return response(['error' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
