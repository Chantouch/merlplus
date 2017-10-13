<?php

namespace App\Http\Controllers\API\V1;

use App\Model\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $tag = Tag::with('posts')
            ->where('name', 'វីដេអូឃ្លីប')
            ->orWhere('name', 'វីដេអូ')
            ->orWhere('name', 'Video')
            ->orWhere('name', 'Videos')
            ->first();
        return response()->json([
            'tags' => $tags,
            'tag' => $tag
        ], 200);
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
     * @return array
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, ['name' => 'required|min:3|unique:tags|max:255']);
            if ($validator->fails()) {
                return [
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                ];
            }
            $data['name'] = $request->name;
            $tag = Tag::with('posts')->create($data);
            DB::commit();
            return response($tag, 200);
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
