<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Model\Role;
use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create', compact('roles'));
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
            $data = $request->all();
            $validator = Validator::make($data, User::rule(), User::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (!empty($request->password)) {
                $password = trim($request->password);
            } else {
                # set the manual password
                $length = 10;
                $key_space = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
                $str = '';
                $max = mb_strlen($key_space, '8bit') - 1;
                for ($i = 0; $i < $length; ++$i) {
                    $str .= $key_space[random_int(0, $max)];
                }
                $password = $str;
            }
            $data['password'] = bcrypt($password);
            $user = User::with('roles')->create($data);
            if (isset($request->roles)) {
                $user->syncRoles(explode(',', implode(',', $request->roles)));
            }
            return redirect()->route('admin.manage.user.show', $user->id);
        } catch (ModelNotFoundException $exception) {
            throw  new ModelNotFoundException();
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
        $user = User::with('roles')->find($id);
        return view('manage.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('manage.users.edit', compact('user', 'roles'));
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
            $data = $request->all();
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . $id
            ]);
            $validator = Validator::make($data, User::rule($id), User::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user = User::with('roles')->find($id);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            if ($request->password_options == 'auto') {
                $length = 10;
                $key_space = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
                $str = '';
                $max = mb_strlen($key_space, '8bit') - 1;
                for ($i = 0; $i < $length; ++$i) {
                    $str .= $key_space[random_int(0, $max)];
                }
                $data['password'] = bcrypt($str);
            } elseif ($request->password_options == 'manual') {
                $data['password'] = bcrypt($request->password);
            }
            $update = $user->update($data);
            if ($update) {
                $user->syncRoles(explode(',', implode(',', $request->roles)));
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'You can not update user role, Please contact admin');
            }
            return redirect()->route('admin.manage.user.show', $id);
        } catch (ModelNotFoundException $exception) {
            throw  new ModelNotFoundException();
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
