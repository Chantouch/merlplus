<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Advertise;
use App\Model\AdvertiseType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdvertiseController extends Controller
{
	public $route = 'admin.advertise.';
	public $view = 'admin.advertise.';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$advertises = Advertise::with('ads_type')->paginate(10);
		return view($this->view . 'index', compact('advertises'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$advertise_types = AdvertiseType::all();
		return view($this->view . 'create', compact('advertise_types'));
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
			$validator = Validator::make($data, Advertise::rule(), Advertise::message());
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$advertise = Advertise::with('ads_type')->create($data);
			if ($request->hasFile('banner')) {
				$advertise->mediaUpload($request->file('banner'));
			}
			if (!$advertise) {
				DB::rollBack();
				return redirect()->back()->with('error', 'Can not insert your data requirement');
			}
			DB::commit();
			return redirect()->route($this->route . 'index')->with('success', 'Advertise created successfully');
		} catch (ModelNotFoundException $exception) {
			throw new ModelNotFoundException();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$advertise = Advertise::with('media')->find($id);
		return view($this->view . 'show', compact('advertise'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$advertise = Advertise::with('media')->find($id);
		$advertise_types = AdvertiseType::all();
		return view($this->view . 'edit', compact('advertise', 'advertise_types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		try {
			DB::beginTransaction();
			$data = $request->all();
			$advertise = Advertise::with('media')->find($id);
			$validator = Validator::make($data, Advertise::rule(), Advertise::message());
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			if ($request->hasFile('banner')) {
				$advertise->mediaUpload($request->file('banner'));
			}
			$ads = $advertise->update($data);
			if (!$ads) {
				DB::rollBack();
				return redirect()->back()->with('error', 'Can not insert your data requirement');
			}
			DB::commit();
			return redirect()->route($this->route . 'index')->with('success', 'Advertise updated successfully');
		} catch (ModelNotFoundException $exception) {
			throw new ModelNotFoundException();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\Advertise $advertise
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Advertise $advertise)
	{
		$ads = $advertise->delete();
		if (!$ads) {
			DB::rollBack();
			return redirect()->back()->with('error', 'Can not insert your data requirement');
		}
		return redirect()->route($this->route . 'index')->with('warning', 'Advertise deleted successfully');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function active()
	{
		$advertises = Advertise::with('ads_type')
			->where('active', 1)
			->where('end_date', '>=', Carbon::now())
			->paginate(10);
		return view($this->view . 'index', compact('advertises'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function expired()
	{
		$advertises = Advertise::with('ads_type')
			->where('end_date', '<', Carbon::now())
			->paginate(10);
		return view($this->view . 'index', compact('advertises'));
	}
}
