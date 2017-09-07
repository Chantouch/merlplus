<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Carbon\Carbon;

class DashboardController extends Controller
{
	public function index()
	{
		$chartDatas = Post::monthDailyPost()
			->get()
			->toArray();
		$chartDataByDay = [];
		foreach ($chartDatas as $data) {
			$chartDataByDay[$data['date']] = $data['count'];
		}
		$date = new Carbon();
		for ($i = 0; $i < 30; $i++) {
			$dateString = $date->format('Y-m-d');
			if (!isset($chartDataByDay[$dateString])) {
				$chartDataByDay[$dateString] = 0;
			}
			$date->subDay();
		}
		return response()->json($chartDataByDay,200);
	}
}
