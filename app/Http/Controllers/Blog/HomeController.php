<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{

	/**
	 * HomeController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public $view = 'blog.';

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$news_sliders = Post::with(['categories', 'comments'])
			->latest()->take(4)->get();
		$categories = Category::with('articles')->orderBy('position_order')->get();
		$tag = Tag::with('posts')
			->where('name', 'វីដេអូឃ្លីប')
			->orWhere('name', 'វីដេអូ')
			->orWhere('name', 'Video')
			->orWhere('name', 'Videos')
			->first();
		$posts = [
			'news_sliders'  => $news_sliders,
		];
		return view($this->view . 'index', compact('posts', 'categories', 'tag'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function searchArticle(Request $request)
	{
		$searchTerm = $request->get('q');
		$posts = Post::with('categories')->search($searchTerm)->latest()->paginate(10);
		$posts_count = Post::search($searchTerm)->with('categories')->latest()->count();
		$posts->appends(['q' => $searchTerm]);
		Session::flash('_old_input', $request->all());
		if ($request->ajax()) {
			$posts->appends(['q' => $searchTerm]);
			$view = view($this->view . 'category.data', compact('posts'))->render();
			return response()->json(['html' => $view]);
		}
		return view($this->view . 'search.index', compact('posts', 'posts_count'));
	}
}
