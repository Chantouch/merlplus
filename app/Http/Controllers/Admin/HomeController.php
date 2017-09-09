<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Post;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tracker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::lastWeek()->get();
        $postsLastWeek = Post::lastWeek()->get();
        $postsTotal = Post::totalActive();
        $users = User::lastWeek()->get();
        $chartDatas = Post::monthDailyPost()
            ->get()
            ->toArray();
        $chartDataByDay = [];
        foreach ($chartDatas as $data) {
            $chartDataByDay[$data['date']] = $data['count'];
        }
        $date = new Carbon();
        for ($i = 0; $i < 7; $i++) {
            $dateString = $date->format('Y-m-d');
            if (!isset($chartDataByDay[$dateString])) {
                $chartDataByDay[$dateString] = 0;
            }
            $date->subDay();
        }

        $labels = [];
        $series = [];
        foreach ($chartDataByDay as $key => $val) {
            array_push($labels, $key);
            array_push($series, $val);
        }
        $profile = auth()->user();
        $userLists = User::with('roles')->latest()->get();
        $visitors = Tracker::currentSession();
        return view('admin.dashboard.index', compact(
            'comments', 'postsLastWeek', 'users', 'postsTotal', 'profile', 'userLists', 'visitors'
        ))
            ->with('labels', json_encode($labels, true))
            ->with('series', json_encode($series, true));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertPostCategory()
    {
        $id = 1;
        for ($i = 1; $i <= 66; $i++) {
            if ($id == 5) {
                $id = 1;
            }
            DB::table('post_categories')->insert([
                'post_id' => $i,
                'category_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $id++;
        }
        return response()->json(['message' => 'Successfully added to database']);
    }
}
