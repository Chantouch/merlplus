<?php

namespace App\Http\Controllers\Admin\Ref;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use App\Http\Controllers\Controller;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\Page;
use App\Model\Taggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    use UploadTrait;
    use TagTrait;
    use SlugUtf8;
    public $route = 'admin.ref.page.';
    public $view = 'ref.page.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with(['parent', 'children', 'tags', 'images'])
            ->paginate(25);
        return view($this->view . 'index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::with('children')
            ->where('status', 1)
            ->orderBy('id')->pluck('name', 'id');
        return view($this->view . 'create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, Page::rules(), Page::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $data['slug'] = $this->slug_utf8($request->name);
            if ($request->has('parent_id')) {
                $data['parent_id'] = $request->parent_id;
                $page = Page::with('parent')->create($data);
            } else {
                $data['parent_id'] = null;
                $page = Page::with('children')->create($data);
            }
            if ($page) {
                if ($request->hasFile('file')) {
                    $this->uploadImage($request, 'uploads/page/', $page, 'file');
                }
                if ($request->has('tags')) {
                    $this->attachTag($page, 'App\Model\Page', $request->tags);
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Page added successfully.');
        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            return back()->with('error', 'Your page can not add to our system right now. Plz try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view($this->view . 'show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        if ($page === null) {
            return redirect()->route($this->route . 'index')->with('error', 'We can not find page with that id, please try the other');
        }
        $pages = Page::with('children')
            ->where('status', 1)
            ->orderBy('id')->pluck('name', 'id');
        return view($this->view . 'edit', compact('page', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if ($page === null) {
                return redirect()->route($this->route . 'index')->with('error', 'We can not find page with that id, please try the other');
            }
            $validator = Validator::make($data, Page::rules($page->id), Page::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            if ($request->has('tags')) {
                Taggable::where('taggable_id', $page->id)
                    ->where('taggable_type', 'App\Model\Page')
                    ->delete();
                $this->attachTag($page, 'App\Model\Page', $request->tags);
            }
            if ($request->hasFile('file')) {
                $this->uploadImage($request, 'uploads/page/', $page, 'file');
            }
            if (empty($page->slug)) {
                $data['slug'] = $this->slug_utf8($request->name);
            }
            $update = $page->update($data);
            if (!$update) {
                DB::rollBack();
                return back()->with('error', 'Your page can not add to your system right now. Plz try again later.');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Page added successfully.');
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', 'Your page can not add to your system right now. Plz try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $delete = $page->delete();
        if (!$delete) {
            return back()->with('error', 'Your page can not delete from your system right now. Plz try again later.');
        }
        return redirect()->route($this->route . 'index')->with('success', 'Page deleted successfully');
    }
}
