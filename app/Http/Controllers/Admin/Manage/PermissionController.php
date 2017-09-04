<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Model\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $route = 'admin.manage.permission.';

    public function index()
    {
        $permissions = Permission::all();
        return view('manage.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create');
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
            if ($request->permission_type == 'basic') {
                $validator = Validator::make($data, Permission::rule(), Permission::messages());
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $permission = Permission::create($data);
                if (!$permission) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Error while submitting your request!')->withInput();
                }
                return redirect()->route($this->route . 'index')
                    ->with('success', 'Permission ' . $permission->display_name . ' created successfully!');
            } elseif ($request->permission_type == 'crud') {
                $this->validate($request, [
                    'resource' => 'required|min:3|max:100|alpha'
                ]);
                $crud = explode(',', $request->crud_selected);
                if (count($crud) > 0) {
                    foreach ($crud as $x) {
                        $slug = strtolower($x) . '-' . strtolower($request->resource);
                        $display_name = ucwords($x . " " . $request->resource);
                        $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);
                        $permission = new Permission();
                        $permission->name = $slug;
                        $permission->display_name = $display_name;
                        $permission->description = $description;
                        $permission->save();
                    }
                    Session::flash('success', 'Permissions were all successfully added');
                    return redirect()->route($this->route . 'index');
                }
            } else {
                return redirect()->route($this->route . 'create')->withInput();
            }
            return redirect()->route($this->route . 'index')
                ->with('success', 'Permissions were all successfully added');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('manage.permissions.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('manage.permissions.edit', compact('permission'));
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
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
        $this->validate($request, [
            'display_name' => 'required|max:255',
            'description' => 'sometimes|max:255'
        ]);
        $permission = Permission::findOrFail($id);
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
        Session::flash('success', 'Updated the ' . $permission->display_name . ' permission.');
        return redirect()->route($this->route . 'show', $id);
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
}
