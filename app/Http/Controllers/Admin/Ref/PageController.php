<?php

namespace App\Http\Controllers\Admin\Ref;

use App\Http\Controllers\Blog\Traits\SlugUtf8;
use App\Http\Controllers\Controller;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\MediaLibrary;
use App\Model\Page;
use App\Model\Taggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DOMDocument;
use Intervention\Image\ImageManagerStatic as Image;

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
	        $storage_path = storage_path("app/public/uploads/media/library/");
            $validator = Validator::make($data, Page::rules(), Page::messages());
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
	        $dom = new DOMDocument();
	        libxml_use_internal_errors(true);
	        $dom->loadHtml(mb_convert_encoding($data['description'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	        $images = $dom->getElementsByTagName('img');
	        // foreach <img> in the submitted message
	        foreach ($images as $img) {
		        $src = $img->getAttribute('src');
		        // if the img source is 'data-url'
		        if (preg_match('/data:image/', $src)) {
			        // get the mimetype
			        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
			        $mimetype = $groups['mime'];
			        // Generating a random filename
			        $filename = uniqid() . str_random(60);
			        $filename_mime = $filename . '.' . $mimetype;
			        $filepath = "/admin/media-library/$filename_mime";
			        // @see http://image.intervention.io/api/
			        $image = Image::make($src)// resize if required	/* ->resize(300, 200) */
			        ->encode($mimetype, 100)// encode file to the specified mimetype
			        ->save($storage_path . $filename_mime);
			        $medialibrary = new MediaLibrary();
			        $medialibrary->storeMediaLibraryByPost($filename_mime, $mimetype, $filename_mime, $filename_mime);
			        $new_src = asset($filepath);
			        $img->removeAttribute('src');
			        $img->setAttribute('src', $new_src);
		        } // <!--endif -->
	        } // <!--Check-->
	        libxml_clear_errors();
	        //<!--Save the description content to db-->
	        $data['description'] = $dom->saveHTML();
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
                    $page->storeAndSetThumbnail($request->file('file'));
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
	        $storage_path = storage_path("app/public/uploads/media/library/");
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
	            $page->storeAndSetThumbnail($request->file('file'));
            }
            if (empty($page->slug)) {
                $data['slug'] = $this->slug_utf8($request->name);
            }
	        $dom = new DOMDocument();
	        libxml_use_internal_errors(true);
	        $dom->loadHtml(mb_convert_encoding($data['description'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	        $images = $dom->getElementsByTagName('img');
	        // foreach <img> in the submitted message
	        foreach ($images as $img) {
		        $src = $img->getAttribute('src');
		        // if the img source is 'data-url'
		        if (preg_match('/data:image/', $src)) {
			        // get the mimetype
			        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
			        $mimetype = $groups['mime'];
			        // Generating a random filename
			        $filename = uniqid() . str_random(60);
			        $filename_mime = $filename . '.' . $mimetype;
			        $filepath = "/admin/media-library/$filename_mime";
			        // @see http://image.intervention.io/api/
			        $image = Image::make($src)// resize if required	/* ->resize(300, 200) */
			        ->encode($mimetype, 100)// encode file to the specified mimetype
			        ->save($storage_path . $filename_mime);
			        $medialibrary = new MediaLibrary();
			        $medialibrary->storeMediaLibraryByPost($filename_mime, $mimetype, $filename_mime, $filename_mime);
			        $new_src = asset($filepath);
			        $img->removeAttribute('src');
			        $img->setAttribute('src', $new_src);
		        } // <!--endif -->
	        } // <!--Check-->
	        //<!--Save the description content to db-->
	        libxml_clear_errors();
	        $data['description'] = $dom->saveHTML();
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
