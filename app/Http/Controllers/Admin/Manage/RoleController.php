<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public $route = 'admin.manage.role.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('manage.roles.create', compact('permissions'));
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
            $validator = Validator::make($data, Role::rule(), Role::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $role = Role::with('permissions')->create($data);
            if ($role) {
                if ($request->permissions) {
                    $role->syncPermissions(explode(',', $request->permissions));
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'show', $role->id)
                ->with('success', 'Successfully created the new ' . $role->display_name . ' role in the database.');
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
        $role = Role::with('permissions')->find($id);
        return view('manage.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        return view('manage.roles.edit', compact('role','permissions'));
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
        try {
            DB::beginTransaction();
            $data = $request->all();
            $role = Role::with('permissions')->find($id);
            $validator = Validator::make($data, Role::rule(), Role::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['name'] = $role->name;
            $update = $role->update($data);
            if ($update) {
                if ($request->permissions) {
                    $role->syncPermissions(explode(',', $request->permissions));
                }
            }
            DB::commit();
            return redirect()->route($this->route . 'show', $role->id)
                ->with('success', 'Successfully updated ' . $role->display_name . ' in the database.');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
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
