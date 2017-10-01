<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    protected $view = 'admin.setting.';
    protected $route = 'admin.settings.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::orderBy('name', 'ASC')->get();
        return view($this->view . 'index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        $json = json_decode($setting->field);
        return view($this->view . 'edit', compact('setting', 'json'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $update = $setting->update([
            'value' => $request->value
        ]);
        if (!$update) {
            return back()->with('error', 'Unsuccessed');
        }
        return redirect()->route($this->route . 'index')->with('success', 'Settings updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxUpdate(Request $request, $id)
    {
        $ajax = Setting::find($id);
        $udpate = $ajax->update([
            'value' => $request->value
        ]);
        if (!$udpate) {
            return response()->json(['status' => 'Unsucceeded: ' . $request->value]);
        }
        return response()->json(['status' => 'Succeeded: ' . $request->value . $ajax]);
    }
}
