<?php

namespace App\Http\Controllers\Admin\Ref;

use App\Http\Controllers\Controller;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\Category;
use App\Model\Tag;
use App\Model\Taggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    use UploadTrait;
    use TagTrait;
    public $route = 'admin.ref.category.';
    public $view = 'ref.category.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['parent', 'children', 'tags', 'images'])
            ->paginate(25);
        return view($this->view . 'index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('children')
            ->where('status', 1)
            ->orderBy('id')->pluck('name', 'id');
        return view($this->view . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, Category::rules(), Category::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            dd($request->has('tags'));
            if (empty($request->slug)) {
                $data['slug'] = str_slug($request->name);
            }
            if ($request->has('parent_id')) {
                $data['parent_id'] = $request->parent_id;
                $category = Category::with('parent')->create($data);
            } else {
                $data['parent_id'] = null;
                $category = Category::with('children')->create($data);
            }
            if ($category) {
                if ($request->hasFile('file')) {
                    $this->uploadImage($request, 'uploads/category/', $category, 'file');
                }
                if ($request->has('tags')) {
                    $this->attachTag($category, 'App\Model\Category', $request->tags);
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Category added successfully.');
        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            return back()->with('error', 'Your category can not add to our system right now. Plz try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view($this->view . 'show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::with('children')->find($id);
        if ($category === null) {
            return redirect()->route($this->route . 'index')->with('error', 'We can not find category with that id, please try the other');
        }
        $categories = Category::with('children')
            ->where('status', 1)
            ->orderBy('id')->pluck('name', 'id');
        return view($this->view . 'edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\ $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if ($id === null) {
                return redirect()->route($this->route . 'index')->with('error', 'We can not find category with that id, please try the other');
            }
            $category = Category::with('children')->find($id);
            $validator = Validator::make($data, Category::rules($id), Category::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            if ($request->has('tags')) {
                Taggable::where('taggable_id', $category->id)
                    ->where('taggable_type', 'App\Model\Category')
                    ->delete();
                $this->attachTag($category, 'App\Model\Category', $request->tags);
            }
            if ($request->hasFile('file')) {
                $this->uploadImage($request, 'uploads/category/', $category, 'file');
            }
            if (!empty($request->slug)) {
                $data['slug'] = str_slug($request->name);
            }
            $update = $category->update($data);
            if (!$update) {
                DB::rollBack();
                return back()->with('error', 'Your category can not add to your system right now. Plz try again later.');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Category added successfully.');
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', 'Your category can not add to your system right now. Plz try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error', 'Your category can not delete from your system right now. Plz try again later.');
        }
        return redirect()->route($this->route . 'index')->with('success', 'Category deleted successfully');
    }

    public function updateStatus($id, Request $request)
    {
        $data = $request->all();
        if ($request->status == null) {
            $data['status'] = 0;
        }
        $category = Category::find($id);
        $category->update($data);
        return response(['message' => 'Status updated'], 200);
    }

}