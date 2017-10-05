<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostsRequest;
use App\Http\Services\HTMLFixer;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\ManyToManyTrait;
use App\Http\Traits\MetaTrait;
use App\Http\Traits\TagTrait;
use App\Http\Traits\UploadTrait;
use App\Model\Category;
use App\Model\MediaLibrary;
use App\Model\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use DOMDocument;

class ArticleController extends Controller
{

    use CrudTrait;
    use UploadTrait;
    use TagTrait;
    use ManyToManyTrait;
    use MetaTrait;
    public $route = 'admin.article.';
    public $view = 'article.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::with(['tags', 'categories', 'images'])
            ->withCount('comments')->with('author')->latest()->paginate(25);
        return view($this->view . 'index', compact('articles'));
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
     * @param PostsRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $storage_path = storage_path("app/public/uploads/media/library/");
	        if (!file_exists($storage_path)) {
		        mkdir($storage_path, 0777, true);
	        }
            //First check need to clean the description for html tag
            //$data['description'] = clean($request->description);
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
            switch ($request->submit) {
                case 'publish':
                    $data['active'] = 1;
                    break;
                case 'draft':
                    $data['active'] = 2;
            }
            $post = Post::with('images')->create($data);
            if ($post) {
                if ($request->hasFile('thumbnail')) {
                    $post->storeAndSetThumbnail($request->file('thumbnail'), $post);
                }
                if (!empty($request->tags)) {
                    $this->attachTag($post, 'App\Model\Post', $request->tags);
                }
                $this->attachRelation($post->categories(), explode(',', $request->categories));
                $post->setAndStoreMetaTag($request->meta_title, $request->meta_keywords, $request->meta_description);
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Post created successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('media')->find($id);
        return view($this->view . 'show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('articles')->where('status', 1)
            ->orderBy('name', 'desc')
            ->pluck('name', 'id')->toArray();
        $post = Post::with('images', 'meta')->find($id);
        return view($this->view . 'edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostsRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $post = Post::with('images')->find($id);
            $storage_path = storage_path("app/public/uploads/media/library/");
            if ($request->hasFile('thumbnail')) {
                $post->storeAndSetThumbnail($request->file('thumbnail'), $post);
            }
            $post->storeAndSetAuthor();
            //$data['description'] = clean($request->description);
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
            switch ($request->submit) {
                case 'publish':
                    $data['active'] = 1;
                    break;
                case 'draft':
                    $data['active'] = 2;
            }
            $updated = $post->update($data);
            if ($updated) {
                $this->syncTag($post, 'App\Model\Post', $request->tags);
                $this->syncRelation($post->categories(), explode(',', $request->categories));
                $post->setAndStoreMetaTag($request->meta_title, $request->meta_keywords, $request->meta_description);
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Post updated successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::with('images')->find($id);
        $post->delete();
        return redirect()->route($this->route . 'index')->with('success', 'Article deleted successfully.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draft()
    {
        $articles = Post::with('images')->where('active', 2)->paginate(25);
        return view($this->view . 'index', compact('articles'));
    }
}
