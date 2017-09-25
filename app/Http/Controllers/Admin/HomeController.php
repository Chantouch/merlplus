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
        $chartDataActive = Post::monthDailyPost()
            ->get()
            ->toArray();
        $week = [];
        $active = [];
        $inactive = [];
        $draft = [];
        foreach ($chartDataActive as $data) {
            $week[$data['date']] = $data['date'];
            $active[$data['date']] = $data['CountActive'];
            $inactive[$data['date']] = $data['CountInActive'];
            $draft[$data['date']] = $data['CountDraft'];
        }
        $date = new Carbon();
        $date_count = [];
        $act_count = [];
        $inact_count = [];
        $draft_count = [];
        for ($i = 0; $i < 7; $i++) {
            $dateString = $date->format('Y-m-d');
            if (isset($week[$dateString])) {
                $date_count[] = $week[$dateString];
                $act_count[] = $active[$dateString];
                $inact_count[] = $inactive[$dateString];
                $draft_count[] = $draft[$dateString];
            } else {
                $date_count[] = $dateString;
                $act_count[] = 0;
                $inact_count[] = 0;
                $draft_count[] = 0;
            }
            $date->subDay();
        }
        $profile = auth()->user();
        $userLists = User::with('roles')->latest()->get();
        $latest_posts = Post::latest()->take(4)->get();
        $visitor = Tracker::currentSession();
        $users_online = Tracker::onlineUsers(); // defaults to 3 minutes
        return view('admin.dashboard.index', compact(
            'comments', 'postsLastWeek', 'users', 'postsTotal', 'profile',
            'userLists', 'latest_posts', 'visitor', 'users_online'
        ))
            ->with('labels', json_encode($date_count, true))
            ->with('active', json_encode($act_count, true))
            ->with('inactive', json_encode($inact_count, true))
            ->with('draft', json_encode($draft_count, true));
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
