<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Role;
use App\Model\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		$userLists = User::with('roles')->latest()->get();
		$chartDataActive = Post::monthDailyPost()->get()->toArray();
		$roles = Role::all();
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
		$dashboard = [
			'labels'    => $date_count,
			'series'    => [
				'active'   => $act_count,
				'inactive' => $inact_count,
				'draft'    => $draft_count,
			],
			'usersList' => $userLists,
			'roles'     => $roles
		];
		return response()->json($dashboard, 200);
	}
}
