<?php

namespace App\Http\Controllers\Admin\Ref;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use App\Http\Controllers\Controller;
use App\Model\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    use SlugUtf8;
    public $route = 'admin.ref.tag.';
    public $view = 'ref.tag.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('posts')->paginate(25);
        return view($this->view . 'index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view . 'create');
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
            $validator = Validator::make($data, Tag::rules(), Tag::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $tag = Tag::with('posts')->create($data);
            if ($request->hasFile('thumbnail')) {
                $tag->storeAndSetThumbnail($request->file('thumbnail'));
            }
            if ($request->hasFile('menu_thumbnail')) {
                $tag->storeAndSetMenuThumbnail($request->file('menu_thumbnail'));
            }
            DB::commit();
            return redirect()->route($this->route . 'edit', [$tag->id])->with('success', 'Tag added successfully.');
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
        $tag = Tag::with('posts')->find($id);
        return view($this->view . 'show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id === null) {
            return redirect()->route($this->route . 'index')->with('error', 'We can not find category with that id, please try the other');
        }
        $tag = Tag::with('posts')->find($id);
        return view($this->view . 'edit', compact('tag'));
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
            $tag = Tag::with('posts')->find($id);
            $validator = Validator::make($data, Tag::rules($id), Tag::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            if ($request->hasFile('thumbnail')) {
                $tag->storeAndSetThumbnail($request->file('thumbnail'));
            }
            if ($request->hasFile('menu_thumbnail')) {
                $tag->storeAndSetMenuThumbnail($request->file('menu_thumbnail'));
            }
            $tag->update($data);
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Tag updated successfully.');
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
        $tag = Tag::with('posts')->find($id);
        $delete = $tag->delete();
        if (!$delete) {
            return back()->with('error', 'Your category can not delete from your system right now. Plz try again later.');
        }
        return redirect()->route($this->route . 'index')->with('success', 'Tag deleted successfully');
    }

}