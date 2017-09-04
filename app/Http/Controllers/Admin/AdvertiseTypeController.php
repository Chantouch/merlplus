<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertiseType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdvertiseTypeController extends Controller
{
    public $route = 'admin.advertise-type.';
    public $view = 'admin.advertise-type.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertise_types = AdvertiseType::paginate(10);
        return view($this->view . 'index', compact('advertise_types'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, AdvertiseType::rule(), AdvertiseType::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['slug'] = str_slug($request->name, '-');
            $advertise = AdvertiseType::with('advertising')->create($data);
            if (!$advertise) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Can not insert your data requirement');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Advertise type created successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\AdvertiseType $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertiseType $advertiseType)
    {
        return response($advertiseType, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AdvertiseType $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertiseType $advertiseType)
    {
        return view($this->view . 'edit', compact('advertiseType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\AdvertiseType $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvertiseType $advertiseType)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, AdvertiseType::rule(), AdvertiseType::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (empty($advertiseType->slug) || empty($request->slug)) {
                $data['slug'] = str_slug($request->name, '-');
            }
            $ads = $advertiseType->update($data);
            if (!$ads) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Can not insert your data requirement');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Advertise type updated successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AdvertiseType $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertiseType $advertiseType)
    {
        $ads = $advertiseType->delete();
        if (!$ads) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Can not insert your data requirement');
        }
        return redirect()->route($this->route . 'index')->with('warning', 'Advertise type deleted successfully');
    }
}
